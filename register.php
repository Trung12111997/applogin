<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<?php
include_once "config.php";
if (isset($_POST) && !empty($_POST)){
    $errors= array();
    if (!isset($_POST["username"]) || empty($_POST["username"])){
        $errors[]="Username chua hợp lệ";

    }
    if (!isset($_POST["password"]) || empty($_POST["password"])){
        $errors[]="password chua hợp lệ";

    }
    if (!isset($_POST["confirmpassword"]) || empty($_POST["confirmpassword"])){
        $errors[]="confirmpassword chua hợp lệ";

    }
    if ($_POST["confirmpassword"] !== $_POST["password"]){
        $errors[]= " confirm password khác password";
    }
    if (empty($errors)){
        $username=$_POST["username"];
        $password=md5($_POST["password"]);
        $creatdate=date("Y-m-d H:i:s");
        $sqlinsert= "INSERT INTO user (username, password, creatdate) VALUES (?,?,?)";
        $stmt = $connection->prepare($sqlinsert);
        $stmt->bind_param("sss", $username, $password, $creatdate);
        $stmt->execute();
        $stmt->close();
        echo "<div class= ' alert alert-success'>";
        echo " Đăng kí thành công. Hãy <a href='login.php'> Đăng nhập </a>ngay lập tức!";
        echo "</div>";



    }else{
        $errors_string=implode("<br>", $errors);
        echo "<div class= ' alert alert-danger'>";
        echo $errors_string;
        echo "</div>";
    }

}
?>
<div class="container" style="margin-top: 150px">
    <div class="row">
        <div class="col-md-12">
            <h1>Đăng kí người dùng</h1>
            <form name="register" action="" method="post">
                <div class="form-group">
                    <label>username</label>
                    <input type="text" class="form-control" placeholder="username" autocomplete="off" name="username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <div class="form-group">
                    <label> confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder=" confirmPassword" name="confirmpassword">
                </div>
                <button type="submit" class="btn btn-primary">Đăng Kí</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>