<?php
session_start();
?>


<!doctype html>

<html lang="en">
  <head>
    <title>Registrar o Login de Usuario</title>
    
	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link rel="stylesheet" href="css/custom.css">
  </head>
  <body>
  
  <div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1>PHP MySQL</h1>
			
			</div>
	</div>
	
	<div class="row">	
		<div class="col-sm-12 col-md-6 col-lg-6">
		
		<h3>Usuario</h3><hr />


		<form method="POST" action="index.php" >
<div class="form-group">
	<label for="nombre">Nombre </label>
	<input type="text" name="nombre" class="form-control" id="nombre" >
</div>

<div class="form-group">
	<label for="numero">Telefono </label>
	<input type="text" name="numero" class="form-control" id="numero">
</div>

<center>
<input type="submit" value="Registrar" class="btn btn-success" name="btnregis">
<input type="submit" value="Consulta" class="btn btn-primary" name="btncons">
</center>

</form>

<?php


/* Consultar accion del boton */
include("conn.php");
	
      $nombre ="";
      $numero ="";

      if(isset($_POST['btncons']))
      { 
        $existe = 0;
        $nombre =$_POST['nombre'];
        $numero =$_POST['numero'];

        if($numero=="")// Campo Vacio 
          {
            echo"<script>alert('Se requiere el campo registrado')</script>";
          }
          else
          if( strlen($numero) != 10 ) {   
						echo"<script>alert('Numero invalido no son 10 digitos')</script>";
            exit;
           }
          else
            if(!is_numeric($numero)   ){
						echo"<script>alert('Numero invalido No es Numerico')</script>";
            exit;
           }

          else
          {
            $resultados = mysqli_query($conn, "SELECT * FROM usuario WHERE telefono='$numero'"); 
						while($consulta = mysqli_fetch_array($resultados));
						
						{  
                echo $consulta['nombre']." ";
                echo $consulta['numero']."<br>";
                $existe++;
            }

            if($existe==0)
            {
				
							echo"<script>alert('El contacoto no Existe')</script>";
            }

          }

        
			}


/* Registra accion del boton */
			
      if(isset($_POST['btnregis']))
      {      
       
        $nombre = $_POST['nombre'];
        $numero = $_POST['numero'];

        if($numero=="")// Validacion para evitar mandarlo vacio
          {
					echo"<script>alert('Se requiere Campo')</script>";
          }
          else
          {
     				 mysqli_query($conn, "INSERT INTO usuario (nombre,telefono) values ('$nombre','$numero')");
						echo"<script>alert('Se a Registrado con Exito')</script>";
          }

      }






			
			?>


		</div>		
		<div class="col-sm-12 col-md-6 col-lg-6">
			<h3>Login</h3><hr />
			<p>Ingresa si estas Registrado <a href="captcha.php" title="Login Here">Loging</a></p>
		</div>
	</div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
 
	</body>
</html>