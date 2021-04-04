<?php
function loginMain()
{
    session_start();
    $username = "root";
    $password = "";
    try {
        $dsn = "mysql:host=localhost; dbname=login_test; charset=utf8";
        $dbh = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $msg = $e->getMessage();
    }

    if (!array_key_exists('mail', $_POST))
        return False;
    $mail = $_POST['mail'];
    if (!array_key_exists('pass', $_POST))
        return False;
    $pass = $_POST['pass'];
    $sql = "SELECT * FROM users WHERE mail = :mail";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $member = $stmt->fetch();
    if (!$member)
        return false;
    if (!password_verify($pass, $member['pass']))
        return false;
    $_SESSION['mail'] = $member['mail'];
    $_SESSION['name'] = $member['name'];
    return true;
}

if (loginMain()) {
    echo('<h1>ログインしました。</h1>');
    echo('<a href="index.php">ホーム</a>');
} else {
    echo('<h1>メールアドレスもしくはパスワードが間違っています。</h1>');
    echo('<a href="login_form.php">戻る</a>');
}
?>
