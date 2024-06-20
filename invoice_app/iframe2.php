<?php
session_start();
try{
    $name = $_SESSION['name'];
    $db = new PDO('mysql:host=---; dbname=---; charset=utf8mb4', '---', '---');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $sql = 'SELECT company_name, created, id FROM '.$name.'';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $list = $stmt->fetchAll(PDO::FETCH_BOTH);
    $stmt = null;
    $db = null;
}catch (PDOExeption $e) {
    echo "値が入力されていません。\n";
    echo $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<style>
    .deletebtn{
        position: absolute;
        left: 650px;
    }
    .allcheck{
        position: absolute;
        display: flex;
        left: 500px;
    }
</style>
</head>
<body>
    <button class="allcheck" id="checkbtn">全選択/全解除</button>
    <form method="POST" name="delete" class="deleteForm">
        <input type="submit" id="delete" name="delete" value="削除" class="deletebtn"/>
        <?php foreach($list as $company){ ?>
            <input type="checkbox" name="company[]" value="<?php echo $company['id'] ?>" id="numbers"/> <?php echo $company['company_name']; echo $company['created']; echo "</br>"; ?>
        <?php } ?>
    </form>
    <script>
        const btn = document.querySelector("#checkbtn");
        btn.onclick = unChecked;
        function unChecked() {
            let boxes = document.querySelectorAll('input[type="checkbox"]');
            for (let i = 0; i < boxes.length; i++) {
                boxes[i].checked = false;
                this.onclick = checked;
            }
        }
        function checked() {
            let boxes = document.querySelectorAll('input[type="checkbox"]');

            for (let i = 0; i < boxes.length; i++) {
                boxes[i].checked = true;
                this.onclick = unChecked;
            }
        }
    </script>
</body>
</html>
