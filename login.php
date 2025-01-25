<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | MentorMeet</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            color: #e0e0e0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            transition: background-color 0.5s ease;
        }

        .container {
            max-width: 500px;
            padding: 30px;
            background: #1e1e2f;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .header-text {
            font-size: 32px;
            font-weight: bold;
            color: #64ffda;
            text-align: center;
            margin-bottom: 15px;
        }

        .greeting-text {
            font-size: 20px;
            color: #90caf9;
            text-align: center;
            margin-bottom: 10px;
        }

        .sub-text {
            font-size: 14px;
            color: #b0bec5;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-label {
            font-size: 14px;
            font-weight: bold;
            color: #81d4fa;
            display: block;
            margin-bottom: 5px;
        }

        .input-text {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #37474f;
            border-radius: 5px;
            font-size: 14px;
            background: #263238;
            color: #fff;
        }

        .login-btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            background-color: #64ffda;
            color: #121212;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #00e676;
        }

        .hover-link1 {
            color: #64ffda;
            text-decoration: none;
        }

        .hover-link1:hover {
            text-decoration: underline;
        }

        .error-text {
            color: #ff5252;
            text-align: center;
            font-size: 14px;
        }
    </style>
    <script>
        // Dynamically Set Greeting and Background Based on Time
        document.addEventListener("DOMContentLoaded", function() {
            const body = document.body;
            const greetingElement = document.getElementById('dynamic-greeting');
            const hour = new Date().getHours();

            let greetingMessage = "Welcome!";
            let backgroundColor = "#121212"; // Default (night)

            if (hour >= 5 && hour < 12) {
                greetingMessage = "Good Morning!";
                backgroundColor = "#FFFAF0"; // Light morning shade
            } else if (hour >= 12 && hour < 18) {
                greetingMessage = "Good Afternoon!";
                backgroundColor = "#FFE4B5"; // Warm afternoon shade
            } else if (hour >= 18 && hour < 22) {
                greetingMessage = "Good Evening!";
                backgroundColor = "#2C3E50"; // Evening blue shade
            }

            greetingElement.innerText = greetingMessage;
            body.style.backgroundColor = backgroundColor;
        });
    </script>
</head>

<body>
    <?php
    session_start();
    $_SESSION["user"] = "";
    $_SESSION["usertype"] = "";

    // Set the timezone
    date_default_timezone_set('Asia/Kolkata');
    $date = date('Y-m-d');
    $_SESSION["date"] = $date;

    // Include database connection
    include("connection.php");

    $error = "";

    if ($_POST) {
        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];

        $result = $database->query("SELECT * FROM webuser WHERE email='$email'");
        if ($result->num_rows == 1) {
            $utype = $result->fetch_assoc()['usertype'];
            if ($utype == 'p') {
                $checker = $database->query("SELECT * FROM patient WHERE pemail='$email' AND ppassword='$password'");
                if ($checker->num_rows == 1) {
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'p';
                    header('location: student/index.php');
                } else {
                    $error = "Invalid email or password.";
                }
            } elseif ($utype == 'a') {
                $checker = $database->query("SELECT * FROM admin WHERE aemail='$email' AND apassword='$password'");
                if ($checker->num_rows == 1) {
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'a';
                    header('location: admin/index.php');
                } else {
                    $error = "Invalid email or password.";
                }
            } elseif ($utype == 'd') {
                $checker = $database->query("SELECT * FROM doctor WHERE docemail='$email' AND docpassword='$password'");
                if ($checker->num_rows == 1) {
                    $_SESSION['user'] = $email;
                    $_SESSION['usertype'] = 'd';
                    header('location: faculty/index.php');
                } else {
                    $error = "Invalid email or password.";
                }
            }
        } else {
            $error = "No account found with this email.";
        }
    }
    ?>

    <div class="container">
        <form action="" method="POST">
            <p id="dynamic-greeting" class="greeting-text"></p>
            <p class="header-text">Login to MentorMeet</p>
            <p class="sub-text">Go-to platform for seamless mentorship.</p>

            <label for="useremail" class="form-label">Email:</label>
            <input type="email" name="useremail" class="input-text" placeholder="Enter your email" required>

            <label for="userpassword" class="form-label">Password:</label>
            <input type="password" name="userpassword" class="input-text" placeholder="Enter your password" required>

            <?php if (!empty($error)) { ?>
                <p class="error-text"><?php echo $error; ?></p>
            <?php } ?>

            <input type="submit" value="Login" class="login-btn">

            <p class="sub-text" style="margin-top: 20px;">
                Don't have an account? <a href="signup.php" class="hover-link1">Sign Up</a>
            </p>
        </form>
    </div>
</body>

</html>