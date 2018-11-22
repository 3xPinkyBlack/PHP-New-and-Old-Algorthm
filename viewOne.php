<?php
    $sql = "SELECT * FROM ".$ui." WHERE userID='".$ref."' ORDER BY MD DESC";

    $rs = $conn->query($sql);
    $rows = $rs->num_rows;

    if($rows == 0) {
        echo "<br><strong>You Don't Have any Message With ".$refName."</strong>";
    } else {
        $a = $rows;
        if($_GET["i"] == null) {
            $i = 6;
        } else {
            $i = $_GET["i"] + 6;
        }

        $b = $a - $i;
        $e = 0;
        $c = $i;

        if($i > 6) {
            $f = $i - 12;
            if($f < 0) {
                $f = 0;
            }
            echo "<br><br><span><a href='messages.php?ref=".$ref."&i=".$f."'>See Newer Messages</a></span><br><br>";
        }
        while($rw = $rs->fetch_assoc()) {
            if($a > $b && $e < $i && $c <= 6) {
                echo "<div class='hh'><strong>";
                if($rw["sender"] == "me") {
                    echo "You</strong> - ".$rw["MD"];
                    echo "</div><br>";
                    echo $rw["mess"];
                    if($rw["image"] != null) {
                        echo "<img src='pics/".$rw["image"]."'>";
                    }
                } else {
                    echo $refName."</strong> - ".$rw["MD"];
                    echo "</div><br>";
                    echo $rw["mess"];
                    if($rw["image"] != null) {
                        echo "<img src='pics/".$rw["image"]."'>";
                    }
                }
                include 'deleteForm.php';
            } 

            $a--;
            $c--;
            $e++;
        }
    }

    if($i <= $rows && $rows > 6) {
        echo "<br><br><span><a href='messages.php?ref=".$ref."&i=".$i."'>See Older Messages</a></span>";
    }
?>