<?php
    if(isset($_POST["action"])&& $_POST["action"]=="add"){
        require_once("connmysql.php");
        //print "ok";

        // print $_POST['cName'] . "<br>";
        // print $_POST['cSex'] . "<br>";
        // print $_POST['cBirthday'] . "<br>";
        // print $_POST['cEmail'] . "<br>";
        // print $_POST['cPhone'] . "<br>";
        // print $_POST['cAddr'] . "<br>";

        $sql = "INSERT INTO `students`(`cName`,`cSex`,`cBirthday`,`cEmail`,`cPhone`,`cAddr`) VALUES(";
        $sql .="'" . $_POST['cName'] ."',";
        $sql .="'" . $_POST['cSex'] ."',";
        $sql .="'" . $_POST['cBirthday'] ."',";
        $sql .="'" . $_POST['cEmail'] ."',";
        $sql .="'" . $_POST['cPhone'] ."',";
        $sql .="'" . $_POST['cAddr'] ."')";
        //print $sql;
        mysqli_query($conn,$sql);
        mysqli_close($conn);
        header("Location:data.php");//自動導到指定地方
    }
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
    <p class="material-icons" style=" font-size: 50px;width: 10%;text-align: center;  margin-left:45%; margin-bottom: 0%;">people note_add</p>
    <div><h1>學生資料管理系統-新增資料</h1></div>
    <div><p><a class="material-icons" style="font-size: 30px;" href="./data.php">home 回主畫面</a></p></div>
    <form action="" method="POST">
        <table class="table_2">
            <tr>
                <th class="th_2">欄位</th>
                <th class="th_2">資料</th>
            </tr>
            <tr>
                <td>姓名</td>
                <td><input type="text" name="cName"></td>
            </tr>

            <tr>
                <td>性別</td>
                <td><input type="radio" name="cSex" value="M" checked>男
                    <input type="radio" name="cSex" value="F">女
                </td>
            </tr>

            <tr>
                <td>生日</td>
                <td><input type="date" name="cBirthday"></td>
            </tr>
            <tr>
                <td>電子郵件</td>
                <td><input type="text" name="cEmail"></td>
            </tr>
            <tr>
                <td>電話</td>
                <td><input type="text" name="cPhone"></td>
            </tr>
            <tr>
                <td>住址</td>
                <td><input type="text" name="cAddr" size="40"></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="hidden" name="action" value="add">
                <input type="submit" name="button" value="新增資料" class="input_3">
                <input type="reset" name="reset" value="重新填寫" class="input_2">
            </td>
            </tr>
        </table>
    </form>
</body>
</html>