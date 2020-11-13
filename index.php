<?php
session_start();
include 'header.php';
include 'code/function.php';

//recuperer tout les articles
$listArticle = get_all_data($connect, 'articles');

 ?>
   <h3 class="mt-5 mb-3">Nos Articles</h3>
<div class="row">

  <?php
    foreach ($listArticle->fetchAll() as $row) {?>
      <div class="col-md-3">
    <div class="card card-body">
      <h3><?= $row['titre'] ?></h3>
      <p><?= $row['description'] ?></p>
      <?php

      //Obtenir le nombre total de commentaire sur un article
        $total_comment = get_data_condition($connect, 'commentaires', 'article_id', $row['id']);

       ?>
      <b class="text text-center text-bold"> <i class="fa fa-comment"></i> <?= $total_comment->rowCount() ?> commentaire</b>
      <a href="commentaire.php?id=<?= $row['id']?>" class="btn btn-info btn-sm mt-2">Commenter</a>
    </div>
  </div>
    <?php }
   ?>
</div>
