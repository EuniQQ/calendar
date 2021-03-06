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
                    $mm = date('n');
                    for ($i = 1970; $i < 2071; $i++) {
                        echo "<a href='index.php?year=$i&month=$mm'>" . $i . "</a>" . "<br>";
                    }
                    ?>
                </div>
            </nav>


            <!-- left-calendar -->
            <main class="leftCal">


                <?php
                $specialDate = ['1-01' => '元旦', '2-14' => '西洋情人節', '2-28' => '和平紀念日', '3-08' => '婦女節', '4-04' => '兒童節', '5-01' => '勞動節', '8-08' => '父親節', '9-03' => '軍人節', '9-28' => '教師節', '10-10' => '國慶日', '10-25' => '臺灣光復節', '12-25' => '聖誕節'];

                // isset()判斷變數是否存在
                // $_GET用於收集表單數據
                if (isset($_GET['month'])) {
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                } else {
                    // 參數n：表示的月份，無前導零
                    $month = date("n");
                    // 參數Y：4位數表示的年份 EX.2003
                    $year = date("Y");
                }



                $lastmonth = $month - 1;
                $lastyear = $year;

                $nextmonth = $month + 1;
                $nextyear = $year;

                if ($month == 1) {
                    $lastmonth = 12;
                    $lastyear = $year - 1;

                    $nextmonth = $month + 1;
                    $nextyear = $year;
                } else if ($month == 12) {

                    $lastmonth = $month - 1;
                    $lastyear = $year;

                    $nextmonth = 1;
                    $nextyear = $year + 1;
                }

                $firstDay = date("$year-$month-01");
                $firstWeekWhiteDays = date("w", strtotime($firstDay));
                // 小寫w參數：星期中的第幾天，	0（表示星期天）到 6（表示星期六）
                $monthDays = date("t", strtotime($firstDay));
                // 參數t:指定的月份有幾天
                $firstWeekDays = 7 - $firstWeekWhiteDays;
                $weeks = ceil(($firstWeekWhiteDays + $monthDays) / 7);
                // ceil() 函數：無條件進位
                $lastWeekDays = ($firstWeekWhiteDays + $monthDays) % 7;
                $lastWeekWhiteDays = 7 - $lastWeekDays;
                $allCells = $weeks * 7;
                // cell=sun~sat每一天名稱

                //陣列中加入首列資料
                $headers = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];

                //陣列中加入月前空白;
                for ($i = 0; $i < $firstWeekWhiteDays; $i++) {
                    $td[] = "";
                }
                for ($i = 0; $i < $monthDays; $i++) {
                    $td[] = ($i + 1);
                }
                for ($i = 0; $i < $lastWeekWhiteDays; $i++) {
                    $td[] = "";
                }

                ?>

                <!-- calendar  -->
                <div class="calendar">


                    <?php
                    // 月曆頭
                    foreach ($headers as $header) {
                        if ($header == 'SUN' || $header == 'SAT') {
                            echo "<div class='cell dayoff' >";
                            echo "$header";
                            echo "</div>";
                        } else {
                            echo "<div class='cell'>";
                            echo "$header";
                            echo "</div>";
                        }
                    }


                    // foreach($headers as $header){
                    //     if($headers[0] || $headers[6]){
                    //         echo "<div class= 'cell','weekend'>";
                    //         echo "$header";
                    //         echo "</div>"; 
                    //     }else if($headers = [1] || [2] || [3] || [4] || [5]){
                    //     echo "<div class='weekdaysHeader'>";
                    //     echo "$header";
                    //     echo "</div>";
                    //     }
                    // }



                    ?>


                    <?php
                    //月曆body
                    for ($i = 0; $i < $allCells; $i++) {
                        $w = $i % 7;
                        // is_numeric — 查變數是數字或數字字符串
                        if (is_numeric($td[$i])) {
                            // $date=date("$year-$month-").$td[$i];
                            $spDate = date("$month-") . $td[$i];
                        } else {
                            $spDate = null; //使空白部分不會印出前面的spDate
                        }


                        if ($w == 0 || $w == 6) {
                            echo "<div class='dayoff cell' style='color:yellow'>";
                        } else {
                            echo "<div class='cell'>";
                        }

                        if (isset($_GET['day']) && ($i == date('d'))) {
                            echo "<div class='number' id='todayMark'>$td[$i]</div>";
                        } else {
                            echo "<div class='number'>$td[$i]</div>";
                            if (isset($spDate) && array_key_exists($spDate, $specialDate)) {
                                // array_key_exists() 檢查給定的key值或索引值是否存在於陣列中
                                // 語法：array_key_exists(key,array)
                                echo "<div class='specialDate'>$specialDate[$spDate]</div>";
                            }
                        }

                        echo "</div>";
                    }
                    ?>

                    <!-- 跳轉月份 -->

                    <div class="monthSign">
                        <a class="lastM" href="index.php?year=<?= $lastyear; ?>&month=<?= $lastmonth; ?>">◄ Last Month</a>
                        <div class="today"><a href="index.php?year=<?= date('Y') ?>&month=<?= date('n') ?>&day=<?= date('d') ?>">Today</a></div>
                        <a class="nextM" href="index.php?year=<?= $nextyear; ?>&month=<?= $nextmonth; ?>">Next Month ►</a>
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
                    if ($month == 1) {
                        echo '<img src="./img/1.png">';
                    } else if ($month == $i) {
                        for ($i = 2; $i <= 12; $i++) {
                            echo '<img src="./img/"' . $i . '"png">';
                        }
                    } else {
                        echo "<img src='./img/$month.png'>";
                    }
                    ?>

                </div>
                <h3 class="dateTitle">-&nbsp;<?= $year; ?>&nbsp;-</h3>
            </main>


            <!-- right-monthBar -->
            <nav class="monthBar">
                <?php
                for ($i = 1; $i < 13; $i++) {
                    echo "<a href='index.php?year=$year&month=$i'>" . $i . "</a>" . "<br>";
                }

                ?>






            </nav>



        </section>
    </main>


</body>

</html>