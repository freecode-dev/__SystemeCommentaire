<?php
include 'header.php';
include 'code/function.php';

  if (isset($_POST['btn_action'])) {
    $userName = $_POST['userPseudo'];
    $email = $_POST['userPassword'];
    $error = '';

    if (!empty($userName) AND !empty($email)) {
      $user_exist = UserExist($connect, $userName);
      if ($user_exist > 0) {
        $error = '<div class="alert alert-danger">Utilisateur existant</div>';
      }else{
        $query = "INSERT INTO users(pseudo, email) VALUES(?,?)";
        $statement= $connect->prepare($query);
        $statement->execute(array($userName, $email));

        $success = '<div class="alert alert-success">Compte crée avec succès</div>';
      }
    }else{
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
      <div class="col-md-8"> <input type="text" class="form-control" name="userPseudo" required=""> </div>
      <div class="col-md-2"></div>
      </div>
    </div>
    <div class="form-group">
      <div class="row">
      <div class="col-md-2">Email</div>
      <div class="col-md-8"> <input type="email" class="form-control" name="userPassword" required=""> </div>
      <div class="col-md-2"></div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8">
        <button type="submit" name="btn_action" class="btn btn-sm btn-group-vertical btn-success">Inscription</button>
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
