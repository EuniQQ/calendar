<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>萬年曆-21張筠臻</title>
    <link rel="stylesheet" href="./style.css">

</head>
<body>
    <!-- 整個月曆 -->
<main class="content">

<!-- left -->
<section class="left">

<!-- left-yearBar -->
<nav id="yearBar">

<!-- 1970-2070年 -->
<div class=lastYears>
<?php
$mm=date('m');
for($i=1970;$i<2071;$i++){
echo "<a href='index.php?year=$i&month=$mm'>". $i ."</a>" . "<br>"; 
}
?>
</div>
</nav> 


<!-- left-calendar -->
<main class="leftCal">

<img id="moon" src="./moon.png" alt="月亮" >


<?php
    $specialDate=['1-1'=>'元旦','2-28'=>'和平紀念日','3-8'=>'婦女節','4-4'=>'兒童節','5-1'=>'勞動節','8-8'=>'父親節','9-3'=>'軍人節','10-10'=>'國慶日','12-25'=>'聖誕節'];
   
    // isset()判斷變數是否存在
    // $_GET用於收集表單數據
    if(isset($_GET['month'])){
        $month=$_GET['month'];
        $year=$_GET['year'];
    }else{
        // 參數m：表示的月份，有前導零
        $month=date("m");
        // 參數Y：4位數表示的年份 EX.2003
        $year=date("Y");
    }
    
    $lastmonth=$month-1;
    $lastyear=$year;

    $nextmonth=$month+1;
    $nextyear=$year;
    
    if($month==1){
        $lastmonth=12;
        $lastyear=$year-1;

        $nextmonth=$month+1;
        $nextyear=$year;

    }else if($month==12){

        $lastmonth=$month-1;
        $lastyear=$year;

        $nextmonth=1;
        $nextyear=$year+1;
    }

    $firstDay=date("$year-$month-01");
    $firstWeekWhiteDays=date("w",strtotime($firstDay));
    // 小寫w參數：星期中的第幾天，	0（表示星期天）到 6（表示星期六）
    $monthDays=date("t",strtotime($firstDay));
    // 參數t:指定的月份有幾天
    $firstWeekDays=7-$firstWeekWhiteDays;
    $weeks=ceil(($firstWeekWhiteDays+$monthDays)/7);
    // ceil() 函數：無條件進位
    $lastWeekDays=($firstWeekWhiteDays+$monthDays)%7;
    $lastWeekWhiteDays=7-$lastWeekDays;
    $allCells=$weeks*7;
    // cell=sun~sat每一天名稱
    
    //陣列中加入首列資料
    $headers=['SUN','MON','TUE','WED','THU','FRI','SAT'];

    //陣列中加入月前空白;
    for($i=0;$i<$firstWeekWhiteDays;$i++){
        $td[]="";
    }
    for($i=0;$i<$monthDays;$i++){ 
        $td[]=($i+1);
    }
   for($i=0;$i<$lastWeekWhiteDays;$i++){
        $td[]="";
    }

    ?>

<!-- calendar  -->
<div class="calendar">


<?php
// 月曆頭
// foreach($headers as $header){
//     echo "<div class='cell'>";
//     echo "$header";
//     echo "</div>";
// }


foreach($headers as $header){
    if($headers[0] || $headers[6]){
        echo "<div class= 'cell','weekend'>";
        echo "$header";
        echo "</div>"; 
    }else if($headers = [1] || [2] || [3] || [4] || [5]){
    echo "<div class='weekdaysHeader'>";
    echo "$header";
    echo "</div>";
    }
}



?>


<?php
//月曆body
for($i=0;$i<$allCells;$i++){
    $w=$i%7;
    // is_numeric — 查變數是數字或數字字符串
    if(is_numeric($td[$i])){
        // $date=date("$year-$month-").$td[$i];
        $spDate=date("$month-").$td[$i];
    }else{
        $spDate=null; //使空白部分不會印出前面的spDate
    } 
    

    if($w==0 || $w==6){
        echo "<div class='dayoff cell'>";
    }else{
        echo "<div class='cell'>";
    }
    echo "<div class='number'>$td[$i]</div>";
    if(isset($spDate) && array_key_exists($spDate,$specialDate)){
     // array_key_exists() 檢查給定的key值或索引值是否存在於數組中
     // 語法：array_key_exists(key,array)
    echo "<div class='specialDate'>$specialDate[$spDate]</div>";
    }
    echo "</div>";
}
?>

<!-- 跳轉月份 -->

<div class="monthSign">
     <a class="lastM" href="index.php?year=<?=$lastyear;?>&month=<?=$lastmonth;?>">◄ Last Month</a>
     <a class="nextM" href="index.php?year=<?=$nextyear;?>&month=<?=$nextmonth;?>">Next Month ►</a>
</div> 




</div>  

</main>


</section>

<!-- left end -->


<!-- right -->
<section class="right">


<!-- right_date -->
<main class="rightDate">


<!-- 草寫英文 -->
<div class="cursive">
<?php
if($month==1){
    echo '<img src="./01.png">';
}else if($month==2){
    echo '<img src="./02.png">';
}else if($month==3){
    echo '<img src="./03.png">';  
}else if($month==4){
    echo '<img src="./04.png">';
}else if($month==5){
    echo '<img src="./05.png">';
}else if($month==6){
    echo '<img src="./06.png">';
}else if($month==7){
    echo '<img src="./07.png">';
}else if($month==8){
    echo '<img src="./08.png">';
}else if($month==9){
    echo '<img src="./09.png">';
}else if($month==10){
    echo '<img src="./10.png">';
}else if($month==11){
    echo '<img src="./11.png">';
}else if($month==12){
    echo '<img src="./12.png">';
}else {
    echo "<img src='$month.png'>";
}
?>


</div>
<h3 class="dateTitle">-&nbsp;<?=$year;?>&nbsp;-</h3>
</main>


<!-- right-monthBar -->
<nav class="monthBar">
<?php
for($i=1;$i<13;$i++){
    echo "<a href='index.php?year=$year&month=$i'>" . $i . "</a>" . "<br>"; 
}

?>



<!-- <a href="style_2.php?year=<?=$year;?>&month=1">1</a><br>
<a href="style_2.php?year=<?=$year;?>&month=2">2</a><br>
<a href="style_2.php?year=<?=$year;?>&month=3">3</a><br>
<a href="style_2.php?year=<?=$year;?>&month=4">4</a><br>
<a href="style_2.php?year=<?=$year;?>&month=5">5</a><br>
<a href="style_2.php?year=<?=$year;?>&month=6">6</a><br>
<a href="style_2.php?year=<?=$year;?>&month=7">7</a><br>
<a href="style_2.php?year=<?=$year;?>&month=8">8</a><br>
<a href="style_2.php?year=<?=$year;?>&month=9">9</a><br>
<a href="style_2.php?year=<?=$year;?>&month=10">10</a><br>
<a href="style_2.php?year=<?=$year;?>&month=11">11</a><br>
<a href="style_2.php?year=<?=$year;?>&month=12">12</a><br> -->



</nav>



</section>
</main>


</body>
</html>