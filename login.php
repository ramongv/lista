<?php

session_start();
if (isset($_SESSION["user"])) {
  header("location:index.php");
}

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" type="image/png" href="logos/favicon.png"/>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <script src="js/jquery-3.2.0.min.js" charset="utf-8"></script>
    <script src="bootstrap/js/bootstrap.min.js" charset="utf-8"></script>
  </head>
  <body>
    <div class="container">
    <img src="logos/Logo_principal_192_137.png" WIDTH="192" HEIGHT="137">



</div>
    <div class="container">

      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <form method="post" >
            <h1><p class="text-center">Login</p></h1>
            <div class="form-group">
              <label for="user">Usuario</label>
              <input type="text" name="user" id="user" class="form-control">
            </div>
            <div class="form-group">
              <label for="pass">Password</label>
              <input type="password" name="pass" id="pass" class="form-control">
            </div>
            <div class="form-group">
              <input type="button" name="login" id="login" value="Iniciar sesion" class="btn btn-success">
            </div>
            <br>
            <span id="result"></span>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
<script>
$(document).ready(function() {
    $('#login').click(function(){
      var user = $('#user').val();
      var pass = $('#pass').val();
      if($.trim(user).length > 0 && $.trim(pass).length > 0){
        $.ajax({
          url:"service/auth.php",
          method:"POST",
          data:{user:user, pass:pass},
          cache:"false",
          beforeSend:function() {
            $('#login').val("Conectando...");
          },
          success:function(data) {
            console.log(data);
            $('#login').val("Login");
            if (data=="1") {
              $(location).attr('href','registro.php');
            } else {
              if (data=="admin1") {
$(location).attr('href','ad.php');
              }else{
              $("#result").html("<div class='alert alert-dismissible alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button><strong>¡Error!</strong> las credenciales son incorrectas.</div>");
            }}
          }
        });
      };
    });
  });
</script>
