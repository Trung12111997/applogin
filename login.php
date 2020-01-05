<?php
session_start();
//if (!isset($_SESSION["loggedin"]) && ($_SESSION["loggedin"] != true)){
//    header("Location: index.php");
//    exit;
//}

include_once "config.php";
$errors= array();
if (isset($_POST) && !empty($_POST)){
    if (!isset($_POST["username"]) && empty($_POST["username"])){
        $errors[]=" Chưa nhập username";
    }
    if (!isset($_POST["password"]) && empty($_POST["password"])){
        $errors[]=" Chưa nhập password";
    }
    if( is_array($errors)&& empty($errors)){
        $username= $_POST["username"];
        $password= md5($_POST["password"]);
        $sqlogin=" SELECT * FROM user WHERE  username = ? AND password = ?";
        $stmt = $connection->prepare($sqlogin);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $res=$stmt->get_result();
       $row=$res->fetch_array(MYSQLI_ASSOC);
       if (isset($row['id'])&& ($row['id']>0)){
           $_SESSION["loggedin"]=true;
           $_SESSION["username"]=$row['username'];
           header("Location: index.php");
           exit;
       }
       else{
           $errors[]=" dữ liệu bạn nhập không đúng";
       }
//        echo "<pre>";
//        print_r($row);
//        echo "</pre>";

    }
//    echo "<pre>";
//    print_r($_SESSION);
//    echo "</pre>";
}
if (is_array($errors)&& !empty($errors)){
    $errors_string=implode("<br>", $errors);
    echo "<div class= ' alert alert-danger'>";
    echo $errors_string;
    echo "</div>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<div class="container" style="margin-top: 150px">
    <div class="row">
        <div class="col-md-12">
            <h1> Đăng nhập người dùng</h1>
            <form name="login" action="" method="post">
                <div class="form-group">
                    <label>username</label>
                    <input type="text" class="form-control" placeholder="Enter username" autocomplete="off" name="username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <div class="form-group form-check">
                    <p><a href="register.php"> Đăng ký</a></p>
                </div>
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>