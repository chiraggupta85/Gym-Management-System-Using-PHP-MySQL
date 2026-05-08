<?php
session_start();

// 🔐 Login check
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "gym_db");

if (!$conn) {
    die("Connection Failed");
}

// Check POST
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $id = intval($_POST['id']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $plan = $_POST['plan'];

    // ✅ Correct query
    $query = "UPDATE members SET 
                name='$name',
                email='$email',
                phone='$phone',
                plan='$plan'
              WHERE id=$id";

    if(mysqli_query($conn, $query)){
        header("Location: display.php");
        exit();
    } else {
        echo "Update Failed ❌";
    }

} else {
    echo "Invalid Request ❌";
}
?>