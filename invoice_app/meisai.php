<?php
    session_start();
    $yearMax = date('Y');
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST['year_value'], $_POST['key']) && $_SESSION['key'] == $_POST['key']){
            unset($_SESSION['key']);
            $year = $_POST['year_value'];
        }else{
            $number = rand(0, 100);
            header('location:---?'.$number.'');
        }
    }else{
        $year = date('Y');
    }
    $_SESSION['key'] = rand(0, 100);
    if(empty($_SESSION)){
        header('location:---');
    }
    if(isset($_SESSION['startTime']) && (time() - $_SESSION['startTime'] > 14400)){
        session_unset();
        session_destroy();
        header('location:---');
    }

    try{
        $name = $_SESSION['name'];
        $db = new PDO('mysql:host=---; dbname=---; charset=utf8mb4', '---', '---');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $sql = 'SELECT id, username, companyname, price, tax, createdat FROM meisaiInfo WHERE year = :year';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':year', $year, PDO::PARAM_INT);
        $stmt->execute();
        $list = $stmt->fetchAll(PDO::FETCH_BOTH);
        $stmt = null;
        $db = null;
    }catch (PDOExeption $e) {
        echo "値が取得できませんでした。リロードしてください。\n";
        echo $e->getMessage();
        exit();
    }
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>---</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"/>
    <link href="/css/support.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="styleshhe"/>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14"></script>
    <link href="/css/support.css" rel="stylesheet"/>
    <link href="/css/meisai.css" rel="stylesheet"/>
</head>
<body>
    <div class="app">
        <div class="left_table">
            <label>明細一覧表示</label>
            <form action="---">
                <button>明細作成</button>
            </form>
            <form action="---" method="POST">
                <select name="year_value" class="year_selectbox">
                    <option value="<?php echo $year?>" selected><?php echo $year;?><option>
                    <?php 
                        for($i=2022;$i<=$yearMax;$i++){
                            echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                    ?>
                </select>
                <input type="hidden" name="key" value="<?php echo htmlspecialchars( $_SESSION['key'], ENT_QUOTES);?>"/>
                <button type="submit">検索</button>
            </form>
            <div class="output_name">
                <a class="number"></a>
                <a class="user">担当者</a>
                <a class="output_company">会社名</a>
                <a class="plaice" style="position:relative; left:17px;">金額(円)</a>
                <a class="tax_event">消費税(%)</a>
                <a class="time">登録日時</a>
            </div>
            <?php
                foreach($list as $row){
                    echo"<div class='border_bottom' onclick='meisai(";echo $row['id'];echo")'>";
                        echo"<div class='INFO'>";
                            echo "<div class='id'>";
                                echo $row['id'];
                            echo "</div>";
                            echo"<div class='username' id='username";echo $row['id']; echo"'>";
                                echo $row['username'];
                            echo "</div>";
                            echo"<div class='companyname' id='companyname";echo $row['id']; echo"'>";
                                echo $row['companyname'];
                            echo"</div>";
                            echo"<div class='price_position' id='price_position";echo $row['id'];echo"'>";
                                echo $row['price'];
                            echo "</div>";
                            echo"<div class='tax_position' id='taxtax";echo $row['id'];echo"'>";
                                echo $row['tax'];
                            echo"</div>";
                            echo"<div class='createdat' id='createdat";echo $row['id'];echo"'>";
                                echo $row['createdat'];
                            echo "</div>";
                            echo"<br />";
                        echo "</div>";
                    echo"</div>";
                }
            ?>
        </div>
        <div class="right_table">
            <iframe class="receipt" src="iframe.html" id="iframe">表示できませんでした。</iframe>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="---"></script>
</body>
</html>
