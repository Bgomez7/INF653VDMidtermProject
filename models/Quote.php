<?php
    class Quote {
        // DB Stuff
        private $conn;
        private $table = 'quotes';

        // Quote Properties
        public $id;
        public $quote;
        public $author_id;
        public $category_id;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Quotes
        public function read() {
            // Create query
            $query = 'SELECT
                id,
                quote,
                author_id,
                category_id 
                FROM ' . $this->table . ' 
                ORDER BY id DESC';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Get Single Quote
        public function read_single() {
            // Create Query
            $query = 'SELECT
            id,
            quote,
            author_id,
            category_id
            FROM ' . $this->table . '
            WHERE
            q.id = ?
            LIMIT 0,1';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Bind id
            $stmt->bindParam(1, $this_id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set Properties for fetch
            $this->quote = $row['quote'];
            $this->author_id = $row['author_id'];
            $this->category_id = $row['category_id'];

            return $stmt;
        }

        // Create Quote
        public function create() {
            // Create Query
            $query = 'INSERT INTO ' . $this->table . ' 
            SET 
                quote = :quote,
                author_id= :author_id,
                category_id = :category_id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            $this->author_id = htmlspecialchars(strip_tags($this->author_id));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            // Bind Data
            $stmt->bindParam(':quote', $this->quote);
            $stmt->bindParam(':author_id', $this->author_id);
            $stmt->bindParam(':category_id', $this->category_id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Prepare Error
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Update Quote
        public function update() {
            // Create Query
            $query = 'UPDATE ' . $this->table . ' 
            SET 
                quote = :quote
            WHERE 
                id = :id';


            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean Data
            $this->quote = htmlspecialchars(strip_tags($this->quote));
            //$this->author_id = htmlspecialchars(strip_tags($this->author_id));
            //$this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));


            // Bind Data
            $stmt->bindParam(':quote', $this->quote);
            //$stmt->bindParam(':author_id', $this->author_id);
            //$stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Prepare Error
            printf("Error: %s.\n", $stmt->error);

            return false;
        }

        // Delete Quote
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