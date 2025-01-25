<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/signup.css">

    <title>Create Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            transition: background-color 0.5s ease;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        .header-text {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            text-align: center;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .sub-text {
            font-size: 16px;
            color: #666;
            text-align: center;
            margin-bottom: 20px;
            transition: color 0.3s ease;
        }

        .form-label {
            font-size: 14px;
            font-weight: bold;
            color: #444;
            display: block;
            margin-bottom: 5px;
        }

        .input-text {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .login-btn {
            width: 48%;
            padding: 10px;
            margin-top: 10px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .btn-primary {
            background-color: #0047ab;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #003580;
            transform: scale(1.05);
        }

        .btn-primary-soft {
            background-color: #e0e0e0;
            color: #333;
        }

        .btn-primary-soft:hover {
            background-color: #ccc;
            transform: scale(1.05);
        }

        .hover-link1 {
            color: #0047ab;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .hover-link1:hover {
            text-decoration: underline;
            color: #002f6c;
        }

        .error-text {
            color: #ff3e3e;
            text-align: center;
            font-size: 14px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <?php
    session_start();
    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    $_SESSION["date"] = $date;

    include("connection.php");

    if ($_POST) {
        $fname = $_SESSION['personal']['fname'];
        $lname = $_SESSION['personal']['lname'];
        $name = $fname . " " . $lname;
        $address = $_SESSION['personal']['address'];
        $nic = $_SESSION['personal']['nic'];
        $dob = $_SESSION['personal']['dob'];
        $email = $_POST['newemail'];
        $tele = $_POST['tele'];
        $newpassword = $_POST['newpassword'];
        $cpassword = $_POST['cpassword'];

        if ($newpassword == $cpassword) {
            $stmt = $database->prepare("SELECT * FROM webuser WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $error = "An account with this email already exists.";
            } else {
                $database->query("INSERT INTO patient (pemail, pname, ppassword, paddress, pnic, pdob, ptel) VALUES ('$email', '$name', '$newpassword', '$address', '$nic', '$dob', '$tele')");
                $database->query("INSERT INTO webuser VALUES ('$email', 'p')");

                $_SESSION["user"] = $email;
                $_SESSION["usertype"] = "p";
                $_SESSION["username"] = $fname;

                header('Location: student/index.php');
                exit;
            }
        } else {
            $error = "Password Confirmation Error! Please re-confirm the password.";
        }
    } else {
        $error = "";
    }
    ?>

    <div class="container">
        <p id="greeting" class="header-text"></p>
        <form action="" method="POST">
            <p class="sub-text">Create your account to continue.</p>

            <label for="newemail" class="form-label">Email:</label>
            <input type="email" name="newemail" class="input-text" placeholder="Email Address" required>

            <label for="tele" class="form-label">Mobile Number:</label>
            <input type="tel" name="tele" class="input-text" placeholder="ex: 01784212512" pattern="[0]{1}[0-9]{11}" required>

            <label for="newpassword" class="form-label">Create New Password:</label>
            <input type="password" name="newpassword" class="input-text" placeholder="New Password" required>

            <label for="cpassword" class="form-label">Confirm Password:</label>
            <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password" required>

            <?php if (!empty($error)) { ?>
                <p class="error-text"><?php echo $error; ?></p>
            <?php } ?>

            <div style="display: flex; justify-content: space-between;">
                <input type="reset" value="Reset" class="login-btn btn-primary-soft">
                <input type="submit" value="Sign Up" class="login-btn btn-primary">
            </div>

            <p class="sub-text" style="margin-top: 20px;">
                Already have an account? <a href="login.php" class="hover-link1">Login</a>
            </p>
        </form>
    </div>

    <script>
        // Dynamic Greeting and Background
        const hour = new Date().getHours();
        const greeting = document.getElementById('greeting');
        const body = document.body;

        if (hour >= 5 && hour < 12) {
            greeting.innerText = "Good Morning! 🌞";
            body.style.backgroundColor = "#FFDEE9";
        } else if (hour >= 12 && hour < 18) {
            greeting.innerText = "Good Afternoon! ☀️";
            body.style.backgroundColor = "#D4FC79";
        } else {
            greeting.innerText = "Good Evening! 🌙";
            body.style.backgroundColor = "#A1C4FD";
        }
    </script>
</body>

</html>