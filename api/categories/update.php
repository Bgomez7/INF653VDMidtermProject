<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,
    Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate categories object
    $category_obj = new Category($db);
    
    // Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // Set ID to update
    $category_obj->id = $data->id;
    
    $category_obj->category = $data->category;

    // Update Category
    if($category_obj->update()) {
        // Make JSON for messages (need to be put in array for encode)
        echo json_encode(array('message' => 'Category Updated'));
    } else {
        echo json_encode(array('message' => 'Category Not Updated'));
    }
