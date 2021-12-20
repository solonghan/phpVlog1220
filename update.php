<?php

    if(!isset($_GET["id"])){//如果使用者未經過data首頁進來這邊會跳回首頁
        header("Location:data.php");//自動導到指定地方
    }
    require_once("connmysql.php");

    if(isset($_POST["action"])&& $_POST["action"]=="update"){
        //print "ok";
        $sql ="UPDATE `students` SET ";
        $sql.="`cName`='" . $_POST["cName"] . "',";
        $sql.="`cSex`='" . $_POST["cSex"] . "',";
        $sql.="`cBirthday`='" . $_POST["cBirthday"] . "',";
        $sql.="`cEmail`='" . $_POST["cEmail"] . "',";
        $sql.="`cPhone`='" . $_POST["cPhone"] . "',";
        $sql.="`cAddr`='" . $_POST["cAddr"] . "'";
        $sql.=" WHERE `cID`=" . $_POST["cID"];
        //print $sql;

        mysqli_query($conn,$sql);
        mysqli_close($conn);
        header("Location:data.php");//自動導到指定地方
    }

    $sql = "SELECT * FROM `students` WHERE `cID`=" . $_GET["id"];
    //print $sql;
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   // print_r($row);
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>Document</title>
    <style>
        div{
            text-align: center;
        }
        /* table{
            margin: auto;
        }
        table ,th ,td{
            border-width: 1px;
            border-style: solid;
            border-color: #000000;
        } */
        td{
             background-color: rgb(224, 232, 240);
         }
        
</style>
</head>
<body class="body_1">
    <p class="material-icons" style=" font-size: 50px;width: 10%;text-align: center; margin-left:45%; margin-bottom: 0%;">people update</p>
    <div><h1>學生資料管理系統-修改資料</h1></div>
    <div><p><a class="material-icons" style="font-size: 30px;" href="./data.php">home 回主畫面</a></p></div>
    <form action="" method="POST">
        <table class="table_2">
            <tr>
                <th class="th_2">欄位</th>
                <th class="th_2">資料</th>
            </tr>
            <tr>
                <td>姓名</td>
                <td><input type="text" name="cName" value="<?php print$row["cName"];?>"></td>
            </tr>

            <tr>
                <td>性別</td>
                <td><input type="radio" name="cSex" value="M"  <?php if($row["cSex"]=="M") print "checked";?>>男
                    <input type="radio" name="cSex" value="F" <?php if($row["cSex"]=="F") print "checked";?>>女
                </td>
            </tr>

            <tr>
                <td>生日</td>
                <td><input type="date" name="cBirthday" value="<?php print$row["cBirthday"];?>"></td>
            </tr>
            <tr>
                <td>電子郵件</td>
                <td><input type="text" name="cEmail" value="<?php print$row["cEmail"];?>"></td>
            </tr>
            <tr>
                <td>電話</td>
                <td><input type="text" name="cPhone" value="<?php print$row["cPhone"];?>"></td>
            </tr>
            <tr>
                <td>住址</td>
                <td><input type="text" name="cAddr" size="40" value="<?php print$row["cAddr"];?>"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="cID" value="<?php print $row["cID"];?>">
                <input type="submit" name="button" value="更新資料" class="input_3">
                <input type="reset" name="reset" value="重新填寫" class="input_2">
            </td>
            </tr>
        </table>
    </form>
</body>
</html>