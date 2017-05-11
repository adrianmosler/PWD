<?php
include_once 'libs/PDOConfig.php';
$base = new PDOConfig();
$sql='select * from noticias';
$resultado = $base->query($sql);

if (!$resultado) { 
	exit("<p>Error en la consulta.</p>"); 
}
else { 
$datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Ejemplo</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<h3>Noticias</h3>
<a href="nuevo.php">nuevo</a>
<table border="1">
<?php	
	foreach ($datos as $row) { 
	    echo '<tr><td style="width:500px;">'.$row['noticia'].'</td>';
    	echo '<td><a href="editar.php?id='.$row['id'].'">editar</a></td>';
    	echo '<td><a href="borrar.php?id='.$row['id'].'">borrar</a></td></tr>'; 
	}
} 
?>
</table>
</body>
</html>