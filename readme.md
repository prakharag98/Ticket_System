# REST Interface for Movie Theatre Ticket Booking System

REST Interface to support multiple bussiness cases and handling edge cases associated with ticket bookings. User can make use of features provided by the end points to have a swift and error free bookings along with constraints.

## INSTALLATION

- XAMPP

- SLIM

- Rest Easy

- Git bash

- VS Code(Preferably)

## FEATURES

> Endpoint to book a ticket using user's name ,phone number and timings

> Endpoint to update the ticket timing

> Endpoint to view all tickets for a particular time

> Endpoint to delete a particular ticket 

> Endpoint to view the user ticket based on user id

> Ticket gets expired after 8 hours of ticket timing

> Ticket gets deleted automatically after 8 hrs of ticket timing

> Maximum of 20 tickets can be booked for a particular timing

## ENDPOINTS

### POST

```ruby
    $app->post('/api/customers_ticket/add', function(Request $request, Response $response){
        ....
    }
```

- Condition : Max 20 tickets for a particular timing 

```ruby
    $count_tickets=$query->rowcount();
    if($count_tickets>20){ 
        echo '{"notice": {"text": "Housefull"}';
        $flag=0;
    }
    else{
        .....
    }
```

### GET

```ruby
     $app->get('/api/customers_ticket/{id}', function(Request $request, Response $response){
         ....
     }
```

- View all tickets for a particular time and for particular id.

### DELETE 

```ruby
     $app->delete('/api/customers_ticket/delete/{id}', function(Request $request, Response $response){
         ....
     }
```

### PUT 

```ruby
    $app->put('/api/customers_ticket/update/{id}', function(Request $request, Response $response){
        ...
    }
```
- Deletion based on id of the ticket 

### EVENT LISTENER 

- Condition - Ticket will expire eight hrs of timing.

- Checks for condition in every 30 seconds using event listener.

    ```ruby
    CREATE EVENT IF NOT EXISTS event_listener
    ON SCHEDULE EVERY 5 SECOND
    STARTS CURRENT_TIMESTAMP + INTERVAL 30 SECOND
    DO 
    DELETE FROM customers_ticket where cast(concat(CURRENT_DATE(), ' ',CURRENT_TIME()) as datetime)>= ADDTIME(cast(booking_time as datetime), "8:00:00")
    ```

## DATABASE

- Technology : Mysql

- Table Name - customers_ticket 

> Attributes : 

```ruby
    id | first_name | last_name | age | gender | booking_time      | phone_no
    1  | Prakhar    | Agarwal   | 21  | M      |2020-07-30 21:05:00|9876543210
    2  | Abhay      | Sharma    | 18  | M      |2020-07-30 12:00:00|9876543211
```

## LINK TO IMPORTANT SCREENSHOTS

[Click here!](https://github.com/prakharag98/Ticket_System/tree/master/Screen%20Shots)

## Author

👤 **Prakhar Agarwal**
- Github: [@prakharag98](https://github.com/prakharag98)

