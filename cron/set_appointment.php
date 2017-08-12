<?php
    //if(1 >= $_SERVER["argc"]){
    //    die("Please type the appoint date\n"); 
    //} else {
    //    $date = $_SERVER["argv"][1];
    //    if((date('w',strtotime($date))==6) || (date('w',strtotime($date)) == 0)){
    //        die("This day is weekend\n");
    //    }
    //}

    $date = date("Y-m-d",strtotime("+2 week"));
    //if((date('w',strtotime($date))==6) || (date('w',strtotime($date)) == 0)){
    //    die("This day is weekend\n");
    //}

    $servername = "127.0.0.1";
    $username = "juyishop";
    $password = "M5mmK6JTtCyNkBMf";
    $dbname = "juyishop";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connect to db error: " . $conn->connect_error . "\n");
    }

    $sql = "select id from jy_goods where goodtype = 1";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $sqlAp = "select * from jy_setappointment where goodid = $id and appointdate = \"$date\"";
            $reAp = $conn->query($sqlAp);
            if($reAp->num_rows == 0){
                $sqlInsert = "insert into jy_setappointment(goodid, appointdate, numoftime1) values($id, \"$date\", 3)"; 
                $conn->query($sqlInsert);
            }
        }
    }
?>
