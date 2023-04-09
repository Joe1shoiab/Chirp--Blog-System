<?php

class Post {

    private $pdo;
    private $DBTable = "posts";
    public $id;


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function createPost($title, $content, $author_id)
    {    
        try
        {
            $query = "INSERT INTO ". $this->DBTable ." (title, content, user_id) VALUES (:title, :content, :author_id);";

            $stmt = $this->pdo->prepare($query);
            //$values=array(':title' => $title, ':content' => $content, ':author_id' => $author_id);
            
            // Bind the values to the placeholders in the prepared statement
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':author_id', $author_id);
            $stmt->execute();

            return true;

        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            return false;
        }

    }

    public function readAllPosts()
    {   
        $query = 'SELECT ' . $this->DBTable . '.* , user.username FROM ' . $this->DBTable . ' LEFT JOIN user
        ON(' . $this->DBTable . '.user_id = user.userID
        )ORDER BY ' . $this->DBTable . '.created_at DESC' ;

        try {
            $stmt = $this->pdo->prepare($query);

            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $results;
        }
        catch(PDOException $e)
         {
            echo $e ->getMessage();
            return false;
        }



    }

    function readPost($id) //reads the post with that id
    {
        $query = "SELECT p.title, p.content , p.user_id , p.created_at, u.username as author_name 
        FROM " . $this->DBTable . " p INNER JOIN user u
        ON p.user_id = u.userID WHERE p.id = ?";

        
        try{

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return $row;

        } catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }      
        

    }

    function delete($id)   // Delete an existing post
    {
        $query = "DELETE FROM " . $this->DBTable . " WHERE id=:id";


        try {

            $stmt = $this->pdo->prepare($query);
            $id = htmlspecialchars(strip_tags($id));
            $stmt->bindParam(":id", $id);
            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    
    function update($title, $content, $id) // Update an existing post
    {
        $query = "UPDATE " . $this->DBTable . " SET title=:title, content=:content WHERE id=:id";

        $stmt = $this->pdo->prepare($query);

        // Clean data
        $title = htmlspecialchars(strip_tags($title));
        $content = htmlspecialchars(strip_tags($content));
        $id = htmlspecialchars(strip_tags($id));

        // Bind the data
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":id", $id);

        // Execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

}


?>