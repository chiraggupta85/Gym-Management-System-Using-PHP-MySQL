<?php
session_start();

// 🔐 User only
if(!isset($_SESSION['user']) || $_SESSION['role'] != 'user'){
    header("Location: login.php");
    exit();
}

// DB Connection
$conn = mysqli_connect("localhost", "root", "", "gym_db");

$email = $_SESSION['user'];

// User Data
$query = "SELECT * FROM members WHERE email='$email'";

$result = mysqli_query($conn, $query);

$data = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
<head>

    <title>User Dashboard</title>

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

        .dashboard{

            width:420px;

            background:white;

            padding:35px;

            border-radius:18px;

            box-shadow:0 0 20px black;

            text-align:center;
        }

        .profile{

            font-size:70px;

            margin-bottom:10px;
        }

        .dashboard h2{

            margin-bottom:10px;

            color:black;
        }

        .role{

            display:inline-block;

            background:green;

            color:white;

            padding:5px 12px;

            border-radius:20px;

            font-size:14px;

            margin-bottom:25px;
        }

        .info{

            background:whitesmoke;

            padding:15px;

            border-radius:12px;

            margin-bottom:15px;

            text-align:left;
        }

        .info p{

            margin:10px 0;

            font-size:16px;
        }

        .info b{

            color:black;
        }

        .btns{

            margin-top:20px;

            display:flex;

            justify-content:center;

            gap:15px;
        }

        .btn{

            padding:10px 18px;

            color:white;

            text-decoration:none;

            border-radius:8px;

            font-weight:bold;

            transition:0.3s;
        }

        .edit{

            background:green;
        }

        .edit:hover{

            background:darkgreen;
        }

        .logout{

            background:red;
        }

        .logout:hover{

            background:darkred;
        }

    </style>

</head>

<body>

<div class="dashboard">

    <!-- PROFILE ICON -->

    <div class="profile">
        👤
    </div>

    <!-- USER NAME -->

    <h2>
        Welcome <?php echo $data['name']; ?> 👋
    </h2>

    <!-- ROLE -->

    <div class="role">
        USER
    </div>



    <!-- USER INFO -->

    <div class="info">

        <p>
            <b>Email:</b>
            <?php echo $data['email']; ?>
        </p>

        <p>
            <b>Phone:</b>
            <?php echo $data['phone']; ?>
        </p>

        <p>
            <b>Plan:</b>
            <?php echo $data['plan']; ?>
        </p>

    </div>



    <!-- BUTTONS -->

    <div class="btns">

        <a class="btn edit"
           href="edit.php?id=<?php echo $data['id']; ?>">

           Edit Profile

        </a>



        <a class="btn logout"
           href="logout.php">

           Logout

        </a>

    </div>

</div>

</body>
</html>