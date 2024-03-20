<?php
    class Author {
        // DB Stuff
        private $conn;
        private $table = 'authors';

        // Post Properties
        public $id;
        public $author;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Authors
        public function read() {
            // Create query
            $query = 'SELECT * FROM ' . $this->table;

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Author
        public function read_single() {
            // Create Query
            $query = 'SELECT * FROM ' . $this->table . '
            WHERE
            id = :id
            LIMIT 0,1';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(':id', $this_id);

            // Execute query
            $stmt->execute();
            /*
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties for fetch
            $this->author = $row['author'];     */
            return $stmt;
        }

        // Create Author
        public function create() {
            // Create Query
            $query = 'INSERT INTO ' . $this->table . ' 
            SET 
                author = :author';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->author = htmlspecialchars(strip_tags($this->author));

            // Bind Data
            $stmt->bindParam(':author', $this->author);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Prepare Error
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Update Author
        public function update() {
            // Create Query
            $query = 'UPDATE ' . $this->table . ' 
            SET 
                author = :author 
            WHERE 
                id = :id';


            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->id = htmlspecialchars(strip_tags($this->id));


            // Bind Data
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Prepare Error
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Delete Author
        public function delete() {
            // Create Query
            $query = 'DELETE FROM ' . $this->table . ' Where id = :id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind Param
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Prepare Error
            printf("Error: %s.\n", $stmt->error);

            return false;
        }
    }