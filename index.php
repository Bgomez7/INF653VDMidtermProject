<?php
/*
It receives 2 parameters: id and model. This lets me use it for any model. 

3 total lines inside the function:
Set the id on the model
Call the read_single method from the model
Return the result

This helper (aka utility) function comes in handy. It's the only one I created in this project. 

This will let you confirm something exists before trying to modify it.


It is your entry point for everything so it does need: 
to set the required headers
to handle OPTIONS requests for CORS
to require the other needed files - sometimes conditionally.
to route to the various methods based on the HTTP method used
Also a good place to get your JSON data decoded. 🙂 
Do things once in this file so you don't have to repeat the same thing multiple times in the methods (read, read_single, etc) 

//http://localhost/MidtermProjectBrayanGomez/api/quotes/update.php

//https://inf653-midtermprojectexample-gitdagray.replit.app/api/authors/
*/

    session_start();
    define('DS', DIRECTORY_SEPARATOR); // '\'
    define('ROOT', dirname(__FILE__)); // D:\xampp\htdocs\MidtermProjectBrayanGomez
    $url = isset($_SERVER['PATH_INFO']) ? echo $_SERVER['PATH_INFO'];
    var_dump($url);

//$method = $_SERVER['REQUEST_METHOD'];
