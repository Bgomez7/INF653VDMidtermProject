<?php
    class Category {
        // DB Stuff
        private $conn;
        private $table = 'categories';

        // Category Properties
        public $id;
        public $category;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Categories
        public function read() {
            // Create query
            $query = 'SELECT
                id,
                category
                FROM ' . $this->table;

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Category
        public function read_single() {
            // Create Query
            $query = 'SELECT
            id,
            category
            FROM ' . $this->table . '
            WHERE
            id = ?
            LIMIT 0,1';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this_id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties for fetch
            $this->category = $row['category'];

            return $stmt;
        }

        // Create Category
        public function create() {
            // Create Query
            $query = 'INSERT INTO ' . $this->table . ' 
            SET 
                category = :category';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->category = htmlspecialchars(strip_tags($this->category));

            // Bind Data
            $stmt->bindParam(':category', $this->category);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Prepare Error
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Update Category
        public function update() {
            // Create Query
            $query = 'UPDATE ' . $this->table . ' 
            SET 
                category = :category
            WHERE 
                id = :id';


            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->category = htmlspecialchars(strip_tags($this->category));
            $this->id = htmlspecialchars(strip_tags($this->id));


            // Bind Data
            $stmt->bindParam(':category', $this->category);
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Prepare Error
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Delete Category
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