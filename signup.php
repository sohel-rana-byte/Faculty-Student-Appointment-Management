<?php
session_start(); // Start the session before any HTML output

$_SESSION["user"] = "";
$_SESSION["usertype"] = "";

// Set the timezone
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$_SESSION["date"] = $date;

if ($_POST) {
    $_SESSION["personal"] = array(
        'fname' => $_POST['fname'],
        'lname' => $_POST['lname'],
        'address' => $_POST['address'],
        'nic' => $_POST['nic'],
        'dob' => $_POST['dob']
    );

    header("location: create-account.php");
    exit(); // Ensure no further code executes after the redirect
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/signup.css">
    <title>Dynamic Sign Up</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            transition: all 0.8s ease;
        }

        .container {
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.85);
            margin: 50px auto;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }

        .container:hover {
            transform: scale(1.02);
            box-shadow: 0px 15px 30px rgba(0, 0, 0, 0.3);
        }

        .header-text {
            font-size: 32px;
            font-weight: bold;
            color: var(--primary-color);
            margin-bottom: 10px;
            text-align: center;
        }

        .sub-text {
            font-size: 18px;
            color: var(--secondary-color);
            margin-bottom: 20px;
            text-align: center;
        }

        .form-label {
            font-size: 16px;
            font-weight: bold;
            color: var(--label-color);
        }

        .input-text {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .input-text:focus {
            border-color: var(--primary-color);
            outline: none;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border: none;
            border-radius: 10px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: #fff;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover-color);
            transform: translateY(-2px);
        }

        .btn-primary-soft {
            background-color: #ccc;
            color: #333;
        }

        .btn-primary-soft:hover {
            background-color: #bbb;
        }

        .hover-link1 {
            color: var(--link-color);
            text-decoration: none;
        }

        .hover-link1:hover {
            text-decoration: underline;
        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const hour = new Date().getHours();
            const root = document.documentElement;

            if (hour >= 5 && hour < 12) {
                // Morning theme
                root.style.setProperty('--primary-color', '#FFA726');
                root.style.setProperty('--primary-hover-color', '#FB8C00');
                root.style.setProperty('--secondary-color', '#FFCC80');
                root.style.setProperty('--label-color', '#E65100');
                root.style.setProperty('--link-color', '#E65100');
                document.body.style.backgroundImage = "linear-gradient(to bottom, #FFEB3B, #FF9800)";
            } else if (hour >= 12 && hour < 18) {
                // Afternoon theme
                root.style.setProperty('--primary-color', '#29B6F6');
                root.style.setProperty('--primary-hover-color', '#0288D1');
                root.style.setProperty('--secondary-color', '#B3E5FC');
                root.style.setProperty('--label-color', '#01579B');
                root.style.setProperty('--link-color', '#0288D1');
                document.body.style.backgroundImage = "linear-gradient(to bottom, #81D4FA, #29B6F6)";
            } else if (hour >= 18 && hour < 22) {
                // Evening theme
                root.style.setProperty('--primary-color', '#AB47BC');
                root.style.setProperty('--primary-hover-color', '#8E24AA');
                root.style.setProperty('--secondary-color', '#E1BEE7');
                root.style.setProperty('--label-color', '#4A148C');
                root.style.setProperty('--link-color', '#7B1FA2');
                document.body.style.backgroundImage = "linear-gradient(to bottom, #CE93D8, #AB47BC)";
            } else {
                // Night theme
                root.style.setProperty('--primary-color', '#37474F');
                root.style.setProperty('--primary-hover-color', '#263238');
                root.style.setProperty('--secondary-color', '#90A4AE');
                root.style.setProperty('--label-color', '#212121');
                root.style.setProperty('--link-color', '#37474F');
                document.body.style.backgroundImage = "linear-gradient(to bottom, #263238, #455A64)";
                document.body.style.color = '#ECEFF1';
            }
        });
    </script>
</head>

<body>
    <center>
        <div class="container">
            <form action="" method="POST">
                <p class="header-text">Let's Get Started</p>
                <p class="sub-text">Add Your Personal Details to Continue</p>

                <label for="name" class="form-label">Name:</label>
                <div style="display: flex; gap: 10px;">
                    <input type="text" name="fname" class="input-text" placeholder="First Name" required>
                    <input type="text" name="lname" class="input-text" placeholder="Last Name" required>
                </div>

                <label for="address" class="form-label">Address:</label>
                <input type="text" name="address" class="input-text" placeholder="Address" required>

                <label for="nic" class="form-label">NID:</label>
                <input type="text" name="nic" class="input-text" placeholder="NID Number" required>

                <label for="dob" class="form-label">Date of Birth:</label>
                <input type="date" name="dob" class="input-text" required>

                <div style="display: flex; justify-content: space-between; margin-top: 20px;">
                    <input type="reset" value="Reset" class="login-btn btn-primary-soft">
                    <input type="submit" value="Next" class="login-btn btn-primary">
                </div>

                <p class="sub-text" style="margin-top: 20px;">
                    Already have an account?
                    <a href="login.php" class="hover-link1">Login</a>
                </p>
            </form>
        </div>
    </center>
</body>

</html>