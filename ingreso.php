<?php
session_start();
?>

<!doctype html>
<html lang="en">
	<head>
		<title>Check Login and create session</title>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="dist/jquery.tabledit.js"></script>
<script type="text/javascript" src="custom_table_edit.js"></script>
	
	</head>
	<body>
		<div class="container">
		
			<?php
			// Conexion 
			include 'conn.php';	
		  
			// revisamos conexion a la base de datos su no mandamos un mysqli_connect_error erorr y cierra secion
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Datos enviados del formulario captcha.html 
			$email = $_POST['email']; 
			$password = $_POST['pass'];
			
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);

			// Query a la base de datos
			$result = mysqli_query($conn, "SELECT email, password FROM tblagenda WHERE 
			email = '$email' and password = '$password'");
			


		if($result->num_rows > 0)
			{
         		//Reupera los datos y almacen en una variable 
				$row = mysqli_fetch_assoc($result);

				$_SESSION['loggedin'] = true;
			    $_SESSION['email'] = $row['email'];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (5 * 60) ;						
				
				
				echo "<div class='alert alert-success mt-4' role='alert'> <strong>Hola Bienvenido!</strong> $row[email]			
				<p><a href='logout.php'>Salir</a></p></div>";


				function consulta () {
					include("conn.php");
					if($conn->connect_error){
							die('Error de conexion: '.$conn->connect_error);
						}else{
							$sql="SELECT * FROM usuario";
							$resul=mysqli_query($conn,$sql);
							echo "<table class='table' border='1'>";
							echo "<tr><td colspan='6' align='center'><b>Usuarios Registrados</b></td></tr>";
							echo "<tr><th>ID</th><th>Nombre</th><th>Telefono</th><th>Editar Usuario</th><th>Eliminar Usuario</th></tr>";
							
							while($linea=mysqli_fetch_array($resul)){
							echo "<tr>";
								echo "<td>",$linea['id'],"</td>";
								echo "<td>",$linea['nombre'],"</td>";
								echo "<td>",$linea['telefono'],"</td>";
								?>
	
								<form action="http://localhost:8080/articulos/editar.php" method="post">
								<input type="hidden" name="id" value="<?php $id ?>"/>
								</form><?php
								echo "<td><button type='button' class='btn btn-warning'><a href='editarcelda.php?id=id'>EDITAR</a></button></td>";
								echo "<td><button type='button' class='btn btn-danger'><a href='eliminar.php?id=id'>ELIMINAR</a></button></td>";
								echo "</tr>";
							}
						}
						}
					echo consulta();

			
		}

		
		else {
				
				echo "<div class='alert alert-danger mt-4' role='alert'>Email o Password es incorrecto! 
				<p><a href='captcha.php'><strong>Ingresa Nuevamente!</strong></a></p></div>";	

			}

	
		
								?>








		</div>



		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>

		


	</body>
</html>