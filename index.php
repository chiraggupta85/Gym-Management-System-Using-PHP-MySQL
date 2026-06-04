<?php
session_start();

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OldSkoll Gym</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial;
        }

        body {
            background: lightgray;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: black;
            color: white;
            padding: 15px 50px;
        }

        .navbar a {
            color: white;
            margin: 10px;
            text-decoration: none;
        }

        .navbar a:hover {
            color: red;
        }

        /* Hero */
        .hero {
            text-align: center;
            padding: 120px 20px;
            background: black;
            color: white;
        }

        .hero button {
            padding: 10px 20px;
            background: red;
            border: none;
            color: white;
            margin-top: 15px;
            cursor: pointer;
        }

        section {
            padding: 50px;
            text-align: center;
        }

        /* Cards */
        .card {
            display: inline-block;
            background: white;
            padding: 20px;
            margin: 15px;
            width: 220px;
            border-radius: 10px;
        }

        .card:hover {
            background: lightblue;
        }

        /* Form */
        .form-section input, 
        .form-section select {
            width: 60%;
            padding: 10px;
            margin: 10px;
        }

        .form-section button {
            padding: 10px 20px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        /* Footer */
        footer {
            background: black;
            color: white;
            text-align: center;
            padding: 15px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <header class="navbar">
        <h2>OldSkoll Gym</h2>
        <nav>
            <a href="#">Home</a>
            <a href="#">Plans</a>
            <a href="#">Trainers</a>
            <a href="#">Contact</a>
        </nav>
    </header>

    <!-- Hero -->
    <section class="hero">
        <h1>Build Your Body </h1>
        <p>Join the best gym and stay fit</p>
        <button>Join Now</button>
    </section>

    <!-- Plans -->
    <section>
        <h2>Membership Plans</h2>
        <div class="card">Basic - ₹999/month</div>
        <div class="card">Standard - ₹1999/month</div>
        <div class="card">Premium - ₹2999/month</div>
    </section>

    <!-- Trainers -->
    <section>
        <h2>Our Trainers</h2>
        <div class="card">Anand - Fitness Trainer</div>
        <div class="card">Deepak - Yoga Expert</div>
    </section>

    <!-- Registration Form -->
    <section class="form-section">
        <h2>Register Now</h2>

        <form action="insert.php" method="POST">
            <input type="text" name="username" placeholder="Enter Username" required><br>
            <input type="password" name="password" placeholder="Enter Password" required><br>
            <input type="text" name="name" placeholder="Enter Name" required><br>
            <input type="email" name="email" placeholder="Enter Email" required><br>
            <input type="text" name="phone" placeholder="Enter Phone" required><br>

            <select name="plan" required>
                <option value="">Select Plan</option>
                <option value="Basic">Basic</option>
                <option value="Standard">Standard</option>
                <option value="Premium">Premium</option>
            </select><br>

            <button type="submit">Submit</button>
        </form>
    </section>

    <!-- Footer -->
    <footer>
        <p>OldSkoll Gym</p>
    </footer>

</body>
</html>
