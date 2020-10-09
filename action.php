<?php

require_once 'db.php';
$db = new Database();

if(isset($_POST['action']) && $_POST['action'] == 'view' ){
  $output = '';
  $data = $db->read();
  //print_r($data);

  if($db->totalRowCount()>0){
    $output .='
    <table class="table table-striped table-sm table-bordered">
    <thead>
      <tr class="text-center">
        <th>ID</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Prix (€)</th>
        <th>Auteur</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
    ';

    foreach($data as $row){
      $output .=' <tr class="text-center 1text-secondary">
      <td>'.$row['id'].'</td>
      <td>'.$row['title'].'</td>
      <td>'.$row['description'].'</td>
      <td>'.$row['price'].'</td>
      <td>'.$row['author'].'</td>

      <td>
      <a href="#" title="Voir Détails" class="text-success infoBtn" id="'.$row['id'].'">
        <i class="fas fa-info-circle fa-lg"></i>
      </a>&nbsp;&nbsp;

      <a href="#" title="Modifier cet élément" class="text-primary editBtn"
      data-toggle="modal" data-target="#editModal" id="'.$row['id'].'">
        <i class="fas fa-edit fa-lg"></i>
      </a>&nbsp;&nbsp;

      <a href="#" title="Supprimer cet élément" class="text-danger delBtn" id="'.$row['id'].'">
        <i class="fas fa-trash-alt fa-lg"></i>
      </a>&nbsp;&nbsp;

    </td></tr>';
    }

    $output .= '</tbody></table>';
    echo $output;
  }else{
    echo '<h3 class="text-center text-secondary mt-5">:( Aucun utilisateur pour le moment</h3>';
  }
}

// creation
if(isset($_POST['action']) && $_POST['action']=='insert'){
 
  
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $author = $_POST['author'];
  
  $db->create($title,$description,$price,$author);
}


if(isset($_POST['edit_id'])){
  $id = $_POST['edit_id'];
  $row = $db->getArticleById($id);
  echo json_encode($row);// response retournée

}

// modification
if(isset($_POST['action']) && $_POST['action']=='update'){

  
  $id = $_POST['id'];
  
  $title = $_POST['title'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $author = $_POST['author'];
  //echo($description);
  $db->update($id,$title,$description,$price,$author);
}


// suppression
if(isset($_POST['del_id'])){
  $id = $_POST['del_id'];
  //echo($id);
  $db->delete($id);
}


// suppression
if(isset($_POST['info_id'])){
  $id = $_POST['info_id'];
  $row = $db->getArticleById($id);
  echo json_encode($row);
}

// exporter vers excel
if(isset($_GET['export']) && $_GET['export']=='excel'){
  header("Content-Type: application/xls");
  header("Content-Dispositiob: attachement; filename=articles.xls");
  header("Pragma: no-cache");
  header("Expires: 0");

  $data = $db->read();
  echo '<table border="1">';
  echo '<tr><th>ID</th><th>Titre</th><th>Description</th><th>Prix</th><th>Auteur</th></tr>';
  foreach ($data as $row) {
   echo '<tr>
   <td>'.$row['id'].'</td>
   <td>'.$row['title'].'</td>
   <td>'.$row['description'].'</td>
   <td>'.$row['price'].'</td>
   <td>'.$row['author'].'</td>
   </tr>';
  }
}