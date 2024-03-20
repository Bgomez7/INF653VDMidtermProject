<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
    Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Author object
    $author_obj = new Author($db);
    
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $author_obj->id = $data->id;
    $author_obj->author = $data->author;

    // Update author_obj
    if($author_obj->update()) {
        // Make JSON for messages (need to be put in array for encode)
        echo json_encode(array('message' => 'Author Updated'));
    } else {
        echo json_encode(array('message' => 'Author Not Updated'));
    }
