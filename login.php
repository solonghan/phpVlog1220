<?php
session_start();
require_once("connmysql.php");



if(isset($_POST["account"]) && isset($_POST["password"]) && isset($_POST["action"]) && ($_POST["action"]=="login") ){
    // echo "ok";
    $sql = "SELECT * FROM `students` WHERE `cName`= '" .$_POST["account"]. "'" ."&& `cPhone`='".$_POST["password"]."'" ;
    // echo $sql;// 檢視sql語法有無拼錯 ， 完畢後要隱藏起來
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    // print_r($row);
    if (isset($row['cName']) && isset($row['cName'])!="" && isset($row['cPhone']) && isset($row['cPhone'])!="") {
        echo "有資料";
        mysqli_close($conn);
        $_SESSION['account']=$row["cName"];
        $_SESSION['password']=$row["cPhone"];
        header("Location:index_admin.php");
    }else{
        mysqli_close($conn);
       print "<p style='background-color:red ;  margin:auto; text-align:center; color:white; font-size: 30px;'>帳號或密碼錯誤</p>";
       echo "<a href='login.html'>回登入畫面</a>";
       
    }
}
?>
