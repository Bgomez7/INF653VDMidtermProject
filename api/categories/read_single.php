<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    // Instantiate DB & Connect
    $database = new Database();
    $db = $database->connect();

    // Instantiate Category object
    $category = new Category($db);

    // Get ID
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Category query
    $category->read_single();
    
    // Create Array
    $category_arr = array(
        'id' = $category->id,
        'category' = $category->categories
    );

    // Make JSON
    print_r(json_encode($category_arr));
