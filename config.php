<?php
define("DB_SERVER", "localhost");
define("DB_SERVER_USERNAME","root");
define("DB_SERVER_PASSWORD","");
define("DB_SERVER_NAME","demologin");
$connection= mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD,DB_SERVER_NAME);
if ($connection==false){
    die("Không thể kết nối đến csdl"). mysqli_connect_error();
}