<?php
session_start();
$_SESSION['startTime'] = time();
if(empty($_SESSION)){
    header('location:---');
}
if(isset($_SESSION['startTime']) && (time() - $_SESSION['startTime'] > 14400)){
    session_unset();
    session_destroy();
    header('location:---');
}

    if(isset($_POST['print'])){
        if(isset($_POST['company'])){
            try {
                $company = $_POST['company'];
                $db = new PDO('mysql:host=---; dbname=---; charset=utf8mb4', '---', '---');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $sql = "INSERT INTO ".$_SESSION['name']." (company_name)
                        VALUES(:company)";
                $stmt = $db -> prepare($sql);
                $stmt->bindValue(':company', $company, PDO::PARAM_STR);
                $stmt->execute();
                $stmt = null;
                $db = null;
                header('Location:---');
            }catch (PDOExeption $e) {
                echo "値が入力されていません。\n";
                echo $e->getMessage();
                exit();
            }
        }
    }

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

if(isset($_POST['delete'])){
    if(isset($_POST['company']) && is_array($_POST['company'])){
        foreach($_POST['company'] as $value){
            try{
                $db = new PDO('mysql:host=---; dbname=---; charset=utf8mb4', '---', '---');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $sql = 'DELETE FROM '.$_SESSION['name'].' WHERE id = :id';
                $stmt = $db->prepare($sql);
                $stmt->bindValue(':id', $value, PDO::PARAM_INT);
                $stmt->execute();
                $stmt = null;
                $db = null;
            }catch (PDOExeption $e){
                echo "削除できませんでした。\n";
                echo $e->getMessage();
                exit();
            }
        }
        header('Location:---');
    }else{ echo "会社名が取得できませんでした。";}
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
</head>
<body>
    <div class="app">
        <div class="left_table">
            <div class="">
                <a class="name"><?php echo $_SESSION['name']; ?></a>
                <div class="name_label">
                    <iframe class="receipt2" src="iframe2.php" id="iframe2">表示できませんでした。</iframe>
                </div>
            </div>
            <form class="left_label_position" method="POST">
                <div class="side1">
                    <label class="company_name_label">会社名</label>
                    <a class="star_color">*</a>
                </div>
                <div class="side">
                    <input class="company_name_input input_height" id="company_name_input" type="text" value="" name="company" required/>
                    <a class="unit1">様</a>
                </div>
                <label class="transactions_money_label">取引金額</label>
                <div class="side">
                    <a class="unit2">¥</a>
                    <input class="transactions_money_input input_height" id="transactions_money" type="text"/>
                </div>
                <label class="">日付</label>
                <input type="date" class="calender input_height" id="date_input" value=""/>
                <label class="tax_label">消費税</label>
                <select class="tax2" id="tax">
                    <option value="8%">8%</option>
                    <option value="10%" selected>10%</option>
                    <option value="12%">12%</option>
                </select>
                <input type="submit" value="印刷" id="print" class="print" name="print"/>
            </form>
        </div>
        <div class="right_table">
            <iframe class="receipt" src="iframe.html" id="iframe">表示できませんでした。</iframe>
        </div>
    </div>
    <script src="---"></script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="---"><script>
    <script>

    </script>
</body>
</html>
