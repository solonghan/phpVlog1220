<?php
    require_once("connmysql.php");
    
    $sql= "SELECT * FROM `message` ORDER BY `mID` DESC ";
    $data= mysqli_query($conn,$sql);

    $pagerRow_records = 3;//預設每頁筆數
    $num_page = 1;//預設頁數

    if(isset($_GET["page"])){
        $num_page = $_GET["page"];
    }

    //本頁開始記錄筆數=(頁數-1)*每頁紀錄筆數
    //(1-1)*3=0  、 (2-1)*3=3
    $startRow_records = ($num_page-1)*$pagerRow_records;
    // $sql_all = "SELECT * FROM `message` ";
    $sql_limit =$sql . "LIMIT " . $startRow_records . ", " . $pagerRow_records;
    // print $sql_limit;
    $data_page= mysqli_query($conn,$sql_limit);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>留言板</title>
    <style>
        div{
            text-align: right;
            background-color:  white;
            width: 580px;
            margin: auto;
            padding: 10px;
            /* border-radius: 10px 10px 0px 0px; */
            /* border-bottom: 2px gray solid; */
        }
        div :a{
            text-align: right;
        }
        .table_6{
            background-color: aliceblue; 
            width: 600px;
            margin: auto;
            text-align: left;
            padding: 0px 5px ; 
            
            border-radius: 0px;
            padding-bottom: 0px;
        }
        .t_1{
            background-color: red;
            width: 150px;
            margin-left: 500px;
            
        }
        tr,td{
            width: 200px;
            border-bottom: 3px gray solid;
            /* background-color: rgb(204, 213, 221); */
            
        }
        
        
        th{
            /* border-radius: 5px; */
            /* background-color: rgb(93, 173, 243); */
            /* border: 0px; */
            /* margin: auto; */
            text-align: center;
            padding: 5px ;
            font-size: larger;
            /* outline:2px solid rgb(93, 173, 243); */
            border-bottom: 2px gray solid;
            width: 400px;
        }
        h1{
            background-color: rgb(221, 180, 44);
            width: 580px;
            margin: auto;
            margin-top: 100px;
            border-radius: 20px 20px 0px 0px;
            text-align: left;
            padding: 10px;
            border-bottom: 2px solid;
        }
        .input_4{
            border: 2px solid;
            background-color: rgb(129, 201, 120);
            color:black;
            border-radius:5px;
            font-size: 15px;
            text-decoration: none;
            padding: 5px;
            
        }
        .input_4:hover{
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
        .a_2{
            
            color: rgb(17, 13, 226);
            text-decoration: none;
            font-size: 20px;
            padding: 5px;
            
        }
        .a_2:hover{
            
            color: red;
            text-decoration: none;
            font-size: 20px;
            padding: 5px;
            
        }
        .a_10{
            text-decoration: none;
            color: rgb(0, 0, 0);
            /* background-color: rgb(180, 127, 230); */
            /* border: 2px red solid; */
            margin: 2px;
            padding: 5px;
        }
        .a_10:hover{
            text-decoration: none;
            color: rgb(240, 247, 241);
            background-color: rgb(111, 31, 185);
            border-radius: 5px;
        }
    </style>
</head>
<body class="body_1">
    <h1>留言板</h1>
    <div>
    <a href="index_1.php" class="input_5">瀏覽留言</a>
    <a href="add_message.php" class="input_5">新增留言</a>
    </div>
    <?php
    if($result = mysqli_query($conn,$sql_limit)){//mysqli_query下達SQL語法，將結果傳回result
        $total_records =mysqli_num_rows($result);//mysqli_num_rows() 函數返回結果集中的行數。
        //print $total_records;//印出本頁 N 筆資料
        $all_result = mysqli_query($conn,$sql);//爪取全部筆數
        $total_records =mysqli_num_rows($all_result);//mysqli_num_rows() 函數返回結果集中的行數。
        

        //計算總頁數=(總比數/每頁筆數)
        // 12/3=4 ， 13/4=4.xx，無條件進位
        $total_pages= ceil($total_records/$pagerRow_records);
        // print "總頁數:".$total_pages;

        //print $total_records;//印出 N 筆資料

        print "<table class='table_6'>";
        print "<tr>";
        print "<th style='width:200px'>留言者</th>";
        print "<th>留言內容</th>";
        print "<th style='width:200px'>留言時間</th>";
        print "<tr>";
        while($arr = mysqli_fetch_array($data_page,MYSQLI_ASSOC)){
        

        print "<tr>";
        print "<td>";
        
        if($arr['sex']=="男"){
            print"<span class='material-icons' style='color:blue;font-size: 30px;'>man</span>";
        }else{
            print"<span class='material-icons' style='color:red;font-size: 30px;'>woman</span>";
        }
        // print "<span>". $arr['sex'] ."</span>";
        print "<span style='font-style: italic;'>". $arr['name'] ."</span>";
        print "</td>";
       
        print "<td>";
        print "<p>".$arr['mID']."F【". $arr['title'] ."】</p>";
        print "<span>". $arr['content'] ."</span>";        
        print "</td>";
        
        print "<td>";
        print "<span>". $arr['time'] ."</span>";      
        print "</td>";
        
        print "</tr>";

        // print "<tr>";
        // print  "<td>". $arr['sex'] ."</td>";
        // print  "<td>". $arr['content'] ."</td>";
        // print  "<td>". $arr['time'] ."</td>";
        // print "</tr>";
        // print "<tr >";
        // // print  "<td class='t_1'>". $arr['time'] ."<hr></td>";
        // print "<p class='t_1'>".$arr['time']."</p>";
        // print "</tr>";
       
    }
    print "</table>";
    mysqli_free_result($data_page);
    
    print "<div >";
    print "<a href='login.html' class='input_4' style='float:left' >登入管理</a>";
    if($num_page>1){
        print "<a href='index_1.php?page=1' class='a_10'>第一頁&nbsp</a>";
        print "<a href='index_1.php?page=". ($num_page-1) . "' class='a_10'>上一頁&nbsp</a>";
    }
    
    if($num_page<$total_pages){
        print "<a href='index_1.php?page=". ($num_page+1) . "' class='a_10'>下一頁&nbsp</a>";
        print "<a href='index_1.php?page=". $total_pages . "' class='a_10'>最後一頁</a>";
    }
    print "</div>";

    print "<div style='border-radius:0px 0px 10px 10px'>";
            print "<span>頁數 : </span>";
            for($i=1;$i<=$total_pages;$i++){    
                    if($i==$num_page){
                        print "<span style='font-size :20px; margin: 5px;'>$i</span>";
                    }else{
                        print "<a href='index_1.php?page=$i' class='a_2'>$i</a>";
                    }  
            }
            print "</div>";
    }
?>
<!-- <div style="text-align: justify;">
<a href="login.html" class="input_4" >登入管理</a>
</div> -->

    
</body>
</html>