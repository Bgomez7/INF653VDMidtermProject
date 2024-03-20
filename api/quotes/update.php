<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
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

    // Set ID to update
    $quote_obj->id = $data->id;
    $quote_obj->quote = $data->quote;

    // Update Quote
    if($quote_obj->update()) {
        // Make JSON for messages (need to be put in array for encode)
        echo json_encode(array('message' => 'Quote Updated'));
    } else {
        echo json_encode(array('message' => 'Quote Not Updated'));
    }
