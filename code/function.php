<?php
  include 'database.php';

  function get_all_data($connect, $table){
    $query = "SELECT * FROM $table ORDER BY id DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    return $statement;
  }
  function get_data_condition($connect, $table, $field, $key){
    $query = "SELECT * FROM $table WHERE $field = ? ORDER BY id DESC";
    $statement = $connect->prepare($query);
    $statement->execute(array($key));
    return $statement;
  }
  function UserExist($connect, $userName){
    $query = "SELECT * FROM users WHERE pseudo = ?";
    $statement = $connect->prepare($query);
    $statement->execute(array($userName));
    return $statement->rowCount();
  }
 ?>
