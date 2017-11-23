<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "users";
 
    // object properties
    public $id;
    public $fname;
    public $lname;
    public $pwd;
    public $mail;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
    function read(){
    
        // select all query
        $query = "SELECT
                    u.id, u.fname, u.lname, u.pwd, u.mail
                FROM
                    " . $this->table_name . " u
                ORDER BY
                    u.id DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }


    // create product
    function create(){
    
       // query to insert record
       $query = "INSERT INTO
                   " . $this->table_name . "
               SET
                   fname=:fname, lname=:lname, pwd=:pwd, mail=:mail";
    
       // prepare query
       $stmt = $this->conn->prepare($query);
    
       // sanitize
       $this->fname=htmlspecialchars(strip_tags($this->fname));
       $this->lname=htmlspecialchars(strip_tags($this->lname));
       $this->pwd=htmlspecialchars(strip_tags($this->pwd));
       $this->mail=htmlspecialchars(strip_tags($this->mail));
    
       // bind values
       $stmt->bindParam(":fname", $this->fname);
       $stmt->bindParam(":lname", $this->lname);
       $stmt->bindParam(":pwd", $this->pwd);
       $stmt->bindParam(":mail", $this->mail);
    
       // execute query
       if($stmt->execute()){
           return true;
       }else{
           return false;
       }
    }

    // delete the product
    function delete(){
    
        // delete query
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind id of record to delete
        $stmt->bindParam(1, $this->id);
    
        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }

    // update the product
    function update(){
    
        // update query
        $query = "UPDATE
                    " . $this->table_name . "
                SET
                    fname = :fname,
                    lname = :lname,
                    pwd = :pwd,
                    mail = :mail
                WHERE
                    id = :id";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->fname=htmlspecialchars(strip_tags($this->fname));
        $this->lname=htmlspecialchars(strip_tags($this->lname));
        $this->pwd=htmlspecialchars(strip_tags($this->pwd));
        $this->mail=htmlspecialchars(strip_tags($this->mail));
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // bind new values
        $stmt->bindParam(':fname', $this->fname);
        $stmt->bindParam(':lname', $this->lname);
        $stmt->bindParam(':pwd', $this->pwd);
        $stmt->bindParam(':mail', $this->mail);
        $stmt->bindParam(':id', $this->id);
    
        // execute the query
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // used when filling up the update product form
    function readOne(){
    
        // query to read single record
        $query = "SELECT
                    u.id, u.fname, u.lname, u.pwd, u.mail
                FROM
                    " . $this->table_name . " u
                WHERE
                    u.mail = ?
                LIMIT
                    0,1";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->mail);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->fname = $row['fname'];
        $this->lname = $row['lname'];
        $this->pwd = $row['pwd'];
        $this->id = $row['id'];
    }
}