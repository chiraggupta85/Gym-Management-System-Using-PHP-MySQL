<?php
session_start();

if(!isset($_SESSION['user']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

$conn = mysqli_connect("localhost", "root", "", "gym_db");

if(!$conn){
    die("Connection Failed");
}



if(isset($_GET['search']) && $_GET['search'] != ""){

    $search = mysqli_real_escape_string($conn, $_GET['search']);

    $query = "SELECT * FROM members
              WHERE name LIKE '%$search%'
              OR email LIKE '%$search%'";

}else{

    $query = "SELECT * FROM members";
}

$result = mysqli_query($conn, $query);

$totalMembersQuery = "SELECT COUNT(*) AS total FROM members";
$totalMembersResult = mysqli_query($conn, $totalMembersQuery);
$totalMembers = mysqli_fetch_assoc($totalMembersResult)['total'];

$totalAdminsQuery = "SELECT COUNT(*) AS total FROM members WHERE role='admin'";
$totalAdminsResult = mysqli_query($conn, $totalAdminsQuery);
$totalAdmins = mysqli_fetch_assoc($totalAdminsResult)['total'];

$trainerQuery = "SELECT COUNT(*) AS total FROM members WHERE role='trainer'";
$trainerResult = mysqli_query($conn, $trainerQuery);
$trainers = mysqli_fetch_assoc($trainerResult)['total'];

$premiumQuery = "SELECT COUNT(*) AS total FROM members WHERE plan='Premium'";
$premiumResult = mysqli_query($conn, $premiumQuery);
$premiumUsers = mysqli_fetch_assoc($premiumResult)['total'];

$basicQuery = "SELECT COUNT(*) AS total FROM members WHERE plan='Basic'";
$basicResult = mysqli_query($conn, $basicQuery);
$basicUsers = mysqli_fetch_assoc($basicResult)['total'];

$standardQuery = "SELECT COUNT(*) AS total FROM members WHERE plan='Standard'";
$standardResult = mysqli_query($conn, $standardQuery);
$standardUsers = mysqli_fetch_assoc($standardResult)['total'];

?>

<!DOCTYPE html>
<html>
<head>

    <title>Admin Dashboard</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{

            background:linear-gradient(135deg, black, gray);

            padding:20px;
        }

        .container{

            width:95%;

            margin:auto;

            background:white;

            padding:25px;

            border-radius:15px;

            box-shadow:0 0 20px black;
        }

        .top{

            display:flex;

            justify-content:space-between;

            align-items:center;

            margin-bottom:20px;
        }

        .top h2{

            color:black;
        }

        .logout{

            background:red;

            color:white;

            padding:10px 15px;

            text-decoration:none;

            border-radius:8px;

            font-weight:bold;
        }

        .logout:hover{

            background:darkred;
        }



        /* DASHBOARD CARDS */

        .cards{

            display:flex;

            flex-wrap:wrap;

            gap:20px;

            justify-content:center;

            margin-bottom:30px;
        }

        .card{

            width:220px;

            padding:25px;

            border-radius:15px;

            color:white;

            text-align:center;

            box-shadow:0 0 10px gray;

            transition:0.3s;
        }

        .card:hover{

            transform:scale(1.05);
        }

        .card h1{

            margin-top:10px;

            font-size:40px;
        }

        .members{
            background:blue;
        }

        .admins{
            background:red;
        }

        .trainers{
            background:green;
        }

        .premium{
            background:purple;
        }

        .basic{
            background:orange;
        }

        .standard{
            background:black;
        }



        /* SEARCH */

        .search-box{

            text-align:center;

            margin-bottom:25px;
        }

        .search-box input{

            padding:10px;

            width:250px;

            border:1px solid gray;

            border-radius:8px;
        }

        .search-box button{

            padding:10px 15px;

            border:none;

            background:red;

            color:white;

            border-radius:8px;

            cursor:pointer;
        }

        .search-box button:hover{

            background:darkred;
        }

        .search-box a{

            text-decoration:none;

            margin-left:10px;

            color:red;

            font-weight:bold;
        }



        /* TABLE */

        table{

            width:100%;

            border-collapse:collapse;

            overflow:hidden;

            border-radius:10px;
        }

        table th{

            background:black;

            color:white;

            padding:14px;
        }

        table td{

            padding:12px;

            text-align:center;
        }

        table tr:nth-child(even){

            background:lightgray;
        }

        table tr:hover{

            background:gainsboro;
        }



        /* BUTTONS */

        .btn{

            padding:7px 12px;

            text-decoration:none;

            color:white;

            border-radius:6px;

            font-size:14px;
        }

        .edit{

            background:green;
        }

        .edit:hover{

            background:darkgreen;
        }

        .delete{

            background:red;
        }

        .delete:hover{

            background:darkred;
        }

    </style>

</head>

<body>

<div class="container">

    <!-- TOP BAR -->

    <div class="top">

        <h2>
            Welcome Admin 
        </h2>

        <a class="logout" href="logout.php">
            Logout
        </a>

    </div>



    <!-- DASHBOARD CARDS -->

    <div class="cards">

        <div class="card members">

            Total Members

            <h1>
                <?php echo $totalMembers; ?>
            </h1>

        </div>



        <div class="card admins">

            Total Admins

            <h1>
                <?php echo $totalAdmins; ?>
            </h1>

        </div>



        <div class="card trainers">

            Total Trainers

            <h1>
                <?php echo $trainers; ?>
            </h1>

        </div>



        <div class="card premium">

            Premium Users

            <h1>
                <?php echo $premiumUsers; ?>
            </h1>

        </div>



        <div class="card basic">

            Basic Users

            <h1>
                <?php echo $basicUsers; ?>
            </h1>

        </div>



        <div class="card standard">

            Standard Users

            <h1>
                <?php echo $standardUsers; ?>
            </h1>

        </div>

    </div>



    <!-- SEARCH BOX -->

    <div class="search-box">

        <form method="GET">

            <input type="text"
                   name="search"
                   placeholder="Search by Name or Email">

            <button type="submit">
                Search
            </button>

            <a href="display.php">
                Clear
            </a>

        </form>

    </div>



    <!-- TABLE -->

    <table>

        <tr>

            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Plan</th>
            <th>Role</th>
            <th>Action</th>

        </tr>

<?php

if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){

?>

        <tr>

            <td>
                <?php echo $row['id']; ?>
            </td>

            <td>
                <?php echo $row['name']; ?>
            </td>

            <td>
                <?php echo $row['email']; ?>
            </td>

            <td>
                <?php echo $row['phone']; ?>
            </td>

            <td>
                <?php echo $row['plan']; ?>
            </td>

            <td>
                <?php echo $row['role']; ?>
            </td>

            <td>

                <!-- EDIT -->

                <a class="btn edit"
                   href="edit.php?id=<?php echo $row['id']; ?>">

                   Edit

                </a>



                <!-- DELETE -->

                <a class="btn delete"
                   href="delete.php?id=<?php echo $row['id']; ?>"
                   onclick="return confirm('Are you sure?');">

                   Delete

                </a>

            </td>

        </tr>

<?php

    }

}else{

    echo "<tr><td colspan='7'>No Data Found</td></tr>";
}

?>

    </table>

</div>

</body>
</html>
