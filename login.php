<?php
session_start();

// Already login redirect
if(isset($_SESSION['user'])){

    if($_SESSION['role'] == 'admin'){
        header("Location: display.php");
        exit();
    }

    else{
        header("Location: dashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Login - OldSkoll Gym</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;

            background:linear-gradient(135deg, black, gray);
        }

        .login-box{

            width:380px;

            background:white;

            padding:40px;

            border-radius:15px;

            box-shadow:0 0 20px black;

            text-align:center;
        }

        .gym-icon{

            font-size:55px;

            margin-bottom:10px;
        }

        .login-box h1{

            margin-bottom:10px;

            color:black;
        }

        .login-box p{

            color:gray;

            margin-bottom:25px;
        }

        .input-box{

            margin-bottom:20px;

            text-align:left;
        }

        .input-box label{

            font-weight:bold;

            display:block;

            margin-bottom:6px;
        }

        .input-box input{

            width:100%;

            padding:12px;

            border:1px solid lightgray;

            border-radius:8px;

            outline:none;
        }

        .input-box input:focus{

            border-color:red;

            box-shadow:0 0 5px red;
        }

        .login-btn{

            width:100%;

            padding:12px;

            border:none;

            background:red;

            color:white;

            font-size:16px;

            border-radius:8px;

            cursor:pointer;
        }

        .login-btn:hover{

            background:darkred;
        }

        .bottom-text{

            margin-top:20px;

            font-size:14px;
        }

        .bottom-text a{

            text-decoration:none;

            color:red;

            font-weight:bold;
        }

    </style>

</head>

<body>

<div class="login-box">

    <div class="gym-icon">
        💪
    </div>

    <h1>
        OldSkoll Gym
    </h1>

    <p>
        Login to Continue
    </p>

    <form action="login_process.php" method="POST">

        <div class="input-box">

            <label>Email</label>

            <input type="email"
                   name="email"
                   placeholder="Enter Email"
                   required>

        </div>



        <div class="input-box">

            <label>Password</label>

            <input type="password"
                   name="password"
                   placeholder="Enter Password"
                   required>

        </div>



        <button type="submit" class="login-btn">

            Login

        </button>

    </form>



    <div class="bottom-text">

        New User?

        <a href="index.php">
            Register Here
        </a>

    </div>

</div>

</body>
</html>