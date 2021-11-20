<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<h1 class="text-center">Cadastrar Produto</h1>
<form method="post" class="form-horizontal">
       
 <div class="form-group">
 <label class="col-sm-3 control-label">Nome</label>
 <div class="col-sm-6">
 <input type="text" name="txt_nome" class="form-control" placeholder="Nome" />
 </div>
 </div>
     
 <div class="form-group">
 <label class="col-sm-3 control-label">Marca</label>
 <div class="col-sm-6">
 <input type="text" name="txt_marca" class="form-control" placeholder="Marca" />
 </div>
 </div>

 <div class="form-group">
 <label class="col-sm-3 control-label">Sexo</label>
 <div class="col-sm-6">
 <input type="text" name="txt_sexo" class="form-control" placeholder="Sexo" />
 </div>
 </div>

 <div class="form-group">
 <label class="col-sm-3 control-label">Tamanho</label>
 <div class="col-sm-6">
 <input type="text" name="txt_tamanho" class="form-control" placeholder="Tamanho" />
 </div>
 </div>

 <div class="form-group">
 <label class="col-sm-3 control-label">Quantidade</label>
 <div class="col-sm-6">
 <input type="text" name="txt_quantidade" class="form-control" placeholder="Quantidade" />
 </div>
 </div>

 <div class="form-group">
 <div class="col-sm-offset-3 col-sm-9 m-t-15">
 <input type="submit"  name="btn_register" class="btn btn-primary " value="Cadastrar">
 </div>
 </div>
     
</form>

<?php

require_once "connection.php";

if(isset($_REQUEST['btn_register'])) 
{

 $nome = $_REQUEST['txt_nome'];
 $marca = $_REQUEST['txt_marca'];
 $sexo  = $_REQUEST['txt_sexo']; 
 $tamanho = $_REQUEST['txt_tamanho'];
 $quantidade = $_REQUEST['txt_quantidade'];

  
  try
  { 
   
    $insert_stmt=$db->prepare("INSERT INTO tbl_tenis(Nome, Marca, Sexo, Tamanho, Quantidade) VALUES (:unome, :umarca, :usexo, :utamanho, :uquantidade)"); 
    $insert_stmt->bindParam(":unome",$nome);  
    $insert_stmt->bindParam(":umarca",$marca);  
    $insert_stmt->bindParam(":usexo",$sexo);
    $insert_stmt->bindParam(":utamanho",$tamanho);   
    $insert_stmt->bindParam(":uquantidade",$quantidade);   
   

    if($insert_stmt->execute()){
        $registerMsg="Registrado com sucesso.";
   }
  }

  catch(PDOException $e)
  {
   echo $e->getMessage();
  }
}
?>