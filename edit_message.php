<?php

    if(!isset($_GET["id"])){//如果使用者未經過data首頁進來這邊會跳回首頁
        header("Location:index_admin.php");//自動導到指定地方
    }
    require_once("connmysql.php");

    if(isset($_POST["action"])&& $_POST["action"]=="edit_message"){
        // print "ok";
        $sql ="UPDATE `message` SET ";
        $sql.="`name`='" . $_POST["name"] . "',";
        $sql.="`sex`='" . $_POST["sex"] . "',";
        $sql.="`title`='" . $_POST["title"] . "',";
        $sql.="`content`='" . $_POST["content"] . "'";
        $sql.=" WHERE `mID`=" . $_POST["mID"];
        // print $sql;

        mysqli_query($conn,$sql);
        mysqli_close($conn);
        header("Location:index_admin.php");//自動導到指定地方
    }

    $sql = "SELECT * FROM `message` WHERE `mID`=" . $_GET["id"];
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
        .input_44{
            border: 2px solid;
            background-color: rgb(129, 201, 120);
            color:black;
            border-radius:5px;
            font-size: 15px;
            text-decoration: none;
            padding: 5px;
            
        }
        .input_44:hover{
            background-color: rgb(58, 153, 44);
        }

        .input_5{
            border-width: 1px 1px 4px 4px ;
            border-color: black;
            border-style: solid ;
            background-color: rgb(248, 129, 129);
            color:black;
            border-radius:5px;
            font-size: 15px;
            padding: 5px;
            text-decoration: none;
            
        }
        .input_5:hover{
            background-color: brown;
            border-width: 0px;
        }
        div{
            background-color:  aliceblue;
            width: 350px;
            margin: auto;
            padding: 10px;
        }
        h1{
            background-color: rgb(221, 180, 44);
            width: 350px;
            margin: auto;
            border-radius: 20px 20px 0px 0px;
            text-align: left;
            padding: 10px;
            border-bottom: 2px solid;
        }
        
</style>
</head>
<body class="body_1">
<h1>留言板</h1>
<div style="text-align: right;">
    <a href="index_admin.php" class="input_5">瀏覽留言</a>
    <a href="add_message.php" class="input_5">新增留言</a>
</div>
    <form action="" method="POST" name="formPost" id="formPost" onsubmit="return fun()">
        <div>
            <label for="">姓名:</label>
            <input type="text" name="name" id="name" value="<?php  print $row["name"];?>">
        </div>
        <div>
        <label for="">性別:</label>
            <input type="radio" name="sex" id="radio" value="男"<?php if($row["sex"]=="男") print "checked";?>>男
            <input type="radio" name="sex" id="radio" value="女"<?php if($row["sex"]=="女") print "checked";?>>女
        </div>
        <div>
            <label for="">標題:</label>
            <input type="text" name="title" id="title" value="<?php  print $row["title"];?>">
        </div>
        <div>
            <label for="">內容:</label>
            <textarea name="content" id="content" cols="45" rows="10"  ><?php  print $row["content"];?></textarea>
        </div>
        <div style="text-align: center; border-radius:0px 0px 10px 10px ;">
            <input type="hidden" name="action" value="edit_message" >
            <input type="hidden" name="mID" value="<?php print $row["mID"];?>">
            <input type="submit" name="button" value="更 新" class="input_44">
            <input type="reset" name="reset" value="復 原" class="input_44">
        </div> 
    </form>
</body>
</html>