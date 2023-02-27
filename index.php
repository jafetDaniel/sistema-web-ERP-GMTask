<?php
require "bd/conexion.php"; //llamar a la conexion
session_start(); //iniciar session
$mensaje = ""; //mensaje de error cuando se ingresan credenciales incorrectas

if($_POST){//si ya se ingresaron los datos
	$correo = $_POST['correo']; //obtener correo ingresado
	$password = $_POST['password']; //obtener password ingresada

	$sql = "SELECT id_usuario, nombre, apellidos, correo, password, tipo_usuario FROM usuarios WHERE correo ='$correo'"; //generar consulta para obtener datos del usuario

	$resultado = $mysqli->query($sql); //guardar consulta
	$num = $resultado->num_rows; //si la consulta genero resultados

	if($num > 0){ //si devolvio filas la consulta
		$row = $resultado->fetch_assoc();
		$password_bd = $row['password'];

		$pass_cifrado = sha1($password); //cifrar password ingresada
		$mensaje = "";

		if ($password_bd == $pass_cifrado) { //si coinciden la contraseña ingresada con la de la bd
			$_SESSION['nombre'] = $row['nombre']; //obtener valores de la sesion
			$_SESSION['apellidos'] = $row['apellidos'];
			$_SESSION['correo'] = $row['correo'];
			$_SESSION['id'] = $row['id_usuario'];
			$_SESSION['tipo_usuario'] = $row['tipo_usuario'];

			header("Location: loader.php"); //mandar llamar a la siguiente pagina
			$mensaje = "";
		}else{
			$mensaje = "la contraseña es incorrecta";
		}
	}else{
		$mensaje = "el correo es incorrecto";
	}
}
?>
<!-- Autor: Jafet Daniel Fonseca Garcia -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="sistema para el control y gestion de tareas"/>
    <meta name="author" content="jafet daniel fonseca garcia"/>
    <title>Task - login</title>
    <link rel="stylesheet" href="css/estilos_login.css">
</head>
<body>
    <section class="login">
		<div class="login_box">
			<div class="left">
				<div class="contact">
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
						<h3>Iniciar Sesion</h3>
						<input type="email" placeholder="EMAIL" name="correo" required>					
						<input type="password" placeholder="PASSWORD" name="password" required>		
						<h4 style="color: red;"><?php echo $mensaje ?></h4>							
 					    <button class="submit">Ingresar</button>
						<br>
						<a class="small" href="register.php">Crear una nueva cuenta</a>						
 				</form>		
				</div>
			</div>
			<div class="right">
				<div class="right-text">
					<h2>Task</h2>
					<h5>General Motors</h5>
				</div>
			</div>
		</div>
	</section>

	<footer>
			<div class="text-muted">Copyright &copy; Your Website 2022. By Jafet Daniel Fonseca Garcia</div>
	</footer>
</body>
</html>
<!-- Autor: Jafet Daniel Fonseca Garcia -->