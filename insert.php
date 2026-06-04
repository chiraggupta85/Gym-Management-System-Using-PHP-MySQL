<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $conn = mysqli_connect("localhost", "root", "", "gym_db");

    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    $username = $_POST['username'];

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $plan  = $_POST['plan'];


    $check = "SELECT * FROM members WHERE username='$username'";

    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0){

        echo "Username Already Exists ";
        exit();

    }


    $sql = "INSERT INTO members
            (username, password, name, email, phone, plan)

            VALUES

            ('$username', '$password', '$name', '$email', '$phone', '$plan')";

    if(mysqli_query($conn, $sql)){


        header("Location: login.php");
        exit();

    }else{

        echo "Error: " . mysqli_error($conn);

    }

    mysqli_close($conn);

}else{

    echo "Access Denied ";

}

?>
