<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link rel="shortcut icon" href="<?= base_url('../assets/images/organic_shop_fav.ico" type="image/x-icon')?>">

    <script src="<?= base_url('../assets/js/vendor/jquery.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/popper.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap-select.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap-select.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/settings.css') ?>">
    <!-- jquery alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
</head>

<script>
    $(document).ready(function() {
        $.get('/Products/settings_html',function(result){
            $('#settings').html(result);
        });
    })
</script>
<body>
    <div class="wrapper">
        <header>
            <h1>Settings</h1>
        </header>
        <aside>
            <a href="<?= base_url('/Products')?>"><img src="<?= base_url('../assets/images/organic_shop_logo.svg')?>" alt="Organic Shop"></a>
            <ul>
                <li class="active"><a href="Products/settings"></a></li>
            </ul> 

        </aside>
        <section id="settings_wrapper">
            <form id="settings" action="<?= base_url('Products/submit_settings')?>" method="POST">
              
            </form>
        <?php if ($this->session->flashdata('validation_errors')): ?>
            <section class="errors">
                <?= $this->session->flashdata('validation_errors') ?>
            </section>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <section class="success">
                <p>Success! You can order now</p>
            </section>
        <?php endif; ?>
        </section>
      
    </div>
</body>
</html>