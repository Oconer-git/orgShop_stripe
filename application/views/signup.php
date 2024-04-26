
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organic Shop: Let’s order fresh items for you.</title>

    <link rel="shortcut icon" href="assets/images/organic_shop_favicon.ico" type="image/x-icon">

    <script src ="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="../assets/js/vendor/jquery.min.js"></script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap-select.min.css">

    <script src="../assets/js/global/global.js"></script>
    <link rel="stylesheet" href="../assets/css/custom/global.css">
    <link rel="stylesheet" href="../assets/css/custom/signup.css">
</head>
<script>
    $(document).ready(function() {
      
    });
</script>
<body>
    <div class="wrapper">
        <a href="/dashboard"><img src="../assets/images/organic_shop_logo_large.svg" alt="Organic Shop"></a>
<?php if ($this->session->flashdata('validation_errors')): ?>
        <div id="error">
            <?= $this->session->flashdata('validation_errors') ?>
        </div>
<?php endif; ?>
        <form id="signup_form" action="<?= base_url('Shops/sign_up_process')?>" method="post">
            <h2>Signup to order.</h2>
            <a href="/Shops">Already a member? Login here.</a>
            <ul>
                <li>
                    <input type="text" name="first_name">
                    <label>First Name</label>
                </li>
                <li>
                    <input type="text" name="last_name">
                    <label>Last Name</label>
                </li>
                <li>
                    <input type="email" name="email">
                    <label>Email</label>
                </li>
                <li>
                    <input type="text" name="contact_number">
                    <label>Contact Number</label>
                </li>
                <li>
                    <input type="password" name="password">
                    <label>Password</label>
                </li>
                <li>
                    <input type="password" name="confirm_password">
                    <label>Confirm Password</label>
                </li>
            </ul>
            <input class="submit_sign_up" type="submit" value="submit">
            <input type="hidden" name="action" value="sign_up">
        </form>
    </div>
</body>
</html>