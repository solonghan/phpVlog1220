<?php
    require('connmysql.php');
    

    $pagerRow_records = 10;//預設每頁筆數
    print "預設每頁筆數:".$pagerRow_records."<hr>";
    $num_page = 1;//預設頁數
    print "預設頁數:".$num_page."<hr>";
    
    //EX:如果網址後面有?page=5，本頁數$num_page =5
    if(isset($_GET["page"])){
        $num_page = $_GET["page"];
    }

    //本頁開始記錄筆數=(頁數-1)*每頁紀錄筆數
    //(1-1)*3=0  、 (2-1)*3=3
    $startRow_records = ($num_page-1)*$pagerRow_records;
    $sql = "SELECT * FROM `students` ";
    $sql_limit =$sql . "LIMIT " . $startRow_records . ", " . $pagerRow_records;
    // print $sql_limit;

    

    


    if($result = mysqli_query($conn,$sql_limit)){//mysqli_query下達SQL語法，將結果傳回result
        $total_records =mysqli_num_rows($result);//mysqli_num_rows() 函數返回結果集中的行數。
        print "本頁筆數:".$total_records."<hr>";//印出本頁 N 筆資料
        
        $all_result = mysqli_query($conn,$sql);//爪取全部筆數
        
        $total_records =mysqli_num_rows($all_result);//mysqli_num_rows() 函數返回結果集中的行數。
        
        
        // print $row['cName'];

        //計算總頁數=(總比數/每頁筆數)
        // 12/3=4 ， 13/4=4.xx，無條件進位
        $total_pages= ceil($total_records/$pagerRow_records);
        print "總頁數:".$total_pages."<hr>";

        print "總筆數:".$total_records."<hr>";//印出總 N 筆資料

        while($row =mysqli_fetch_array($result,MYSQLI_ASSOC)){
       
            print_r($row);
            print "<hr>";
            }
    
            // mysqli_free_result($result);


    print "<div style='margin:20px;' >";
    if($num_page>1){//不是第一頁
        print "<a href='page_test.php?page=1'>第一頁&nbsp </a>";
        print "<a href='page_test.php?page=" . ($num_page-1) . "'>上一頁&nbsp </a>";
        
    }
    if($num_page<$total_pages){//不是最後一頁
        print "<a href='page_test.php?page=" . ($num_page+1) . "'>下一頁&nbsp </a>";
        print "<a href='page_test.php?page=" . $total_pages . "'>最後一頁</a>";
    }

        print "</div>";
        print "<div>";
        print "<span>本頁數 : </span>";
    for($i=1;$i<=$total_pages;$i++){
        
            if($i==$num_page){
                print "<span style='font-size :20px; margin: 5px;'>$i</span>";
            }else{
                print "<a href='page_test.php?page=$i' class='a_2'>$i</a>";
            }
        
    }
        print "</div>";

    }



?>