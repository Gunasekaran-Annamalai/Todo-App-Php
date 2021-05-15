<?php

class Connection {
  function __construct() {
    $this->servername = "localhost";
    $this->username = "root";
    $this->password = "";
    $this->database = "project 1-todo";
    $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
  }
}

?>