<?php
    include 'connection.php';
    $flavor = $conn->query("SELECT * FROM `flavor`");
    $cone = $conn->query("SELECT * FROM `cone`");
    $cup = $conn->query("SELECT * FROM `cup`");
    $toppings = $conn->query("SELECT * FROM `toppings`");
    $add_ons = $conn->query("SELECT * FROM `addons`");

    function idConvert($id)  {
        return str_replace(' ','_',$id);
    }
?>