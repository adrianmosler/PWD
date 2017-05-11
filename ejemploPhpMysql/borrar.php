<?php
include_once 'libs/PDOConfig.php';

$base = new PDOConfig();
$sql = 'delete from noticias where id=' . $_GET['id'] . '';
$affectedRows = $base->exec($sql); //exec devuelve la cantidad de filas afectadas
echo "<p>Registros eliminados: $affectedRows <a href='index.php'>Lista</a></p>";
?>
