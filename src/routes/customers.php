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