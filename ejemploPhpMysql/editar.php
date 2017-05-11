<?php
include_once 'libs/PDOConfig.php';
 /**
  * si entra por post actualiza el registro
  */
$base = new PDOConfig();
if($_POST){
   
    /**
     * validar campos
     */
	
    $sql='update noticias set noticia="'.$_POST['noticia'].'" where id='.$_POST['id'];
    
    if ($base->query($sql)) 
	{ 
		echo '<p> Ha actualizado el registro correctamente ';
        echo '<a href="index.php">Lista</a> </p>';
	} 
	else {  
		exit("Error al actualizar el registro. /*** $sql ***/ "); } 
    
}else{
    /**
     * si no entra por post busca el registro y lo muestra en el formulario
     */
    $sql='select * from noticias where id='.$_GET['id'].'';
	$resultado = $base->query($sql);
	
	if (!($fila = $resultado->fetch(PDO::FETCH_ASSOC))){ 
		 exit("Error al buscar el registro. /*** $sql ***/ ");
	}
?>
<form method="post" action="editar.php">
    <input type="hidden" id="id" name="id" value="<?php echo $fila['id'];?>"/><!-- sirve para pasar info interna-->
    <label>Noticia</label><br/>
    <textarea  id="noticia" name="noticia"><?php echo $fila['noticia'];?></textarea><br/>
    <input type="submit"/>
</form>
<?php
}?>