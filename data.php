<?php
    require_once("connmysql.php");
    session_start();
    //<登出設定跟檢查用
    if(isset($_GET["action"]) && $_GET["action"]='out' ){
        unset($_SESSION['account']);
        unset($_SESSION['password']);
        header("Location:login.html");
    }

    if(!(isset($_SESSION['account']))  || !(isset($_SESSION['password']))  || $_SESSION['account']=="" || $_SESSION['password']==""){
        header("Location:login.html");
    }
    //登出設定跟檢查用>


    $pagerRow_records = 10;//預設每頁筆數
    $num_page = 1;//預設頁數

    if(isset($_GET["page"])){
        $num_page = $_GET["page"];
    }

    //本頁開始記錄筆數=(頁數-1)*每頁紀錄筆數
    //(1-1)*3=0  、 (2-1)*3=3
    $startRow_records = ($num_page-1)*$pagerRow_records;
    $sql = "SELECT * FROM `students` ";
    $sql_limit =$sql . "LIMIT " . $startRow_records . ", " . $pagerRow_records;
    // print $sql_limit;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <title>學生資料管理系統</title>
    <style>
        div{
            text-align: center;
        
            
        }
        .table_4{
            background-color: rgb(233, 157, 70);
            border-radius: 10px;
            width: 800px;
            margin: auto;
            text-align: center;
            padding: 15px 5px ;
            
        }
        th{
            border:2px ;
            border-radius: 5px;
            background-color: rgb(223, 186, 93);
        }
        td{
            border:1px  ;
            background-color: antiquewhite;
            color: rgb(109, 106, 106);
            padding: 3px ;
        }
        a{
            color: rgb(3, 139, 14);
            text-decoration: none;

        }
        a:hover{
            color:red;
        }
        p{
            font-size: 20px;
           
        }
        .a_2{
            
            color: rgb(17, 13, 226);
            
            font-size: 20px;
            padding: 5px;
            
        }
         
        
</style>
</head>
<body class="body_1">
<p class="material-icons" style=" font-size: 50px;width:10%;text-align:center; margin-left:45%; margin-bottom: 0%;">people table_view</p>
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

            print "<div><h1>學生管理系統</h1></div>";
            print "<div><p >登入者". $_SESSION['account']. " , ";
            print "<a href = '?action=out' class='material-icons'>logout登出</a>。</p></div>";
            print "<div><p>總頁數:".$total_pages ."，資料總筆數:" . $total_records . "，";
            print "<a href = 'add.php' class='material-icons'>library_add新增學生資料</a> 。</p></div>";
           
        

            print "<table class='table_4'>";
            print "<tr>";
            print "<th>座號</th>";
            print "<th>姓名</th>";
            print "<th>性別</th>";
            print "<th>生日</th>";
            print "<th>電子郵件</th>";
            print "<th>電話</th>";
            print "<th>住址</th>";
            print "<th>功能</th>";
            print "</tr>";

            // 資料內容
            while($row =mysqli_fetch_array($result,MYSQLI_ASSOC)){
                //mysqli_fetch_array()回傳索引鍵的陣列資料
                //MYSQLI_ASSOC以欄位名稱方式
                //MYSQLI_NUM以整數方式
                //MYSQLI_BOTH兩者兼具
                print "<tr>";
               // print_r($row);
                print "<td>" . $row["cID"] . "</td>";
                print "<td>" . $row["cName"] . "</td>";
                print "<td>" . $row["cSex"] . "</td>";
                print "<td>" . $row["cBirthday"] . "</td>";
                print "<td>" . $row["cEmail"] . "</td>";
                print "<td>" . $row["cPhone"] . "</td>";
                print "<td>" . $row["cAddr"] . "</td>";
                //print "<td><a href='update.php?id=14'>修改</a> ";
                print "<td><a href='update.php?id=". $row["cID"] . "'>修改</a> ";
                print "<a href='delete.php?id=". $row["cID"] . "'>刪除</a></td>";
                
                
                print "</tr>";
            }
            print "</table>";
            mysqli_free_result($result);

           print "<div style='margin:20px;' >";
                if($num_page>1){//不是第一頁
                    print "<a href='data.php?page=1'>第一頁&nbsp </a>";
                    print "<a href='data.php?page=" . ($num_page-1) . "'>上一頁&nbsp </a>";
                    
                }
                if($num_page<$total_pages){//不是最後一頁
                    print "<a href='data.php?page=" . ($num_page+1) . "'>下一頁&nbsp </a>";
                    print "<a href='data.php?page=" . $total_pages . "'>最後一頁</a>";
                }
           
            print "</div>";
            print "<div>";
            print "<span>頁數 : </span>";
            for($i=1;$i<=$total_pages;$i++){
                   
                    if($i==$num_page){
                        print "<span style='font-size :20px; margin: 5px;'>$i</span>";
                    }else{
                        print "<a href='data.php?page=$i' class='a_2'>$i</a>";
                    }
                
            }


            print "</div>";
        }
        mysqli_close($conn);
    ?>
</body>
</html>