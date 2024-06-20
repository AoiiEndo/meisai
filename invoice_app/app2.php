<!DOCTYPE html>
<?php
    try { 
        $db = new PDO('mysql:host=---; dbname=---; charset=utf8mb4', '---', '---');
        session_start(); /*セッションを始める。*/
        if(!empty($_POST['name'])) {
            $_SESSION['name']=$_POST['name'];
            if(!empty($_POST['nickname'])) {
                $_SESSION['nickname']=$_POST['nickname'];
                if(!empty($_POST['password'])) {
                    $_SESSION['password']=$_POST['password'];
                    if(!empty($_POST['comment'])) {
                        $_SESSION['comment']=$_POST['comment'];
                        $name = $_SESSION['name'];
                        $nickname = $_SESSION['nickname'];
                        $password = $_SESSION['password'];
                        $comment = $_SESSION['comment'];
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                        $sql = 'SELECT nickname FROM Info WHERE nickname = :nickname';
                        $stmt = $db->prepare($sql);
                        $stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
                        $stmt->execute();
                        $result = $stmt->fetch(PDO::FETCH_ASSOC);
                        if(!empty($result['nickname'])){
                            echo "そのID名は使えません。他のID名を入力してください。";
                        }else{
                            $sql = "INSERT INTO Info(name, nickname, password, comment)
                            VALUES( :name, :nickname, :password, :comment)";
                            $stmt = $db -> prepare($sql);
                            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
                            $stmt->bindValue(':nickname', $nickname, PDO::PARAM_STR);
                            $stmt->bindValue(':password', $password, PDO::PARAM_STR);
                            $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
                            $stmt->execute(); /*上のprepareの中（の$sql）を実行するという意味。*/
                            /*header関数は単体の関数としては無理なので何か関数の中に入れる。　headerの前に画面出力があると上手くいかないので消す。*/
    
                            /*処理が終わったら飛ぶページ*/
                            header('location:---');
                            exit();
                        }
                    }else{ echo 'コメントを入力してください。';}
                }else{ echo 'パスワードを入力してください。';}
            }else{ echo 'IDを入力してください。';}
        }else{ echo '名前を入力してください。';}
    } catch (PDOException $e) {
        echo "DB接続に失敗しました。\n";
        echo $e->getMessage() . "\n";
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf8">
        <title>profile-nameINFO</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="---?<?php echo date('Ymd-Hi');?>" type="text/css">
    </head>
    <body class="body">
        <form method="post">
            <label class="profiletitle">Profile</label>
            <label class="label1">名前</label>
                <h1 class="name">
                    <input type="text" name="name"/>
                </h1>
            <label type="text" class="label2">ID名</label>
                <h2 class="nick-name">
                    <input name="nickname" type="text" oninput="checkForm($this)" placeholder="英数字のみ"/>
                </h2>
            <label type="password" class="password1">パスワード</label>
                <h3 class="password2">
                    <input name="password" type="password" oninput="checkForm($this)" placeholder="英数字のみ" width="50"/>
                </h3>
            <label class="label3">コメント</label>
                <h4 class="inputs3">
                    <textarea name="comment" rows="10" cols="80" id="comment" type="text" placeholder="自己紹介"></textarea>
                </h4>
            <input type="submit" class="btn-area" value="保存"/>
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
