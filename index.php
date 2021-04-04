<?php
session_start();
if (!isset($_SESSION['mail'])) {
    echo('<a href="login_form.php">ログイン</a><br/>');
    echo('<a href="signup.php">新規登録</a>');
} else {
    $username = $_SESSION['name'];
    $name = htmlspecialchars($username, \ENT_QUOTES, 'UTF-8');
    echo('ユーザー:' . $name . '<br/><br/>');
    echo('<a href="logout.php">ログアウト</a>');
}
?>  
