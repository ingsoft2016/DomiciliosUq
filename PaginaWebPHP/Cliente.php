<?php
define('DBNAME', "a6251434_Comida");
$dbc = mysqli_connect("mysql6.000webhost.com","a6251434_soto","Ing012345",DBNAME);
if(!$dbc){
	die("Database connection failed :" .mysqli_error($dbc));
	exit();
}
$dbs =mysqli_select_db($dbc,DBNAME);
if (!$dbs) {
	die("Database selection failed : ". mysqli_error($dbc));
	exit();
}
$query="SELECT nombre,email FROM cliente";
$res=mysqli_query($dbc,$query)or die ("error al procesar la consulta");
$cliente=htmlentities($_REQUEST['nombre']);

?>

<html>
<head>
<link rel="stylesheet" href="css\plantilla4.css" type="text/css" media="all">
<title>
Ingenieria de sistemas y computacion 2016 beta  C.sotodd
</title>
</head>

<body>
<h1> Registro Cliente</h1>

  <form name="form3" method="post" action="Cliente.php">

 
   <div> 
 	 <label for = "nombre"> Nombre:</label><input type="text" name="nombre" >
   </div>
  <div>
 	<label for = "Email ">Email </label><input type="text" name="email" >
 </div>

  <div>
  	<label for = "Email ">Password </label><input type="text" name="password" >
  </div>


 <input type= "submit" name="datos" value="Enviar" /><br /><br />
 </form>


 <form name="form1" method="post" action="Cliente.php">

 	<ul>
 
  selecciona Nombre del Cliente e email a modificar:<br>
  <select name="nombre" >
  <option value=" " selected>Elige</option>
  <?php while($row=mysqli_fetch_array($res)){?>
  <option value="<?php echo $row['nombre']?>"><?php echo htmlentities($row['nombre']);?>--<?php echo htmlentities($row['email']);?>
  </option>
   </option>
  <?php } ?>
  </select>
  </li>
  </ul>


 <input type= "submit" name="datos2" value="Modificar cliente" /><br /><br />
 <input type= "submit" name="datos3" value="Eliminar cliente" /><br /><br />
 <input type= "button" name="regresar" onclick=" location.href='pagina1.php'" value="Regresar" /><br /><br />
 </form>
</body>

</html>
<?php


if ($_POST['datos'])
{
  # code...


$nombre = $_POST ['nombre'];
$email= $_POST ['email'];
$password= $_POST ['password'];

$query1 = "INSERT INTO cliente (nombre,email,password) VALUES ('$nombre','$email','$password')";


mysqli_query($dbc,$query1)or die("Query MYSQL ERROR : ".
mysqli_error($dbc));

mysqli_close($dbc);
echo "Los datos han sido insertados en la base de datos";
}
?>


<?php


if(isset($_REQUEST['datos2'])){
$nombre=$_REQUEST['nombre'];
$query="SELECT * from cliente where nombre='$nombre'";
$cierto=mysqli_query($dbc,$query)or die ("error al procesar la consulta");

if(!$cierto){
echo "No existe!";
}

if($row=mysqli_fetch_array($cierto)){
echo  "<form action='Cliente.php' method='post'>
<input type='hidden' name='id_cliente' value='$row[id_cliente]'><br>
<input type='text' name='nombre' value='$row[nombre]'><a>nombre</a><br>
<input type='text' name='email' value='$row[email]'><a>email</a><br>
<input type='text' name='password' value='$row[password]'><a>password</a><br>

<input type='submit' name='Modificar' value='Modificar'>
</form>";

}
}
?>

<?php
if(isset($_REQUEST['Modificar'])){
$id_cliente=$_REQUEST['id_cliente'];
$nombre=$_REQUEST['nombre'];
$email=$_REQUEST['email'];
$password=$_REQUEST['password'];


$queryi="UPDATE cliente set nombre='$nombre',email='$email',password='$password' WHERE id_cliente='$id_cliente'";//consulta sql
$val=mysqli_query($dbc,$queryi)or die ("error al procesar la consulta");
echo "Datos cliente Modificados Correctamente<br><br>";
echo "<a href='Principal1.html'>Regresar</a>";
}

?>
<?php
if(isset($_REQUEST['datos3'])){
$nombre=$_REQUEST['nombre'];

$query="DELETE  from cliente where nombre='$nombre'";
mysqli_query($dbc,$query)or die("Query MYSQL ERROR : ".
mysqli_error($dbc));

mysqli_close($dbc);
echo "Los datos  del cliente han sido borrados en la base de datos";
}
?>
