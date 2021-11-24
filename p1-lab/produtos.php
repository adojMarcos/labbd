<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<h2 class="text-center">Comprar</h2>

<table class="table table-striped table-bordered table-hover">
    
    <thead>
        <tr>
            <th>Nome</th>
            <th>Marca</th>
            <th>Sexo</th>
            <th>Tamanho</th>
            <th>Comprar</th>
        </tr>
    </thead>
    <tbody>
 <?php
 
 session_start();

 require_once 'connection.php';

 $select_stmt=$db->prepare("SELECT * from tbl_tenis Where Quantidade > 0");
 $select_stmt->execute();

 while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
 {
 ?>
        <tr>
            <td><?php echo $row['Nome']; ?></td>
            <td><?php echo $row['Marca']; ?></td>
            <td><?php echo $row['Sexo']; ?></td>
            <td><?php echo $row['Tamanho']; ?></td>
            <td><a href="?comprar=<?php echo $row['Id_produto']; ?>" class="btn btn-warning">Adicionar ao carrinho</a></td>
        </tr>
    <?php
 }
 ?>
   </tbody>
</table> 

<h2 class="text-center">Items comprados</h2>

<table class="table table-striped table-bordered table-hover">
    
    <thead>
        <tr>
            <th>Nome</th>
            <th>Marca</th>
            <th>Sexo</th>
            <th>Tamanho</th>
        </tr>
    </thead>
    <tbody>
<?php 

 $selectc_stmt=$db->prepare("SELECT tblt.nome, tblt.marca, tblt.Sexo, tblt.Tamanho, tbli.Quantidade FROM `tbl_tenis` as tblt
                            INNER JOIN tbl_item as tbli 
                            on tblt.Id_produto = tbli.Id_produto
                            WHERE tbli.Id_pedido = :vid");

$selectc_stmt->bindParam(":vid", $_SESSION['idPedido']);
$selectc_stmt->execute();

while($row=$selectc_stmt->fetch(PDO::FETCH_ASSOC))
{
?>
       <tr>
           <td><?php echo $row['nome']; ?></td>
           <td><?php echo $row['marca']; ?></td>
           <td><?php echo $row['Sexo']; ?></td>
           <td><?php echo $row['Tamanho']; ?></td>
       </tr>
   <?php
}
?>
  </tbody>
</table> 

<?php
    if(isset($_REQUEST['comprar']))
    {

     $id=$_REQUEST['comprar']; 
      
     $insert=$db->prepare('INSERT INTO tbl_item (Id_pedido, Id_produto, Quantidade) VALUES (:iid, :iidp, 1)');
     $insert->bindParam(":iid", $_SESSION['idPedido']);
     $insert->bindParam(":iidp" , $id);
     $insert->execute();
       
     $update=$db->prepare("UPDATE tbl_tenis SET Quantidade = Quantidade - 1 WHERE Id_produto = :tid");
     $update->bindParam(":tid" , $id);
     $update->execute();
     header("Location:produtos.php");
      
    }
?>



<a href="./home.php" class="btn btn-danger">Finalizar compra</a>