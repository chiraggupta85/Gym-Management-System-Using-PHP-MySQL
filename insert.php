<?php

// Form submit check
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "gym_db");

    // Connection check
    if (!$conn) {
        die("Connection Failed: " . mysqli_connect_error());
    }

    // Form data
    $username = $_POST['username'];

    // Password hash
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $plan  = $_POST['plan'];



    /*
    -----------------------------------
    🔍 CHECK DUPLICATE USERNAME
    -----------------------------------
    */

    $check = "SELECT * FROM members WHERE username='$username'";

    $result = mysqli_query($conn, $check);

    if(mysqli_num_rows($result) > 0){

        echo "Username Already Exists ❌";
        exit();

    }



    /*
    -----------------------------------
    📝 INSERT DATA
    -----------------------------------
    */

    $sql = "INSERT INTO members
            (username, password, name, email, phone, plan)

            VALUES

            ('$username', '$password', '$name', '$email', '$phone', '$plan')";



    /*
    -----------------------------------
    ✅ INSERT SUCCESS
    -----------------------------------
    */

    if(mysqli_query($conn, $sql)){

        // Redirect to login page
        header("Location: login.php");
        exit();

    }else{

        echo "Error: " . mysqli_error($conn);

    }



    /*
    -----------------------------------
    🔚 CLOSE CONNECTION
    -----------------------------------
    */

    mysqli_close($conn);

}else{

    echo "Access Denied ❌";

}

?>