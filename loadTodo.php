<?php

include 'connection.php';

class TodoApplication extends Connection {

  function __construct() {
    parent::__construct();
  }
  function retrieve() {
    try {
      $this->conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "select * from taskitems";
      $items = $this->conn->query($sql);
      $items->setFetchMode(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
    $row = $items->fetchAll();
    return $row;
  }

  function load($item) {
    try {
      $this->conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $this->conn->prepare("insert into taskitems (task) values (:item)");
      $stmt->execute([':item' => $item]);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}

if($_SERVER["REQUEST_METHOD"] === "POST") {
  $todo = new TodoApplication();
  $todo->load($_POST['item']);
  $last_item = $todo->retrieve();
  $data = $last_item[count($last_item)-1];
  echo json_encode($data);
}

?>