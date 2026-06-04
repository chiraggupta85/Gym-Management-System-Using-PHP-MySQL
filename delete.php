<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "gym_db");

if (!$conn) {
    die("Connection Failed");
}

if(isset($_GET['id'])){

    $id = intval($_GET['id']);

    $query = "DELETE FROM members WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: display.php");
        exit();
    } else {
        echo "Delete Failed ";
    }

} else {
    echo "Invalid Request ";
}
?>
