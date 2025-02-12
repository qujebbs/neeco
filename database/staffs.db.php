<?php
    include 'src/init.php';

    function get_all_staff()
    {
        global $con;
        $list = array();

        $sql = "SELECT *
            FROM staff";

        $qry = $con->query($sql);

        $rowcount = mysqli_num_rows($qry);

        if ($rowcount != 0) {
            while ($row = mysqli_fetch_assoc($qry)) {
                $list[] = $row;
            }
            return $list;
        }
        return null;
    }