<!-- ログイン画面app.blade.php -->
<?php
$err_msg="";
session_start();
$_SESSION['startTime'] = time();

if(isset($_POST['login'])){
    $nickname = $_POST['nickname'];
    $password = $_POST['password'];
    $_SESSION['password'] = $password;
    $_SESSION['nickname'] = $nickname;
    try {
        $db = new PDO('mysql:host=---; dbname=---; charset=utf8mb4', '---', '---');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $sql = 'SELECT name, pass FROM user where name = :nickname';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt = null;
        $db = null;
        if(isset($result['pass'])){
            if(password_verify($password, $result['pass'])){
                $_SESSION['name'] = $result['name'];
                header('Location:---');
                exit();
            }else{ $err_msg = "アカウント情報が間違っています。";}
        }else{echo "値を取得できませんでした。";}
    }catch (PDOExeption $e) {
        echo "値が入力されていません。\n";
        echo $e->getMessage();
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="apple-touch-icon" href="/apple-touch-icon.png"/>
    <meta name="description" content=""/>
    <title>---</title>
    <style>
        .body{
            background-color: dimgray; 
        }
        .position{
            position: absolute;
            top: 40%;
            left: 43%;
        }
    </style>
</head>
<body class="body">
    <div class="position">
        <h1>ログイン</h1>
        <form action="" method="POST">
            ID:<input type="text" name="nickname"><br>
            Password:<input type="password" name="password"><br>
            <input type="hidden" name="csrf_token" value=""/>
            <input type="submit" value="login" name="login"/>
            <input type="reset" value="reset"/>
            <a href="---" class="fir-pro">初めてのログイン</a>
        </form>
    </div>
</body>
</html>
