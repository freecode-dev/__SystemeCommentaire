<?php
session_start();
include 'header.php';
include 'code/function.php';

  if (isset($_POST['btn_action'])) {
    $userName = $_POST['userPseudo'];
    $user_exist = get_data_condition($connect, 'users', 'pseudo', $userName);
    $error = '';

    if (!empty($userName))
     {
      if ($user_exist->rowCount() < 1) {
      $error = '<div class="alert alert-danger">Utilisateur inexistant</div>';
    }
    else
    {
      foreach ($user_exist->fetchAll() as $key) {
        $_SESSION['pseudo'] = $key['pseudo'];
        $_SESSION['id'] = $key['id'];
        header('location:index.php');
      }
    }
    }
    else
    {
      $error = '<div class="alert alert-danger">Veuillez remplir les champs</div>';
    }

  }
 ?>

 <div class="card card-body">
  <form  method="post">

    <div class="form-group">
      <div class="row mb-2">
        <div class="col-md-2 " ></div>
        <div class="col-md-8"> <?php if (isset($error)) {
      echo $error;
    } ?> <?php if (isset($success)) {
      echo $success;
    } ?></div>
      </div>
      <div class="row">
      <div class="col-md-2">Pseudo</div>
      <div class="col-md-8"> <input type="text" class="form-control" name="userPseudo" required="" placeholder="votre pseudo..."> </div>
      <div class="col-md-2"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <button type="submit" name="btn_action" class="btn btn-sm btn-group-vertical btn-success">Me connecter</button>
      </div>
      <div class="col-md-2"></div>
    </div>

  </form>
 </div>
<style type="text/css">
  .card{
    width: 600px;
    margin-left: 20%;
    margin-top:10%;

  }
</style>
