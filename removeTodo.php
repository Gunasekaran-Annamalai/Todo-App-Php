<?php

include 'connection.php';

class Remove extends Connection {
  function __construct($id) {
    parent::__construct();
    $this->id = $id;
    try {
      $del = $this->conn->prepare("delete from taskitems where id=(:id)");
      $del->execute([':id'=>$this->id]);
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
  new Remove($_POST["id"]);
  echo "success";
}

?>