<?php

// librairies à linker
//-----------------------//bootstrap
//---https://www.w3schools.com/bootstrap4/bootstrap_get_started.asp

//----------------------// fontawesome
//--https://www.w3schools.com/icons/fontawesome5_intro.asp


//---------------------datatables.net ----https://datatables.net/download/
// prendre bootstrap4
/*
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
*/


//------------------------------//switalert2-----------------
//https://sweetalert2.github.io/  // clique installation

//<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

// 1-------// navbar : dans w3schools bs4 navbar choose collapsing navbar
/*
    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Navbar</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
    </ul>
  </div>
</nav>

*/
// index.html de départ

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <title>Php Poo Greta</title>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#"><i class="fas fa-cog fa-spin"></i>&nbsp;Creamind</a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">A Propos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Contact</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h4 class="text-center text-white font-weight-normal my-3 bg-dark">CRUD Biens à vendre Php Poo</h4>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <h4 mt-2>Tous les articles en vente</h4>
    </div>
    <div class="col-lg-6">
      <button type="button" class="btn btn-info m-1 float-right" data-toggle="modal" data-target="#addModal">
        <i class="fas fa-archive fa-lg"></i>&nbsp;AJOUTER un nouvel article</button>
        <a href="#" class="btn btn-success m-1 float-right">
        <i class="fas fa-table fa-lg"></i>&nbsp;Exporter vers Excel</a>
    </div>
  </div>
  <hr class="my-1">
  <div class="row">
    <div class="col-lg-12">
      <div class="table-responsive" id="showArticles">
          <table class="table table-striped table-sm table-bordered">
            <thead>
              <tr class="text-center">
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Auteur</th>
                <th>Prix (€)</th>
                <th>Action</th>
              </tr>
            </thead>

            <tbody>
              <?php for($i=1;$i<=100;$i++): ?>
              <tr class="text-center 1text-secondary">
                <td><?= $i ?></td>
                <td>Titre <?= $i ?></td>
                <td>Description <?= $i ?></td>
                <td>Auteur <?= $i ?></td>
                <td>34</td>
                <td>
                  <a href="#" title="Voir Détails" class="text-success">
                    <i class="fas fa-info-circle fa-lg"></i>
                  </a>&nbsp;&nbsp;

                  <a href="#" title="Modifier cet élément" class="text-primary">
                    <i class="fas fa-edit fa-lg"></i>
                  </a>&nbsp;&nbsp;

                  <a href="#" title="Supprimer cet élément" class="text-danger">
                    <i class="fas fa-trash-alt fa-lg"></i>
                  </a>&nbsp;&nbsp;

                </td>
              </tr>
            <?php endfor; ?>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>


  <!-- Modal Pour Ajouter un nouvel article  -->
  <div class="modal fade" id="addModal">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ajouter un Nouvel Article</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body px-4">
         <form action="" method="POST" id="form-data">
                <div class="form-group">
                  <input type="text" name="title" class="form-control"
                  placeholder="Titre de l'article" required>
                </div>

                <div class="form-group">
                  <input type="text" name="description" class="form-control"
                  placeholder="Description de l'article" required>
                </div>

                <div class="form-group">
                  <input type="number" name="price" class="form-control"
                  placeholder="Prix de l'article" required>
                </div>

                <div class="form-group">
                  <input type="text" name="author" class="form-control"
                  placeholder="Vendeur" required>
                </div>

                <div class="form-group">
                  <input type="submit" name="insert" id="insert" value="Ajouter l'Article"
                  class="btn btn-danger btn-block">
                </div>
         </form>
        </div>
        
        <!-- Modal footer 
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>-->
        
      </div>
    </div>
  </div>
  

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="appscript.js"></script>
</body>
</html>


























