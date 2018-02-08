<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app ->get('/api/v1/customers', function(Request $req, Response $res){
    $sql = "select * from CUSTOMERS;";
    try {
        $db = new db();
        $db = $db ->connect();
        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customers);

    } catch (PDOException $e){
        echo '{"error": {"text":'.$e->getMessage().'}';
    }
});

$app ->get('/api/v1/customer/{id}', function(Request $req, Response $res){
    $id = $req->getAttribute('id');
    $sql = "select * from CUSTOMERS WHERE id = $id";
    try {
        $db = new db();
        $db = $db ->connect();
        $stmt = $db->query($sql);
        $customer = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo json_encode($customer);

    } catch (PDOException $e){
        echo '{"error": {"text":'.$e->getMessage().'}';
    }
});

$app ->post('/api/v1/customer/add', function(Request $req, Response $res){
    
    $first_name = $req->getParam('first_name');
    $last_name = $req->getParam('last_name');
    $address = $req->getParam('address');
    $city = $req->getParam('city');
    $state =$req->getParam('state');


    $sql = "INSERT INTO CUSTOMERS VALUES (null, :first_name, :last_name, :address, :city, :state)";
    
    try {
        $db = new db();
        $db = $db ->connect();

        $stmt = $db -> prepare($sql);

        $stmt -> bindParam(':first_name',$first_name);
        $stmt -> bindParam(':last_name',$last_name);
        $stmt -> bindParam(':address',$address);
        $stmt -> bindParam(':city',$city);
        $stmt -> bindParam(':state',$state);

        $stmt -> execute();
        
        echo '{"notice": {"text": "Customer Added"}';

    } catch (PDOException $e){
        echo '{"error": {"text":'.$e->getMessage().'}';
    }
});
