<?php
  session_start();
  require_once("functions.php");

  if($_SERVER['REQUEST_METHOD'] === 'POST'){
      if(isset($_POST["edit"])){
         if(! empty($_POST["edit"] )) {
            $edit = $_POST["edit"];
            $_SESSION["edit"] = $_POST["edit"];
         } else {
             echo "edit が空エラー";
         }
      } else {
          echo "更新するデータを選択してください\n";
      }
  } else {
    $edit = $_SESSION["edit"];
  }

  $dbh = db_conn();

  try{
    $sql = 'SELECT * FROM user WHERE id = ?';
    $stmt = $dbh->prepare($sql);
    /* (1)ここに適切なバインド処理を追加して下さい  */
    $stmt->bindValue(1,$edit, PDO::PARAM_STR);
    
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

  }catch (PDOException $e){
    echo($e->getMessage());
    die();
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>編集画面</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
       <div>
            <h1>編集画面</h1>
       </div>
    </header>
</div>
<hr>
    <div class="container">
        <form action="confirm_u.php" method="POST" class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="form-group">
                    <label for="name"><span class="required">お名前</span> </label>
                    /* (2)ここに「名前」欄の初期表示処理を追加して下さい  */

                </div>
                <div class="form-group">
                    <label for="email"><span class="required">メールアドレス</span> </label>
                    /* (3)ここに「メールアドレス」欄の初期表示処理を追加して下さい  */

                </div>
                <div class="form-group">
                    <label><span class="required">性別</span> </label>
                    <div>
                    <?php
                          echo "<label class='radio-inline'>";
                          echo "    <input type='radio' name='gender' value='1' required";
                          if( $row[gender] === 1 ) {
　　　　　　　　　　　　　　　　/* (4)ここにラジオボタンの初期表示処理を追加してください  */

                          } else {
                          	 echo ">男性";
                          }
                          echo "</label>";
                          echo "<label class='radio-inline'>";
                          echo "    <input type='radio' name='gender' value='2' required";
                          if( $row[gender] === 2 ) {
　　　　　　　　　　　　　　　　/* (5)ここにラジオボタンの初期表示処理を追加してください  */

                          } else {
                          	 echo ">女性";
                          }
                          echo "</label>";
                          echo "<label class='radio-inline'>";
                          echo "    <input type='radio' name='gender' value='9' required";
                          if( $row[gender] === 9 ) {
　　　　　　　　　　　　　　　　/* (6)ここにラジオボタンの初期表示処理を追加してください  */

                          } else {
                          	 echo ">その他";
                          }
                          echo "</label>";
                       ?>
                    </div>
                </div>
            
                <div class="button-wrapper">
                    <button type="button" onclick="location.href='list_u.php'">戻る</button>
                    <button type="submit" class="btn btn--naby btn--shadow">更新する</button>
                </div>
            </div>
        </form>
    </div>

<hr>
<div class="container">
    <footer>
        <p>CCC.</p>
    </footer>
</div>
</body>
</html>
