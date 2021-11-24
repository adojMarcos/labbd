<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<center>
    
 <h3>
 <?php
  session_start();

  require_once "connection.php";
  
  if(isset($_SESSION['cliente_login']))
  {
  ?>
   Bem vindo,
  <?php


   echo $_SESSION["cliente_login"];
  }
 
  ?>

 </h3>
  
  <form method="post" class="form-horizontal">
  <div class="form-group">
    <a href="logout.php" class="btn btn-danger">Logout</a>
  </div>
  <div class="form-group">
      <input type="submit" name="btn_comprar" class="btn btn-success" value="Comprar">      
  </div>
  <a href="compras.php" class="btn btn-info">Ver compras</a>
  </form>
</center>

<?php 

require_once "connection.php";

if(isset($_REQUEST['btn_comprar'])){


  $data = date('Y-m-d');
  $nota = rand(1000, 10000);

  $insert_stmt=$db->prepare("INSERT INTO tbl_pedido (Numero_nota_fiscal, Data_pedido, Id_cliente) VALUES (:vnota, :vdata, :vid)"); 
  $insert_stmt->bindParam(":vnota",$nota);  
  $insert_stmt->bindParam(":vdata",$data);  
  $insert_stmt->bindParam(":vid",$_SESSION['id']);  

  if($insert_stmt->execute()){
    $idPedido = $db->lastInsertId();
    $_SESSION['idPedido'] = $idPedido;
    header("refresh:1;produtos.php"); 
  }
}







?>