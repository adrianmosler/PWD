<html>
<body>
<?php
if(isset($_POST['psw'])){
  echo 'clave='.md5($_POST['psw']);
}
?>
<form action="encriptaMD5.php" method="post">
Clave: <input type="text" name="psw"><br>
<input type="submit">
</form>
</body>
</html>

