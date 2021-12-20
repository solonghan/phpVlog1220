<?php
    $servername = "localhost";
    $username = "root";
    $password = "1qaz@wsx";
    $database = "aclass";

    //create connection
    $conn = mysqli_connect($servername,$username,$password,$database);

    //check
    if(mysqli_connect_error()){
        print "Failed to connect to MaySql:" . mysqli_connect_error();
    }else{
        //print "Successful connection" . "<br>";
    }

    mysqli_query($conn,"SET NAMES utf8");   //中文編碼的問題

?>
