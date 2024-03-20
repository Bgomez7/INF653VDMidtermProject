<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
    Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate quote object
    $quote_obj = new Quote($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    
    $quote_obj->quote = $data->quote;
    $quote_obj->author_id = $data->author_id;
    $quote_obj->category_id = $data->category_id;

    // Create Post
    if($quote_obj->create()) {
        // Make JSON for messages (need to be put in array for encode)
        echo json_encode(array('message' => 'Quote Created'));
    } else {
        echo json_encode(array('message' => 'Quote Not Created'));
    }
