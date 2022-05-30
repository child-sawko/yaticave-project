<?php
setcookie('user', $result['name'], time() - 3600, "/");
header('Location: index.php');
?>
