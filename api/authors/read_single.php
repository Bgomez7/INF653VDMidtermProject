<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Author object
    $author_obj = new Author($db);

    // Get ID
    $author_obj->id = isset($_GET['id']) ? $_GET['id'] : die();

    // author query
    $author_obj->read_single();
    
    // Create Array
    $author_arr = array(
        'id' => $author_obj->id,
        'author' => $author_obj->author
    );

    // Make JSON
    print_r(json_encode($author_arr));
