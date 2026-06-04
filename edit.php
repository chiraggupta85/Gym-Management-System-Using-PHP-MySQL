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

    $query = "SELECT * FROM members WHERE id=$id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    } else {
        die("User not found ");
    }
} else {
    die("Invalid Request ");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Member</title>

    <style>
        body {
            font-family: Arial;
            background: lightgray;
        }

        .form-box {
            width: 400px;
            margin: 80px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px gray;
        }

        h2 {
            text-align: center;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        button {
            width: 100%;
            padding: 10px;
            background: green;
            color: white;
            border: none;
            border-radius: 5px;
        }

        button:hover {
            background: darkgreen;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Edit Member</h2>

    <form action="update.php" method="POST">

        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

        Name:
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required>

        Email:
        <input type="email" name="email" value="<?php echo $row['email']; ?>" required>

        Phone:
        <input type="text" name="phone" value="<?php echo $row['phone']; ?>" required>

        Plan:
        <select name="plan" required>
            <option value="Basic" <?php if($row['plan']=="Basic") echo "selected"; ?>>Basic</option>
            <option value="Standard" <?php if($row['plan']=="Standard") echo "selected"; ?>>Standard</option>
            <option value="Premium" <?php if($row['plan']=="Premium") echo "selected"; ?>>Premium</option>
        </select>

        <button type="submit">Update</button>

    </form>
</div>

</body>
</html>
