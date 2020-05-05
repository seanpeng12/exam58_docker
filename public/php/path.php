<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>path</title>
</head>

<body>
    <p>
        <?php
        parse_str(implode('&', array_slice($argv, 1)), $_GET);
        if( empty($argv[1])){
            print "尚未傳入參數：請輸入正確指令：";
            exit;
        }else{
            print "運算中。。。";
        }
            
        set_time_limit(0);
        $DBNAME = "homestead";
        $DBUSER = "root";
        $DBPASSWD = "sightseeing";
        $DBHOST = "127.0.0.1";
    
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
        # $cname = "嘉義縣";
        # $sitename = "阿里山神木群";
            
        $cname = $_GET['city'];
        $sitename = $_GET['site'];
            
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
        array_push($node, ["sid", "near_site", "city_name", "level", "color"]); #mac
        # array_push($node, ["sid", "level", "color"]); #windows


        # 找sitename的id
        $s_sql = "SELECT DISTINCT sid FROM comment_relationship WHERE near_site = '$sitename'";
        if ($s = $link->query($s_sql)) {
            while ($fieldinfo = $s->fetch_object()) {
                $sid = $fieldinfo->sid;

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

                        $maxedge = max($ed);
                        $find = array_search($maxedge, $ed);
                        $newid = $bid[$find];
                        $newlevel = $lev[$find];

                        if (!in_array([$newid, $newlevel], $no) and $newid != $sid) {
                            array_push($no, [$newid, $newlevel]);
                        }
                    }
                    $bid = array();
                    $ed = array();
                    $lev = array();
                }

                foreach ($no as $test) {
                    $level = $test[1];
                    $site_sql = "SELECT DISTINCT sid, near_site, city_name FROM comment_relationship WHERE sid = '$test[0]'";
                    $site = mysqli_query($link, $site_sql);

                    while ($row2 = mysqli_fetch_array($site, MYSQLI_ASSOC)) {
                        $nid = $row2["sid"];
                        $near_site = $row2["near_site"];
                        $city_name = $row2["city_name"];

                        if (strcmp($level, '起始點') == 0) {
                            $color = "#ffcc33";
                            array_push($node, [$nid, $near_site, $city_name, $level, $color]); #mac
                            # array_push($node, [$nid, $level, $color]); #windows
                        } elseif (strcmp($level, '第 1 層') == 0) {
                            $color = "#699c4c";
                            array_push($node, [$nid, $near_site, $city_name, $level, $color]); #mac
                            # array_push($node, [$nid, $level, $color]); #windows
                        } elseif (strcmp($level, '第 2 層') == 0) {
                            $color = "#0066cc";
                            array_push($node, [$nid, $near_site, $city_name, $level, $color]); #mac
                            # array_push($node, [$nid, $level, $color]); #windows
                        }
                    }
                }
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
        }
        ?>
    </p>

</body>

</html>
