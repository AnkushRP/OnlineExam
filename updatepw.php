<?php
session_start();
require_once 'sql.php';

// Check if OTP session exists
if (!isset($_SESSION['otp'], $_SESSION['username'], $_SESSION['pw'], $_SESSION['type'])) {
    // If someone directly opens this page without going through reset.php
    header("Location: reset.php");
    exit;
}

$sysotp = $_SESSION['otp'];
$dbmail = $_SESSION['username'];
$password = $_SESSION['pw'];
$type = $_SESSION['type'];
?>

<html>
<head>
    <title>Verify OTP - ONLINE EXAMINATION SYSTEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @media screen and (max-width: 620px) {
            input { height: 6vw !important; }
            .sub { width: 20vw !important; }
        }
        .inp {
            width: 30vw; height: 3vw;
            border-radius: 10px;
            border: 2px solid black;
            padding-left: 2vw;
            font-weight: bolder;
            outline: none;
        }
        label { font-weight: bolder; }
        button:hover { background-color: #042A38 !important; }
        .login {
            width: 40vw; background-color:#fff;
            padding: 2vw; font-weight: bolder;
            margin-top: 6vh; border-radius: 10px;
        }
    </style>
</head>
<body style="margin:0;height: 100%;outline: none;">
<div class="bg" style="font-weight: bolder;background-image: url(./images/Ankush.png);
background-repeat: no-repeat;padding: 0;margin: 0;background-size: cover;
font-family: 'Courier New', Courier, monospace;opacity: 0.9;height: auto;padding-bottom: 5vw;">
    <center>
        <h1 style="color:#042A38;text-transform: uppercase;width: auto;background:#fff;padding: 1vw;">
            ONLINE Examination System
        </h1>
    </center>

    <center>
        <div class="login">
            <form method="post">
                <label>Enter the OTP sent to your email</label><br><br>
                <input type="number" name="otp1" placeholder="Enter OTP" class="inp" required><br><br>
                <input type="submit" name="submit1" value="Verify & Reset Password" class="sub"
                       style="height: 3vw;width: 15vw;font-family: 'Courier New', Courier, monospace;
                       font-weight: bolder;border-radius: 10px;border: 2px solid black;
                       background-color: rgb(77, 77, 236);"><br><br>
            </form>
            <a href="reset.php">CANCEL</a>
        </div>
    </center>
</div>
<?php require("footer.php");?>
</body>
</html>

<?php
if (isset($_POST['submit1'])) {
    if (!empty($_POST['otp1'])) {
        $user_otp = $_POST['otp1'];

        if ($user_otp == $sysotp) {
            // OTP matched → update password in DB
            $conn = mysqli_connect($host, $user, $ps, $project);
            if (!$conn) {
                echo "<script>alert('Database connection failed.');</script>";
                exit;
            }

            $sql_update = "UPDATE $type SET pw='$password' WHERE mail='$dbmail'";
            if (mysqli_query($conn, $sql_update)) {
                // Clear session after successful reset
                session_unset();
                session_destroy();

                // Redirect to login page
                header("Location: index.php");
                exit;
            } else {
                echo "<script>alert('Database error: Could not update password.');</script>";
            }

        } else {
            echo "<script>alert('Incorrect OTP. Please check your email.');</script>";
        }
    } else {
        echo "<script>alert('Please enter the OTP.');</script>";
    }
}
?>

