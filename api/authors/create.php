<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
    Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate author object
    $author_obj = new Author($db);

    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    
    $author_obj->author = $data->author;

    // Create Post
    if($author_obj->create()) {
        // Make JSON for messages (need to be put in array for encode)
        echo json_encode(array('message' => 'Author Created'));
    } else {
        echo json_encode(array('message' => 'Author Not Created'));
    }
