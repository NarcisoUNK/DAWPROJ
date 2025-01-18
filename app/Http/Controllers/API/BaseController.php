<?php
  
namespace App\Http\Controllers\API;
  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\Validator as FacadesValidator;
  
class BaseController extends Controller
{
    public $model;
    public $resource;
    public $validationRules;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
  
        return response()->json($response, 200);
    }
  
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];
  
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
  
        return response()->json($response, $code);
    }

    public function error()
    {
        return $this->sendError('Method not allowed.', 'Method not allowed.', 405);
    }
    
    public function index()
    {
        $itens = $this->model::all();
        return $this->sendResponse($this->resource::collection($itens), 'Retrieved successfully.');
    }

    public function get($id)
    {
        $column = 'id_'.app($this->model)->getTable();
        $row = $this->model::all()->where($column, $id)->first();
        if (is_null($row)) {
            return $this->sendError('Not found.');
        }
        return $this->sendResponse(new $this->resource($row), 'Retrieved successfully.');
    }

    public function add(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), $this->validationRules);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $row = $this->model::create($input);
        
        return $this->sendResponse(new $this->resource($row), 'Created successfully.');
    }

    public function delete($id)
    {
        $column = 'id_'.app($this->model)->getTable();
        $row = $this->model::all()->where($column, $id)->first();
        if (is_null($row)) {
            return $this->sendError('Not found.');
        }
        try {
            $row->where($column, $id)->delete();
        } catch (\Exception $e) {
            return $this->sendError('Error.', $e->getMessage());
        }
        return $this->sendResponse('','Deleted successfully.');
    }

}