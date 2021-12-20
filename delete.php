<?php

    if(!isset($_GET["id"])){//如果使用者未經過data首頁進來這邊會跳回首頁
        header("Location:data.php");//自動導到指定地方
    }
    require_once("connmysql.php");

    if(isset($_POST["action"])&& $_POST["action"]=="delete"){
        //print "ok";
        $sql = "DELETE FROM `students` WHERE `cID`=" . $_POST["cID"];
       // print $sql;
        mysqli_query($conn,$sql);
        mysqli_close($conn);
        header("Location:data.php");//自動導到指定地方
    }
    //下面檢查用
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
        }  */
        td{
             background-color: rgb(224, 232, 240);
         }
</style>
<script>
        function myFunction(){
           return confirm("\n你確定要刪除?\n");
           //沒有加return不管確認或取消都會刪除(因為都為真)
        }
</script>

</head>
<body class="body_1">
    <p class="material-icons" style=" font-size: 50px;width:10%;text-align:center;          margin-left:45%; margin-bottom: 0%;">people delete</p>

    <div><h1>學生資料管理系統-刪除資料</h1></div>
    <div><p><a href="./data.php" class="material-icons" style="font-size: 30px;">home回主畫面</a></p></div>
    <form action="" method="POST">
        <table class="table_2">
            <tr>
                <th>欄位</th>
                <th>資料</th>
            </tr>
            <tr>
                <td>姓名</td>
                <td><?php print$row["cName"];?></td>
            </tr>

            <tr>
                <td>性別</td>
                <td> <?php if($row["cSex"]=="M") print "男";else print"女"?>
                </td>
            </tr>

            <tr>
                <td>生日</td>
                <td><?php print$row["cBirthday"];?></td>
            </tr>
            <tr>
                <td>電子郵件</td>
                <td><?php print$row["cEmail"];?></td>
            </tr>
            <tr>
                <td>電話</td>
                <td><?php print$row["cPhone"];?></td>
            </tr>
            <tr>
                <td>住址</td>
                <td><?php print$row["cAddr"];?></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="cID" value="<?php print $row["cID"];?>">
                <!-- <input type="submit" name="button" value="刪除這筆資料"> -->
                <button onclick="return myFunction();" class="input_2">刪除這筆資料</button>
                <!-- return myFunction(); return 為真(確定)才會執行，為假(取消)不會 -->
                
            </td>
            </tr>
        </table>
    </form>
</body>
</html>