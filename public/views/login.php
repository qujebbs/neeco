<?php
include __DIR__ . '/../views/fragments/header.php';
?>

<!doctype html>
<html lang="en">

<head>
    <script language="javascript" type="text/javascript">
        window.history.forward();
    </script>
    <title>neeco2area1.com</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/stylesl.css">

    <link href="public/assets/img/favicon.png" rel="icon">
    <link href="public/assets/img/neeco.png" rel="apple-touch-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <link href="public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="public/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="public/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="public/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="public/assets/css/main.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center"></div>
            <div class="row justify-content-right">
                <div class="col-md-6 text-center mb-5">
                    <br> <br> <br> <br> <br> <br> <br><br><br>
                    <h2 class="heading-section">Login to Your Account</h2>
                    <!-- <p class="text-center small">Step 1. Enter your Account Number (e.g. 01-1234-1234 with DASH)</p>
                    <p class="text-center small">Step 2. Enter Account Password (Account Number without DASH e.g.
                        0112341234)</p>
                    <p class="text-center small">Step 3. Click Login</p> -->
                </div>
                <div class="col-md-7 col-lg-5">
                    <div class="wrap" style="background-color: #036029;">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4" style="color: white;">Sign In</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="https://www.facebook.com/NEECO2AREA1OFFICIAL" class="social-icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-facebook"></span>
                                        </a>
                                        <a href="https://www.facebook.com/NEECO2AREA1OFFICIAL" class="social-icon d-flex align-items-center justify-content-center">
                                            <span class="fa fa-twitter"></span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                            <form action="/neeco2/login" method="POST" class="signin-form">
                                <div class="form-group mt-3">
                                    <input type="text" class="form-control" name="username" required>
                                    <label class="form-control-placeholder" for="username">Account Number</label>
                                </div>
                                <div class="form-group">
                                    <input id="password-field" type="password" class="form-control" name="password" required>
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"
                                        style="cursor: pointer; position: absolute; right: 15px; top: 50%; transform: translateY(-50%);">
                                    </span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="login_btn"
                                        class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <label class="checkbox-wrap checkbox-primary mb-0" style="color: white;">
                                            Remember Me
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="/neeco2/forgot-password" style="color: white;">Forgot Password</a>
                                    </div>
                                </div>
                            </form>
                            <p class="text-center" style="color: white;">Not a member? <a data-toggle="tab"
                                    href="/neeco2/register" style="color: #22ab5c;">Sign Up</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include __DIR__ . '/../views/fragments/footer.php'; ?>

    <?php if (isset($_GET['error'])): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: "<?php echo addslashes($_GET['error']); ?>",
                confirmButtonColor: '#6a0dad',
            });
        </script>
    <?php endif; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.querySelector('.toggle-password');
            const passwordField = document.querySelector('#password-field');

            if (togglePassword && passwordField) {
                togglePassword.addEventListener('click', function () {
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);
                    this.classList.toggle('fa-eye');
                    this.classList.toggle('fa-eye-slash');
                });
            }
        });
    </script>

</body>
</html>
