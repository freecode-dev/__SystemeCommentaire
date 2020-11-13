<!--Fun-Mooc.fr-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>__Commentaire Systeme</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css">
    <script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-white p-2 mb-3 mt-3 shadow">
  <a class="navbar-brand" href="#"> <x class="text text-danger">Free</x>Code </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <!-- Verifier si un utilisateur est connecté-->

      <?php if (isset($_SESSION['id'])) {?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?= $_SESSION['pseudo'] ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="logout.php">deconnexion</a>
        </div>
      </li>
      <?php }else{?>
        <li class="nav-item"><a href="inscription.php" class="nav-link">Rejoindre</a></li>
            <li class="nav-item"><a class="nav-link" href="connexion.php">Se connecter</a></li>

       <?php } ?>

    </ul>

  </div>
</nav>
<body class="container">

</body>
</html>
