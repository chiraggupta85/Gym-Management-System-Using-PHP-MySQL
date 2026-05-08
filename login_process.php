<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "gym_db");

if (!$conn) {
    die("Connection Failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM members WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            // ✅ Session set
            $_SESSION['user'] = $email;
            $_SESSION['role'] = $row['role'];

            // 🎯 Role check
            if ($row['role'] == 'admin') {

                echo "<h2>Admin Login Successful 👑</h2>";
                header("refresh:2;url=display.php");

            } else {

                echo "<h2>User Login Successful 👤</h2>";
                header("refresh:2;url=dashboard.php");

            }

        } else {
            echo "<h3>Wrong Password ❌</h3>";
        }

    } else {
        echo "<h3>User Not Found ❌</h3>";
    }
}
?>