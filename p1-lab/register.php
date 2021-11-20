<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<h1 class="text-center">Cadastro</h1>
<form method="post" class="form-horizontal">
       
 <div class="form-group">
 <label class="col-sm-3 control-label">Nome</label>
 <div class="col-sm-6">
 <input type="text" name="txt_nome" class="form-control" placeholder="Nome" />
 </div>
 </div>
     
 <div class="form-group">
 <label class="col-sm-3 control-label">CPF</label>
 <div class="col-sm-6">
 <input type="text" name="txt_cpf" class="form-control" placeholder="CPF" />
 </div>
 </div>

 <div class="form-group">
 <label class="col-sm-3 control-label">Email</label>
 <div class="col-sm-6">
 <input type="text" name="txt_email" class="form-control" placeholder="Email" />
 </div>
 </div>

 <div class="form-group">
 <label class="col-sm-3 control-label">Telefone</label>
 <div class="col-sm-6">
 <input type="text" name="txt_telefone" class="form-control" placeholder="Telefone" />
 </div>
 </div>

 <div class="form-group">
 <label class="col-sm-3 control-label">CEP</label>
 <div class="col-sm-6">
 <input type="text" name="txt_cep" class="form-control" placeholder="CEP" />
 </div>
 </div>

 <div class="form-group">
 <label class="col-sm-3 control-label">Numero</label>
 <div class="col-sm-6">
 <input type="text" name="txt_numero" class="form-control" placeholder="Numero" />
 </div>
 </div>

 <div class="form-group">
 <label class="col-sm-3 control-label">Complemento</label>
 <div class="col-sm-6">
 <input type="text" name="txt_complemento" class="form-control" placeholder="Complemento" />
 </div>
 </div>
     
 <div class="form-group">
 <div class="col-sm-offset-3 col-sm-9 m-t-15">
 <input type="submit"  name="btn_register" class="btn btn-primary " value="Register">
 </div>
 </div>
    
 <div class="form-group">
 <div class="col-sm-offset-3 col-sm-9 m-t-15">
  Já possui uma conta? <a href="index.php"><p class="text-info">Faça login</p></a>  
 </div>
 </div>
     
</form>

<?php

require_once "connection.php";

if(isset($_REQUEST['btn_register'])) 
{

 $nome = $_REQUEST['txt_nome'];
 $cpf = $_REQUEST['txt_cpf'];
 $email  = $_REQUEST['txt_email']; 
 $telefone = $_REQUEST['txt_telefone'];
 $cep = $_REQUEST['txt_cep'];
 $numero = $_REQUEST['txt_numero'];
 $complemento = $_REQUEST['txt_complemento'];
  
  try
  { 
   $select_stmt=$db->prepare("SELECT email FROM tbl_cliente 
          WHERE email=:uemail"); 
   $select_stmt->bindParam(":uemail",$email); 
   $select_stmt->execute();
   $row=$select_stmt->fetch(PDO::FETCH_ASSOC); 

  if($row["Email"]==$email){
    $errorMsg[]="Email já cadastrado"; 
   }
   
   else if(!isset($errorMsg))
   {
    $insert_stmt=$db->prepare("INSERT INTO tbl_cliente(`Nome`, `CPF`, `Email`, `Telefone`, `CEP`, `Numero`, `Complemento`) VALUES (:unome,:ucpf,:uemail, :utelefone, :ucep, :unumero, :ucomplemento)"); 
    $insert_stmt->bindParam(":unome",$nome);  
    $insert_stmt->bindParam(":ucpf",$cpf);  
    $insert_stmt->bindParam(":uemail",$email);
    $insert_stmt->bindParam(":utelefone",$telefone);   
    $insert_stmt->bindParam(":ucep",$cep);   
    $insert_stmt->bindParam(":unumero",$numero);   
    $insert_stmt->bindParam(":ucomplemento",$complemento);   

    if($insert_stmt->execute()){
        $registerMsg="Registrado com sucesso.";
        header("refresh:2;index.php"); 

    }
    
   }
  }
  catch(PDOException $e)
  {
   echo $e->getMessage();
  }
}
?>