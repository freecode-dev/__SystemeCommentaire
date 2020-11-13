<?php
session_start();
include 'header.php';
include 'code/function.php';

  //recuperer l'id de l'article qui est passé par la method GET dans l'url

  $article_id = $_GET['id'];

  //recuperer l'article en cherchant avec son id
  $selected_article = get_data_condition($connect, 'articles', 'id', $article_id);

    //recuperer les commentaires de l'article concerné
  $article_comment = get_data_condition($connect, 'commentaires', 'article_id', $article_id);
  //boucler pour recuperer les informations de l'articles

  foreach ($selected_article as $key)
   {
    $titre =  $key['titre'];
    $description = $key['description'];
  }

  //Inserer le commentaire de l'utilisateur connecté

  if (isset($_POST['btn_action'])) {

    $commentaire = $_POST['commentaire'];
    if ($commentaire == '') {
      //ne rien faire si l'utilisateur soumet le formulaire sans ecrire un commentaire
    }else{
      $query = "INSERT INTO commentaires(article_id, user_id, commentaire) VALUES(?,?,?)";
        $statement= $connect->prepare($query);
        $statement->execute(array($article_id, $_SESSION['id'], $commentaire));

        //rediriger l'utilisateur sur la même page si le commentaire a été envoyé

        header('location:commentaire.php?id='.$article_id);
    }
  }

 ?>
<div class="article_box mt-5">
  <div class="card card-body shadow">
    <h6><?= $titre ?></h6>
      <p><?= $description ?></p>
  </div>
</div>

<!--Afficher le champs commentaire si l'utilisateur est connecté-->
  <?php
    if (isset($_SESSION['id'])) { ?>
      <div class="user_comment-box">
  <div class="mt-2">
   <form method="post" action="">
     <div class="form-group">
      <input type="hidden" name="article_id" value="<?= $article_id ?>">
       <textarea class="form-control text_area" name="commentaire" placeholder="comment here..."></textarea>
       <button type="submit" name="btn_action" class="btn btn-sm btn-success mt-1">Commenter</button>
     </div>
   </form>
  </div>
</div>
    <?php }else{
      echo "<p class='mt-2'>Vous devez vous connecter pour pouvoir commenter</p>";
    }
   ?>

<div class="mb-5">
  <?php
    if ($article_comment->rowCount() == 0 ) {
      echo "<div class='alert alert-danger'>Aucun commentaire</div>";
    }else{
      echo "<p>Les derniers commentaires</p>";
      foreach ($article_comment as $row) { ?>

      <div class="comment_list mt-3 p-2">
        <?php
          $query = "SELECT * FROM users WHERE id = ? LIMIT 1";
          $statement = $connect->prepare($query);
          $statement->execute(array($row['user_id']));
          foreach ($statement->fetchAll() as $key) {
            $user = $key['pseudo'];
          }
        ?>
        <div class="comment_list-user_section"> <strong><?= $user ?></strong> </div>
        <div class="comment_list-user_section mt-2"> <?= $row['commentaire'] ?> </div>
         <em class="mt-2 text text-right"> <?= date('d-M-y h:i:s', strtotime($row['comment_date'])) ?></em>
      </div>
    <?php } }
   ?>
</div>

<style type="text/css">
  .comment_list{
    display: flex;
    flex-direction: column;
    width: 100%;
    border-radius: 5px;
    background-color: #d6d3d3;
  }
  .text_area{
    width: 400px;
  }

</style>
