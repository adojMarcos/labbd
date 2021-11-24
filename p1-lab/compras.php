<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<h2 class="text-center">Pedidos Realizados</h2>

<table class="table table-striped table-bordered table-hover">
    
    <thead>
        <tr>
            <th>Nota Fiscal</th>
            <th>Data do Pedido</th>
            <th>Detalhes</th>
        </tr>
    </thead>
    <tbody>
 <?php
 
 session_start();

 require_once 'connection.php';

 $select_stmt=$db->prepare("SELECT * from tbl_pedido Where Id_cliente = :id");
 $select_stmt->bindParam(":id", $_SESSION['id']);
 $select_stmt->execute();

 while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
 {
 ?>
        <tr>
            <td><?php echo $row['Numero_nota_fiscal']; ?></td>
            <td><?php echo $row['Data_pedido']; ?></td>
            <td><a href="items.php?pedido=<?php echo $row['Id_pedido']; ?>" class="btn btn-success">Ver items comprados</a></td>
        </tr>
    <?php
 }
 ?>
   </tbody>
</table> 

<a href="./home.php" class="btn btn-danger">Voltar</a>