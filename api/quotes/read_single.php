<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Quote object
    $quote_obj = new Quote($db);

    // Get ID
    $quote_obj->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Quote query
    $quote_obj->read_single();
    
    // Create Array
    $quote_arr = array(
        'id' = $quote_obj->id,
        'quote' = $quote_obj->quote,
        'author_id' = $quote_obj->author_id,
        'category_id' = $quote_obj->category_id
    );

    // Make JSON
    print_r(json_encode($quote_arr));
