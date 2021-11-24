<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<h2 class="text-center">Pedidos Realizados</h2>

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
 
 session_start();

 require_once 'connection.php';

 $id=$_REQUEST['pedido'];

 $select_stmt=$db->prepare("SELECT tblt.nome, tblt.marca, tblt.Sexo, tblt.Tamanho, tbli.Quantidade FROM `tbl_tenis` as tblt
                            INNER JOIN tbl_item as tbli 
                            on tblt.Id_produto = tbli.Id_produto
                            WHERE tbli.Id_pedido = :vid");
$select_stmt->bindParam(":vid", $id);
$select_stmt->execute();

 while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))
 {
 ?>
        <tr>
            <td><?php echo $row['nome']; ?></td>
            <td><?php echo $row['marca']; ?></td>
            <td><?php echo $row['Sexo']; ?></td>
            <td><?php echo $row['Quantidade']; ?></td>
        </tr>
    <?php
 }
 ?>
   </tbody>
</table> 

<a href="./compras.php" class="btn btn-danger">Voltar</a>