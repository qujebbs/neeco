<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">

<!-- SweetAlert 2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.all.min.js"></script>
    <title>Verification</title>
    <style>
        body {
            font-family: 'Raleway', sans-serif;
            background-color: #e1f2e1; /* Light green background */
        }

        .navbar {
            background-color: #4caf50; /* Green navbar */
        }

        .navbar-brand {
            color: #fff;
            font-weight: bold;
        }

        .navbar-light .navbar-toggler-icon {
            background-color: #fff;
        }

        .login-form {
            margin-top: 50px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #4caf50; /* Green card header */
            color: #fff;
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4caf50; 
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .col-md-6.offset-md-4 a {
            color: #4caf50; /* Green link color */
            text-decoration: none;
        }

        .col-md-6.offset-md-4 a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="#">Verification Account</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <main class="login-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Verification Account</div>
                        <div class="card-body">
                            <form action="#" method="POST">
                                <div class="form-group row">
                                <div class="col-md-12 text-center">
                                        <p class="text-info">Reminder! We have sent a one-time password to your email check it before expiration.</p>
                                    </div>
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">OTP
                                        Code</label>
                                    <div class="col-md-6">
                                        <input type="text" id="otp" class="form-control" name="otp_code" 
                                            autofocus>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                <input type="submit" value="Verify" name="verify">
                                <input type="submit" value="Resend Code" name="resend_code">
                                </div>
                                

                                <div class="col-md-6 offset-md-4">
                                    <a href="register.php">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
<?php
include 'src/init.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

function generateVerificationCode() {
    return mt_rand(100000, 999999);
}

function sendVerificationEmail($to, $verificationCode) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ganancialryan12@gmail.com';
        $mail->Password = 'ibamkzpzdottccsj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('ganancialryan12@gmail.com', 'Neeco2Area1OfficialSystem');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = 'Verification Code';
        $mail->Body = 'Your new verification code is: ' . $verificationCode;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if (isset($_POST["verify"])) {
    $verificationCode = $_SESSION['verification_code'];
    $email = $_SESSION['email'];
    $consumerId = $_SESSION['consumer_id']; 
    $enteredVerificationCode = isset($_POST['otp_code']) ? $_POST['otp_code'] : '';

    if (!ctype_digit($enteredVerificationCode)) {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid OTP code',
            });
        </script>
        <?php
    } elseif ($enteredVerificationCode != $verificationCode) {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid OTP code',
            });
        </script>
        <?php
    } else {
        
        $user = mysqli_query($con, "SELECT * FROM consumer_tbl WHERE email = '$email'");
        
        if ($user) {
            $userData = mysqli_fetch_assoc($user);
            
            if (!$userData['is_verified']) {
                mysqli_query($con, "UPDATE user_tbl SET is_verified = 1 WHERE consumer_id = '$consumerId'");
                ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Account Verified',
                        text: 'Wait for the verification of admin Thank u.',
                    }).then(function () {
                        window.location.replace("login.php");
                    });
                </script>
                <?php
            } else {
                ?>
                <script>
                    Swal.fire({
                        icon: 'info',
                        title: 'Account Already Verified',
                        text: 'You may proceed to sign in.',
                    }).then(function () {
                        window.location.replace("login.php");
                    });
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'User not found',
                });
            </script>
            <?php
        }
    }
}

if (isset($_POST["resend_code"])) {
    $email = $_SESSION['email'];
    $consumerId = $_SESSION['consumer_id']; 

    $newVerificationCode = generateVerificationCode();
    $_SESSION['verification_code'] = $newVerificationCode;

    mysqli_query($con, "UPDATE user_tbl SET verification_code = '$newVerificationCode' WHERE consumer_id = '$consumerId'");

    $emailSent = sendVerificationEmail($email, $newVerificationCode);

    if ($emailSent) {
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'New verification code sent',
            });
        </script>
        <?php
    } else {
        ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Failed to send new verification code',
            });
        </script>
        <?php
    }
}
?>