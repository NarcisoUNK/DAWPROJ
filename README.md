# DAWPROJ


Na API, para adicionar ou eliminar qualquer tipo de dados é preciso autenticar usando:
https://laravel.com/docs/11.x/sanctum#spa-authentication

#TODO: meter exemplos de respostas e exemplo de request dos POSTs

## API
### Users
`GET` /api/users

&emsp; Devolve todos os utilizadores

`GET` /api/user/{id_user}

&emsp; Devolve o utilizador _id_user_


### Races

`GET` /api/races

&emsp; Devolve todas as corridas

`GET` /api/race/{id_race}

&emsp; Devolve a corrida _id_race_

`POST` /api/race

&emsp; Adiciona uma corrida 

`GET` /api/race/delete/{id_race}

&emsp; Elimina a corrida _id_race_



### Grandstands

`GET` /api/race/{id_race}/grandstands

&emsp; Devolve todas as bancadas da corrida _id_race_

`GET` /api/grandstand/{id_grandstand}

&emsp; Devolve a bancada _id_grandstand_

`POST` /api/grandstand

&emsp; Adiciona uma bancada 

`GET` /api/grandstand/delete/{id_grandstand}

&emsp; Elimina a bancada _id_grandstand_



### Seats

`GET` /api/grandstands/{grandstands_id}/seats

&emsp; Devolve todos os lugares da bancada _id_grandstand_

`GET` /api/seat/{id_seat}

&emsp; Devolve o lugar _id_seat_

`POST` /api/seat

&emsp; Adiciona um lugar 

`GET` /api/seat/delete/{id_seat}

&emsp; Elimina o lugar _id_seat_



### Tickets

`GET` /api/user/{id_user}/tickets

&emsp; Devolve todos os bilhetes do user _id_user_

`GET` /api/ticket/{id_ticket}

&emsp; Devolve o bilhete _id_ticket_

`POST` /api/ticket

&emsp; Adiciona um bilhete 

`GET` /api/ticket/delete/{id_ticket}

&emsp; Elimina o bilhete _id_ticket_
