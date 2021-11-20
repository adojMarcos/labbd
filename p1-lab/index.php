<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<h1 class="text-center">Login</h1>  
<form method="post" class="form-horizontal">
 
 <div class="form-group">
 <label class="col-sm-3 control-label">Email</label>
 <div class="col-sm-6">
 <input type="text" name="txt_email" class="form-control" placeholder="Digite seu email" />
 </div>
 </div>
     
 <div class="form-group">
 <div class="col-sm-offset-3 col-sm-9 m-t-15">
 <input type="submit" name="btn_login" class="btn btn-success" value="Login">
 </div>
 </div>
    
 <div class="form-group">
 <div class="col-sm-offset-3 col-sm-9 m-t-15">
 Ainda não possui uma conta? <a href="register.php"><p class="text-info">Cadastre-se Agora</p></a>  
 </div>
 </div>
     
</form>



<?php
require_once 'connection.php';

session_start();

if(isset($_SESSION["cliente_login"])) 
{
 header("location: home.php"); 
}


if(isset($_REQUEST['btn_login']))
{
    echo 'a';
 $email  =$_REQUEST["txt_email"]; 
 $id = 0;
  
 if(empty($email)){      
  $errorMsg[]="Informe um email"; 
 }
 else if($email)
 {
     echo $email;
  try
  {
   $select_stmt=$db->prepare("SELECT * FROM tbl_cliente
          WHERE
          email=:uemail"); 
   $select_stmt->bindParam(":uemail",$email);
   $select_stmt->execute(); 
     
   while($row=$select_stmt->fetch(PDO::FETCH_ASSOC)) 
   {
       echo "a";
    $dbId = $row["Id_cliente"];
    $dbemail =$row["Email"];
   }
   if($email!=null) 
   {
    if($select_stmt->rowCount()>0) 
    {
     if($email==$dbemail)
     {
        $_SESSION["cliente_login"]=$email;  
        $_SESSION["id"]=$dbId;
        $loginMsg="Logado com sucesso..."; 
        header("refresh:1;./home.php");     
     }
     else
     {
      $errorMsg[]="email não encontrado";
     }
    }
    else
    {
     $errorMsg[]="email não encontrado";
    }
   }
   else
   {
    $errorMsg[]="email não encontrado";
   }
  }
  catch(PDOException $e)
  {
   $e->getMessage();
  }  
 }
 else
 {
  $errorMsg[]="email não encontrado";
 }
}
?>
