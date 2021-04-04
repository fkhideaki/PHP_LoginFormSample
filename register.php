<?php
function registerMain()
{
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $dsn = "mysql:host=localhost; dbname=login_test; charset=utf8";
    $username = "root";
    $password = "";
    try {
        $dbh = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        echo($msg);
        return false;
    }
    
    $sql = "SELECT * FROM users WHERE mail = :mail";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $member = $stmt->fetch();
    if ($member && $member['mail'] === $mail) {
        return false;
    }

    $sql = "INSERT INTO users(name, mail, pass) VALUES (:name, :mail, :pass)";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':mail', $mail);
    $stmt->bindValue(':pass', $pass);
    $stmt->execute();
    return true;
}
if (registerMain()) {
    echo('<h1>同じメールアドレスが存在します。</h1>');
    echo('<a href="signup.php">戻る</a>');
} else {
    echo('<h1>登録が完了しました。</h1>');
    echo('<a href="index.php">TOP</a>');
}
?>
