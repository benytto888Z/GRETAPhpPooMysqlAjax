<?php

class Database{

  private $dsn = "mysql:host=localhost;dbname=greta_goodsselling";
  private $user = "root";
  private $pass = "root";
  public $conn;

  public function __construct(){
    try{
      $this->conn = new PDO($this->dsn,$this->user,$this->pass);
     // echo "Connection à la base de données établie avec succès";
    }catch(PDOException $e){
        echo $e->getMessage();
    }
  }

  public function create($title,$description,$price,$author){
    $query = "INSERT INTO articles (title,description,price,author)
            VALUES(:title,:description,:price,:author)";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([
      'title'=>$title,
       'description'=>$description,
       'price'=>$price,
       'author'=>$author
      ]);
      
      return true;
  }

  public function read(){
      $data = array();
      $query = "SELECT * FROM articles";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row){
        $data[] = $row;
      }

      return $data;
  }

  public function getArticleById($id){
    $query = "SELECT * FROM articles WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute(['id'=>$id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }



  public function update($id,$title,$description,$price,$author){
    $query = "UPDATE articles SET title = :title, description = :description, price = :price, author = :author WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([
      'id'=>$id,
      'title'=>$title,
       'description'=>$description,
       'price'=>$price,
       'author'=>$author,
       
      ]);
      
      return true;
  }

  public function delete($id){
    $query = "DELETE FROM articles WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute(['id'=>$id]);
   
    return true;
  }

  public function totalRowCount(){
    $query = "SELECT * FROM articles";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $t_rows = $stmt->rowCount();

    return $t_rows;
  }
}


//$ob = new Database();
//print_r($ob->read());
//echo $ob->totalRowCount();



















