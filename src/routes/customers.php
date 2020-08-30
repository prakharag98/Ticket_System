<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$app=new \Slim\App;

// Add Customer
$app->post('/api/customers_ticket/add', function(Request $request, Response $response){
    $first_name = $request->getParam('first_name');
    $last_name = $request->getParam('last_name');
    $age = $request->getParam('age');
    $gender = $request->getParam('gender');
    $booking_time = $request->getParam('booking_time');
    $phone_no = $request->getParam('phone_no');

    $sql = "INSERT INTO customers_ticket (first_name,last_name,age,gender,booking_time,phone_no) VALUES
    (:first_name,:last_name,:age,:gender,:booking_time,:phone_no)";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name',  $last_name);
        $stmt->bindParam(':age',        $age);
        $stmt->bindParam(':gender',     $gender);
        $stmt->bindParam(':booking_time',       $booking_time);
        $stmt->bindParam(':phone_no',   $phone_no);

        $stmt->execute();

        echo '{"notice": {"text": "Customer Ticket Booked"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Get details of single user
$app->get('/api/customers_ticket/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM customers_ticket WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customer = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customer);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

//Get details of single user
$app->get('/api/customers_ticket/time/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM customers_ticket WHERE booking_time = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customer = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customer);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Delete Customer
$app->delete('/api/customers_ticket/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM customers_ticket WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Customer Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Update Customer
$app->put('/api/customers_ticket/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $booking_time = $request->getParam('booking_time');
    
    $sql = "UPDATE customers_ticket SET
			booking_time =:booking_time
			WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':booking_time', $booking_time);

        $stmt->execute();

        echo '{"notice": {"text": "Customer Time Updated"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});