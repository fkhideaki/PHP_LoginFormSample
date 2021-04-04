<?php
session_start();
$_SESSION = array();
session_destroy();
?>

<p>ログアウトしました。</p>
<a href="index.php">TOP</a>
