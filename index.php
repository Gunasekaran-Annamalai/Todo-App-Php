<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TODO</title>
  <link rel="stylesheet" href="./style.css">
</head>
<body>
<?php
include 'connection.php';

class Todo extends connection {
  function __construct() {
    parent::__construct();
  }

  function recover() {
    try {
      $sql = "select * from taskitems";
      $items = $this->conn->query($sql);
      $items->setFetchMode(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
    $row = $items->fetchAll();
    return $row;
  }
}
$todo = new Todo();
?>

  <h1>Todo</h1>
	<form class="form">
		<input class="input" type="text" name="listItem">
		<button id="submit" class="button" type="submit">Add Item</button>
	</form>
  <ul>
  <?php foreach($todo->recover() as $data): ?>
    <li class="items" data-id="<?php echo $data['id'] ?>"><p><?php echo htmlspecialchars($data['task']) ?></p>
      <a class="delete" type="submit" class="delete">Delete</a>
    </li>
  <?php endforeach; ?>
  </ul>

  <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  <script src="script.js"></script>
</body>
</html>