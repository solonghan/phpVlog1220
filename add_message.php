<?php
    session_start();
    if(isset($_POST["action"]) && $_POST["action"]=="add_message"){
        require_once("connmysql.php");
        // echo "ok";

        echo $_POST['name'];
        $sql = "INSERT INTO `message`(`name`,`sex`,`title`,`content`) VALUES(";
        $sql .="'" . $_POST['name'] ."',";
        $sql .="'" . $_POST['sex'] ."',";
        $sql .="'" . $_POST['title'] ."',";
        $sql .="'" . $_POST['content'] ."')";
         print $sql;
         mysqli_query($conn,$sql);
         mysqli_close($conn);


            //檢查是否經過登入
        if(!isset($_SESSION["account"]) || ($_SESSION["account"]=="")){
            header("Location: index_1.php");
        }else{
         header("Location:index_admin.php");//自動導到指定地方
        }
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script language="javascript">
        function fun(){
            if(document.formPost.name.value==""){
                alert('姓名未填寫!');
                document.formPost.name.focus();
                return false;
            }
            if(document.formPost.title.value==""){
                alert('標題未填寫!');
                document.formPost.title.focus();
                return false;
            }
            if(document.formPost.content.value==""){
                alert('內容未填寫!');
                document.formPost.content.focus();
                return false;
            }
            
        }
    </script>
    <title>新增留言</title>
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
    <a href="index_1.php" class="input_5">瀏覽留言</a>
    <a href="add_message.php" class="input_5">新增留言</a>
</div>
    <form action="" method="POST" name="formPost" id="formPost" onsubmit="return fun()">
        <div>
            <label for="">姓名:</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
        <label for="">性別:</label>
            <input type="radio" name="sex" id="radio" value="男" checked>男
            <input type="radio" name="sex" id="radio" value="女">女
        </div>
        <div>
            <label for="">標題:</label>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <label for="">內容:</label>
            <textarea name="content" id="content" cols="45" rows="10" ></textarea>
        </div>
        <div style="text-align: center; border-radius:0px 0px 10px 10px ;">
            <input type="hidden" name="action" value="add_message" >
            <input type="submit" name="button" value="送 出" class="input_44">
            <input type="reset" name="reset" value="清 除" class="input_44">
        </div> 
    </form>
</body>
</html>