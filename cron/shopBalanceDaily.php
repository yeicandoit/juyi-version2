<?php
    $servername = "127.0.0.1";
    $dbname = "juyishop";
    //$username = "root";
    //$password = "";
    $username = "juyishop";
    $password = "M5mmK6JTtCyNkBMf";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connect to db error: " . $conn->connect_error);
    }

    $sql = "select count(*) as cnt from jy_shop_balance_daily where to_days(now()) = to_days(count_day) limit 3";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if ($row['cnt'] > 0) {
            die("Have saved today's balance data");
        }
    }

    $sql = "select o.seller_id as shopid, sum(o.real_amount) as balance, o.completion_time as count_day, s.username as shopname from jy_order o left join jy_shop_member s on o.seller_id = s.id where to_days(now()) = to_days(o.completion_time) group by o.seller_id";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
            $shopid = $row['shopid'];
            $shopname = $row['shopname'];
            $countDay = $row['count_day'];
            $balance = $row['balance'];
            $sql = "insert into jy_shop_balance_daily (shopname, count_day, balance, shopid) values(\"$shopname\", \"$countDay\", $balance, $shopid)";
            if(!$conn->query($sql)) {
                echo "execute $sql failure";
            }

        }
    }
?>