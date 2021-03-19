<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/functions.php';

$page = run();

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Vesti </title>
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />    
  </head>

  <body>

    <header>
      <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 col-md-7 py-4">
              <h4 class="text-white">Zadatak</h4>
              <p class="text-muted">
                    Napravite web sajt i odgovarajući sistem administracije za njega. Za kompletiranje kursa i uspešno završen zadatak, dovoljno je da zadatak obezbeđuje samo osnovne funkcionalnosti. Osnovne funkcionalnosti (maksimalna ocena: 3 zvezdice).
              </p>
            </div>
            <div class="col-sm-4 offset-md-1 py-4">
              <h4 class="text-white">Kontakt</h4>
              <ul class="list-unstyled">
                <li><a href="mailto:ivanaapeiron95@gmail.com" class="text-white">Ivana Vidović</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="?page=index" class="navbar-brand d-flex align-items-center">
              <i class="fas fa-globe"></i>&nbsp;<strong> Vesti</strong>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </header>

    <main role="main">
        <section class="jumbotron text-center">
          <div class="container">
            <h1 class="jumbotron-heading">Vesti</h1>
            <?php if ($member):?>
                <p class="lead text-muted"><?= htmlspecialchars($member['full_name'])?></p>
                <p>
                    <?php if ($member['can_create_post']):?>
                        <a href="?page=new_post" class="btn btn-primary my-2">Nova vest</a>
                    <?php endif;?>
                    <?php if ($member['can_register_member']):?>
                        <a href="?page=register" class="btn btn-secondary my-2">Novi član</a>
                    <?php endif;?>
                    <a href="?page=logout" class="btn btn-secondary my-2">Odjava</a>
                </p>
            <?php else:?>
                <p>
                    <a href="?page=login" class="btn btn-secondary my-2">Prijava</a>
                </p>
            <?php endif;?>
          </div>
        </section>

      <div class="album py-5 bg-light">
        <div class="container">
            
            <?php if (!empty($_SESSION['success'])):?>
                <div class="alert alert-success">
                   <?= success_get_clean() ?>
                </div>
            <?php endif;?>

            <?php if (!empty($_SESSION['error'])):?>
                <div class="alert alert-danger">
                   <?= error_get_clean() ?>
                </div>
            <?php endif;?>            
            
            <?= $page ?>
                          
        </div>
      </div>

    </main>

    <footer class="text-muted">
      <div class="container">
        <p class="float-right">
          <a href="#">Nazad na vrh</a>
        </p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="bootstrap/assets/js/vendor/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bootstrap/assets/js/vendor/holder.min.js"></script>
  </body>
</html>
