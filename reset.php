<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Load mail configuration
$mailConfig = require __DIR__ . '/mail_config.php';
?>

<html>
<head>
    <title>ONLINE EXAMINATION SYSTEM</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        @media screen and (max-width: 620px) {
            input { height: 6vw !important; }
            .seluser { display: grid; }
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
        button:hover { background-color:#fff !important; }
        .login {
            width: 40vw; background-color:#fff;
            padding: 2vw; font-weight: bolder;
            margin-top: 6vh; border-radius: 10px;
        }
    </style>
</head>
<body style="margin:0;height: 100%;outline: none;color: #042A38 !important;">
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
            <form method="POST">
                <h1>Reset the Password</h1>
                <div class="seluser">
                    <input type="radio" name="usertype" value="student" required> STUDENT
                    <input type="radio" name="usertype" value="staff" required> STAFF
                </div><br><br>

                <label>Email</label><br><br>
                <input type="email" name="email1" placeholder="Email" class="inp" required><br><br>

                <label>New Password</label><br><br>
                <input type="password" name="pass1" placeholder="******" class="inp" required><br><br>

                <label>Confirm Password</label><br><br>
                <input type="password" name="cpass1" placeholder="******" class="inp" required><br><br>

                <input name="submit" class="sub" type="submit" value="Get the Code"
                       style="height: 3vw;width: 15vw;font-family: 'Courier New', Courier, monospace;
                       font-weight: bolder;border-radius: 10px;border: 2px solid black;
                       background-color: lightblue;">
            </form>
            <br><a href="signup.php">SIGN UP</a> &nbsp;&nbsp; <a href="index.php">Cancel</a>
        </div>
    </center>
</div>
<?php require("footer.php");?>
</body>
</html>

<?php
if (isset($_POST['submit'])) {

    if (!empty($_POST['email1']) && !empty($_POST['pass1']) && !empty($_POST['cpass1'])) {
        require_once 'sql.php';
        $conn = mysqli_connect($host, $user, $ps, $project);

        if (!$conn) {
            echo "<script>alert('Database connection failed.');</script>";
            exit;
        }

        $type = mysqli_real_escape_string($conn, $_POST['usertype']);
        $username = mysqli_real_escape_string($conn, $_POST['email1']);
        $password = mysqli_real_escape_string($conn, $_POST['pass1']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpass1']);

        if ($password === $cpassword) {
            $enc_pass = crypt($password, 'mynewsalt');
            $sql = "SELECT * FROM $type WHERE mail='$username'";
            $res = mysqli_query($conn, $sql);

            if (mysqli_num_rows($res) > 0) {
                $row = mysqli_fetch_assoc($res);
                $dbname = $row['name'];
                $otp = mt_rand(100000, 999999);

                // Save info for verification
                $_SESSION["otp"] = $otp;
                $_SESSION["username"] = $username;
                $_SESSION["pw"] = $enc_pass;
                $_SESSION["type"] = $type;

                // Send OTP email
                $mail = new PHPMailer(true);
                try {
                    $mail->isSMTP();
                    $mail->Host = $mailConfig['host'];
                    $mail->Port = $mailConfig['port'];
                    $mail->SMTPAuth = $mailConfig['auth'];
                    if ($mailConfig['auth']) {
                        $mail->Username = $mailConfig['username'];
                        $mail->Password = $mailConfig['password'];
                    }
                    if ($mailConfig['secure']) {
                        $mail->SMTPSecure = $mailConfig['secure'];
                    }

                    $mail->setFrom($mailConfig['from_email'], $mailConfig['from_name']);
                    $mail->addAddress($username);
                    $mail->isHTML(true);
                    $mail->Subject = 'Reset your Online Examination System Password';
                    $mail->Body = "
                        <div style='font-family:Arial;text-align:center;'>
                            <h2>Hello $dbname,</h2>
                            <p>Your password reset code is:</p>
                            <h1 style='color:#042A38;'>$otp</h1>
                            <p>Please enter this code in the next step to confirm your password reset.</p>
                            <br><br>Thank you,<br>Online Examination System
                            <br><br>
                            <a href='mailto:osesvit2021@gmail.com' style='color:#ffffff;background-color:#042A38;padding:10px 20px;text-decoration:none;border-radius:5px;'>Contact Us</a>
                        </div>
                    ";

                    $mail->send();
                    header("Location: updatepw.php");
                    exit;

                } catch (Exception $e) {
                    echo "<script>alert('Mailer Error: {$mail->ErrorInfo}');</script>";
                }

            } else {
                echo "<script>alert('No user found with that email. Please sign up.');</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match.');</script>";
        }
    }
}
?>



