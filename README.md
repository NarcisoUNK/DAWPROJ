# DAWPROJ


Na API, para adicionar ou eliminar qualquer tipo de dados é preciso autenticar usando:
https://laravel.com/docs/11.x/sanctum#spa-authentication

#TODO: exemplos de request dos POSTs

## API
### Users

`GET` /api/user/{id_user}

&emsp; Devolve o utilizador _id_user_
``` JSON
{
    "success":true,
    "data":{
        "id_user":1,
        "username":"prom",
        "email":"prom@prom.prom",
        "permissions":"111",
        "name":"prom"
    },
    "message":"Retrieved successfully."
}
```

### Races

`GET` /api/races

&emsp; Devolve todas as corridas

``` JSON
{
  "success": true,
  "data": [
    {
      "id_race": 1,
      "id_user": 1,
      "race_name": "FORMULA 1 AUSTRALIAN GRAND PRIX 2025",
      "year": 2025,
      "country": "Australia",
      "city": "Melbourne",
      "image": "[...]",
      "circuit": "[...]",
    },
    {
      "id_race": 2,
      "id_user": 1,
      "race_name": "FORMULA 1 HEINEKEN CHINESE GRAND PRIX 2025",
      "year": 2025,
      "country": "China",
      "city": "Shanghai"
      "image": "[...]",
      "circuit": "[...]",
    },
    {
      "id_race": 3,
      "id_user": 1,
      "race_name": "FORMULA 1 LENOVO JAPANESE GRAND PRIX 2025",
      "year": 2025,
      "country": "Japan",
      "city": "Suzuka"
      "image": "[...]",
      "circuit": "[...]",
    }
  ],
  "message": "Retrieved successfully."
}
```

`GET` /api/race/{id_race}

&emsp; Devolve a corrida _id_race_
``` JSON
{
  "success": true,
  "data": {
    "id_race": 2,
    "id_user": 1,
    "race_name": "FORMULA 1 HEINEKEN CHINESE GRAND PRIX 2025",
    "year": 2025,
    "country": "China",
    "city": "Shanghai",
    "image": "[...]",
    "circuit": "[...]",
  },
  "message": "Retrieved successfully."
}
```

`POST` /api/race

&emsp; Adiciona uma corrida 
|Campo|Descrição||
|:-|:-|-:|
|id_user    |_id_ do user que está criar            |_required_|
|race_name  |Nome da corrida                        |_required_|
|year       |Ano da corrida                         |_required_|
|country    |País da corrida                        |_required_|
|city       |Cidade da corrida                      |_required_|
|image      |Imagem da corrida codificada em base64 |_required_|
|circuit    |Imagem do circuito codificado em base64|_required_|

`GET` /api/race/delete/{id_race}

&emsp; Elimina a corrida _id_race_
``` JSON
{
  "success": true,
  "data": "",
  "message": "Deleted successfully."
}
```



### Grandstands

`GET` /api/race/{id_race}/grandstands

&emsp; Devolve todas as bancadas da corrida _id_race_
``` JSON
{
  "success": true,
  "data": [
    {
      "id_grandstand": 4,
      "id_race": 2,
      "name": "Main Grandstand"
    },
    {
      "id_grandstand": 5,
      "id_race": 2,
      "name": "Turn 3"
    },
    {
      "id_grandstand": 6,
      "id_race": 2,
      "name": "Turn 10"
    }
  ],
  "message": "Retrieved successfully."
}
```

`GET` /api/grandstand/{id_grandstand}

&emsp; Devolve a bancada _id_grandstand_
``` JSON
{
  "success": true,
  "data": {
    "id_grandstand": 5,
    "id_race": 2,
    "name": "Turn 3"
  },
  "message": "Retrieved successfully."
}
```

`POST` /api/grandstand

&emsp; Adiciona uma bancada 

|Campo|Descrição||
|:-|:-|-:|
|id_race    |_id_ da corrida    |_required_|
|name       |Nome da bancada    |_required_|

`GET` /api/grandstand/delete/{id_grandstand}

&emsp; Elimina a bancada _id_grandstand_
``` JSON
{
  "success": true,
  "data": "",
  "message": "Deleted successfully."
}
```



### Seats

`GET` /api/grandstand/{grandstands_id}/seats

&emsp; Devolve todos os lugares da bancada _id_grandstand_
``` JSON
{
  "success": true,
  "data": [
    {
      "id_seat": 201,
      "id_grandstand": 5,
      "n_seat_grandstand": "1",
      "price": 598.94
    },
        ...
    ,
    {
      "id_seat": 250,
      "id_grandstand": 5,
      "n_seat_grandstand": "50",
      "price": 632.21
    }
  ],
  "message": "Retrieved successfully."
}
```
`GET` /api/seat/{id_seat}

&emsp; Devolve o lugar _id_seat_
``` JSON
{
  "success": true,
  "data": {
    "id_seat": 201,
    "id_grandstand": 5,
    "n_seat_grandstand": "1",
    "price": 1294.9
  },
  "message": "Retrieved successfully."
}
```

`POST` /api/seat

&emsp; Adiciona um lugar 

|Campo|Descrição||
|:-|:-|-:|
|id_grandstand      |_id_ da bancada          |_required_|
|n_seat_grandstand  |Nome do lugar na bancada |_required_|
|price              |Preço do lugar           |_required_|

`GET` /api/seat/delete/{id_seat}

&emsp; Elimina o lugar _id_seat_
``` JSON
{
  "success": true,
  "data": "",
  "message": "Deleted successfully."
}
```



### Tickets

`GET` /api/user/{id_user}/tickets

&emsp; Devolve todos os bilhetes do user _id_user_
``` JSON
{
  "success": true,
  "data": [
    {
      "id_ticket": 1,
      "id_seat": 98,
      "id_user": 2,
      "final_price": 307.34
    },
    {
      "id_ticket": 5,
      "id_seat": 45,
      "id_user": 2,
      "final_price": 1552.28
    }
  ],
  "message": "Retrieved successfully."
}
```

`GET` /api/ticket/{id_ticket}

&emsp; Devolve o bilhete _id_ticket_
``` JSON
{
  "success": true,
  "data": {
    "id_ticket": 5,
    "id_seat": 45,
    "id_user": 2,
    "final_price": 1552.28
  },
  "message": "Retrieved successfully."
}
```

`POST` /api/ticket

&emsp; Adiciona um bilhete 

|Campo|Descrição||
|:-|:-|-:|
|id_seat        |_id_ do lugar  |_required_|
|id_user        |_id_ do user   |_required_|
|final_price    |Preço final    |_required_|

`GET` /api/ticket/delete/{id_ticket}

&emsp; Elimina o bilhete _id_ticket_
``` JSON
{
  "success": true,
  "data": "",
  "message": "Deleted successfully."
}
```
