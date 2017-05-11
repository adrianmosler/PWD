<?php
/**
 * Si entra por post trata de insertar los campos
 */
if($_POST){
	include_once 'libs/PDOConfig.php';
    /**
     * validar campos
     */
	$base = new PDOConfig();
	
    $sql='insert into noticias (noticia) values ("'.$_POST['noticia'].'")';
    
    if ($base->query($sql)) 
	{ 
		echo '<p>Ha insertado el registro correctamente ';
        echo '<a href="index.php">Lista</a></p>';
	} 
	else {  
		exit("Error al insertar el registro./*** $sql ***/ "); } 
    
}else{
    /**
     * si no entra por post muestra el formulario
     */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//ES" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Ejemplo</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<form method="post" action="nuevo.php">
    <label>Noticia</label><br/>
    <textarea  id="noticia" name="noticia"></textarea><br/>
    <input type="submit">
</form>
</body>
</html>
<?php
}?>