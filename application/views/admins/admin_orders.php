<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <script src="../assets/js/vendor/jquery.min.js"></script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap-select.min.css">

    <link rel="stylesheet" href="../assets/css/custom/admin_global.css">
    <script src="../assets/js/global/admin_orders.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/alfrcr/paginathing/dist/paginathing.min.js"></script>
</head>
<script>
    $(document).ready(function() {
        function paginathing() {
            $("tbody").paginathing({
                perPage: 5,
                containerClass: "panel-footer",
                limitPagination: false,
                prevNext: true,
                firstLast: true,
                prevText: '&laquo;',
                nextText: '&raquo;',
            });
        }

        function remove_pagination() {
            $('.panel-footer').remove();
        }

        $('.profile_dropdown').on('click', function() {
            let newTop = $(this).offset().top + $(this).outerHeight();
            let newLeft = $(this).offset().left;
            
            $('.admin_dropdown').css({
                'top': newTop + 'px',
                'left': newLeft + 'px'
            });
        });

        $.get('/Admins/orders_html', function(result) {
            $('tbody').html(result);
            paginathing();
        }); 

        $(document).on('change', '.select_status', function(event) {
            var form = $(this).closest('.update_status_form');
            $.post(form.attr('action'), form.serialize(), function(result) {
                $('tbody').html(result);
                remove_pagination();
                paginathing();
            });
            return false;
        });

        $(document).on('submit', '.status_form', function(event) {
            var form = $(this);

            $.post(form.attr('action'), form.serialize(), function(result) {
                $('tbody').html(result);
                remove_pagination();
                paginathing();
            });
            return false;
        });

        $(document).on('submit', '.search_form', function(event) {
            var form = $(this);

            $.post(form.attr('action'), form.serialize(), function(result) {
                $('tbody').html(result);
                remove_pagination();
                paginathing();
            });
            return false;
        });

    });
</script>
<body>
    <div class="wrapper">
        <header>
            <h1>Let’s provide fresh items for everyone.</h1>
            <h2>Orders</h2>
            <div>
                <a class="switch" href="<?= base_url('/products') ?>">Switch to Shop View</a>
                <button class="profile">
                    <img src="../assets/images/profile.png" alt="#">
                </button>
            </div>
            <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle profile_dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu admin_dropdown" aria-labelledby="dropdownMenuLink">
                    <form class= "log_out" action="<?= base_url('Admins/log_out_process') ?>" method= "POST">
                        <input type="hidden" name="action" value="log_out">
                        <input type="submit" value="log out" class="dropdown-item">
                    </form>
                </div>
            </div>
        </header>
        <aside>
            <a href="#"><img src="../assets/images/organi_shop_logo_dark.svg" alt="Organic Shop"></a>
            <ul>
                <li class="active"><a href="#">Orders</a></li>
                <li><a href="/admins/products">Products</a></li>
            </ul>
        </aside>
        <section>
            <form action="/Admins/search_orders" method="post" class="search_form">
                <input type="text" name="search" placeholder="Search Orders">
            </form>
            <section class="status_section">
                <h3>Categories</h3>
                <form action="<?= base_url('Admins/show_status')?>" method="post" class="status_form active">
                    <input type="hidden" name="status" value="all">
                    <input type="submit" value="All">
                </form>
                <form action="<?= base_url('Admins/show_status')?>" method="post" class="status_form">
                    <input type="hidden" name="status" value="pending">
                    <input type="submit" value="Pending"> 
                </form>
                <form action="<?= base_url('Admins/show_status')?>" method="post" class="status_form">
                    <input type="hidden" name="status" value="on-process">
                    <input type="submit" value="On-process"> 
                </form>
                <form action="<?= base_url('Admins/show_status')?>" method="post" class="status_form">
                    <input type="hidden" name="status" value="shipped">
                    <input type="submit" value="Shipped">  
                </form>
                <form action="<?= base_url('Admins/show_status')?>" method="post" class="status_form">
                    <input type="hidden" name="status" value="delivered">
                    <input type="submit" value="Delivered">  
                </form>
            </section>
            <div>
                <h3>All Orders</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID #</th>
                            <th>Order Date</th>
                            <th>Receiver</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>