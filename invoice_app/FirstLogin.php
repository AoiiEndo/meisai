<!DOCTYPE html>
<?php
    try { 
        $db = new PDO('mysql:host=---; dbname=---; charset=utf8mb4', '---', '---');
        session_start(); /*セッションを始める。*/
        if(!empty($_POST['nickname'])) {
            $_SESSION['nickname']=$_POST['nickname'];
            if(!empty($_POST['password'])) {
                $_SESSION['password']=$_POST['password'];
                $nickname = $_SESSION['nickname'];
                $password = password_hash($_SESSION['password'], PASSWORD_DEFAULT);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $sql = 'SELECT name FROM user WHERE name = :nickname';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if(!empty($result['name'])){
                    echo "そのID名は使えません。他のID名を入力してください。";
                }else{
                    $sql = "INSERT INTO user(name, pass)
                    VALUES(:nickname, :password)";
                    $stmt = $db -> prepare($sql);
                    $stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
                    $stmt->bindValue(':password', $password, PDO::PARAM_STR);
                    $stmt->execute(); /*上のprepareの中（の$sql）を実行するという意味。*/
                    /*header関数は単体の関数としては無理なので何か関数の中に入れる。　headerの前に画面出力があると上手くいかないので消す。*/
                    if(isset($nickname)){
                        $sql1 = 'CREATE TABLE '.$nickname.' (
                            id INT(11) AUTO_INCREMENT PRIMARY KEY,
                            company_name VARCHAR(20),
                            created TIMESTAMP NOT NULL
                        )';
                        $stmt = $db->prepare($sql1);
                        $stmt->execute();

                        /*処理が終わったら飛ぶページ*/
                        header('location:---');
                        exit();
                    }
                }
            }else{ echo 'パスワードを入力してください。';}
        }else{ echo 'IDを入力してください。';}
    } catch (PDOException $e) {
        echo "DB接続に失敗しました。\n";
        echo $e->getMessage() . "\n";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
    <!--このページの情報--->
        <meta charset="utf8"/>
        <title>---</title>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <style>
            .body{
                background-color: dimgray;
            }
            .post{
                position: absolute;
                top: 40%;
                left: 43%;
            }
        </style>
    </head>
    <body class="body">
        <form method="post" class="post">
            <label type="text" class="label2">ID名</label>
            <h2 class="nick-name">
                <input name="nickname" type="text" oninput="checkForm($this)" placeholder="英数字のみ"/>
            </h2>
            <label type="password" class="password1">パスワード</label>
                <h3 class="password2">
                    <input name="password" type="password" oninput="checkForm($this)" placeholder="英数字のみ" width="50"/>
                </h3>
            <input type="submit" class="btn-area" value="登録"/>
        </form>
        <script type="text/javascript">
            function checkForm($this) {
                var str= $this.value;
                while(str.match(/[^A-Z^a-z\d\-]/)) {
                    str=str.replace(/[^A-Z^a-z\d\-]/,"");
                }
                $this.value=str;
            }
        </script>
    </body>
</html>
