<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>path</title>
</head>

<body>
    <p>
        <?php
        set_time_limit(0);
        $DBNAME = "test";
        $DBUSER = "root";
        $DBPASSWD = "sightseeing";
        $DBHOST = "140.136.155.116";

        $link = mysqli_connect($DBHOST, $DBUSER, $DBPASSWD);
        if (empty($link)) {
            echo mysqli_error($link);
            die("無法連接資料庫");
            exit;
        }

        if (!mysqli_select_db($link, $DBNAME)) {
            die("無法選擇資料庫");
        }
        mysqli_query($link, "SET NAMES 'utf8'");

        # 輸入條件
        $cname = "新北";
        $sitename = "十分老街";
        # 幾層
        $times = 2;

        $list = array();
        $tlist = array();
        $edge = array();
        array_push($edge, ["from_id", "to_id", "d_edge"]);

        $aid = array();
        $aedge = array();
        $alevel = array();
        $nlist = array();
        $no = array();
        $node = array();
        # array_push($node, ["sid", "near_site", "city_name", "level"]); #mac
        array_push($node, ["sid", "level"]); #windows


        # 找sitename的id
        $s_sql = "SELECT DISTINCT sid FROM comment_relationship WHERE near_site = '$sitename'";
        if ($s = $link->query($s_sql)) {
            while ($fieldinfo = $s->fetch_object()) {
                $sid = $fieldinfo->sid;
                # echo $sid . "<br>";

                array_push($list, $sid);
                array_push($aid, $sid);
                array_push($aedge, 100);
                array_push($alevel, "起始點");
                array_push($no, [$sid, "起始點"]);

                # 找下一層
                for ($i = 0; $i < $times; $i++) {
                    foreach ($list as $value) {
                        $rela_sql = "SELECT * FROM path_relationship WHERE from_id = '$value'";
                        $rela = mysqli_query($link, $rela_sql);

                        while ($row = mysqli_fetch_array($rela, MYSQLI_ASSOC)) {
                            $from_id = $row["from_id"];
                            $to_id = $row["to_id"];
                            $d_edge = $row["d_edge"] * 10;
                            # echo $from_id. "<br>";
                            # echo "to_id: ". $to_id. "<br>";
                            # echo $d_edge. "<br>";

                            # 製成edge表
                            $count = ($i + 1);
                            $group = "第 " . ($count) . " 層";
                            # echo $group. "<br>";

                            array_push($tlist, $to_id);
                            if (!in_array([$from_id, $to_id, $d_edge], $edge)) {
                                array_push($edge, [$from_id, $to_id, $d_edge]);
                            }

                            # node
                            if (!in_array([$to_id, $group], $no)) {
                                array_push($aid, $to_id);
                                array_push($aedge, $d_edge);
                                array_push($alevel, $group);
                            }
                            if (!in_array($to_id, $nlist)) {
                                array_push($nlist, $to_id);
                            }
                        }
                    }
                    $list = $tlist;
                    $tlist = array();
                }

                # 製成node表

                $bid = array();
                $ed = array();
                $lev = array();
                foreach ($nlist as $ta) {
                    $max = 1;
                    $key = array_keys($aid, $ta, true);
                    # print_r($key);

                    foreach ($key as $test) {
                        if (sizeof($key) == 1) {
                            # echo sizeof($key). "<br>";
                            array_push($no, [$aid[$test], $alevel[$test]]);
                        } else {
                            if ($aedge[$test] > $max) {
                                $max = $aedge[$test];

                                if (!in_array([$aid[$test], $alevel[$test]], $no)) {
                                    array_push($bid, $aid[$test]);
                                    array_push($ed, $aedge[$test]);
                                    array_push($lev, $alevel[$test]);
                                }
                            }
                        }
                    }

                    if (sizeof($ed) > 0) {
                        # echo max($ed). "<br>";
                        # print_r($ed);

                        $maxedge = max($ed);
                        $find = array_search($maxedge, $ed);
                        $newid = $bid[$find];
                        $newlevel = $lev[$find];
                        # echo "<br>". $newid. "<br>";
                        # echo $newlevel. "<br>";
                        if (!in_array([$newid, $newlevel], $no) and $newid != $sid) {
                            array_push($no, [$newid, $newlevel]);
                        }
                    }
                    $bid = array();
                    $ed = array();
                    $lev = array();
                    # echo "<br>";
                }
                # echo sizeof($no). "<br>";

                foreach ($no as $test) {
                    # echo "to_id: ". $test[0]. ", 層: ". $test[1]. "<br>";
                    $level = $test[1];
                    $site_sql = "SELECT DISTINCT sid, near_site, city_name FROM comment_relationship WHERE sid = '$test[0]'";
                    $site = mysqli_query($link, $site_sql);

                    while ($row2 = mysqli_fetch_array($site, MYSQLI_ASSOC)) {
                        $nid = $row2["sid"];
                        $near_site = $row2["near_site"];
                        $city_name = $row2["city_name"];
                        # echo $near_site. "<br>";
                        # echo $level. "<br>";

                        # array_push($node, [$nid, $near_site, $city_name, $level]); #mac
                        array_push($node, [$nid, $level]); #windows
                    }
                }


                # print_r($node);
                # print_r($no);
                # echo sizeof($node);


                #輸出
                $nfp = fopen('path_node.csv', 'w');
                foreach ($node as $nofield) {
                    fputcsv($nfp, $nofield);
                }

                fclose($nfp);

                $fp = fopen('path_edge.csv', 'w');
                foreach ($edge as $fields) {
                    fputcsv($fp, $fields);
                }

                fclose($fp);

                echo "完成" . "<br>";

                mysqli_close($link);
            }
            # $s -> free_result();
        }
        ?>
    </p>

    <!--
	<table  border="1">

		<tr>

		<td>from_id</td>

		<td>to_id</td>

		<td>d_edge</td>

		</tr>

		<?php
        while ($row = mysqli_fetch_array($rela, MYSQLI_ASSOC)) {
            #echo $row["sid"];
        ?>

		<tr>

			<td><?php echo $row["from_id"];   ?></td>

			<td><?php echo $row["to_id"];   ?></td>

			<td><?php echo $row["d_edge"]; ?></td>

		</tr>

		#<?php }
        #	}
        # $s -> free_result();
        #}

        #
            ?>

	</table>


	$sec_fields=mysqli_num_fields($sec); // 取得欄位數
	$sec_records=mysqli_num_rows($sec);  // 取得記錄數

		$sn_sql = "select distinct sid, near_site, city_name from comment_relationship where city_name ='$cname'";
		$sr_sql = "SELECT DISTINCT p.from_id, p.to_id, p.d_edge FROM path_relationship p, comment_relationship r1, comment_relationship r2
					WHERE (p.from_id = r1.sid AND p.to_id = r2.sid)
					AND (r1.city_name = '$cname' AND r2.city_name = '$cname'";

		$sn = mysqli_query($link, $sn_sql);
		$sr = mysqli_query($link, $sr_sql);



		$arr = array([1,"1"], [2,"2"], [3,"3"], [4,"4"]);
		foreach ($arr as &$value) {
			$value[0] = $value[0] * 2;
			$value[1] = "我超棒";
		}
		unset($value);

		if ($test[1] < $ta[$j][1]){
			$test[1] = $ta[$j][1];
			$test[2] = $ta[$j][2];
			echo "to_id: ". $test[0]. ", d_dege: ". $test[1]. ", ".  $test[2]. "<br>";
			#array_push($ta, [$test[0], $test[1], $test[2]]);
		}


-->

</body>

</html>
