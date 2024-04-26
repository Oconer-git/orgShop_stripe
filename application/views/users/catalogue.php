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
    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/product_dashboard.css') ?>">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/alfrcr/paginathing/dist/paginathing.min.js"></script>
</head>

<script>
    $(document).ready(function() {
        function paginathing() {
            $("ul.products_list").paginathing({
                perPage: 10,
                containerClass: "panel-footer",
                limitPagination: false,
                ulClass: 'pagination flex-wrap',
                prevNext: true,
                firstLast: true,
                prevText: '&laquo;',
                nextText: '&raquo;',
            });
        }

        function remove_pagination() {
            $('.panel-footer').remove();
        }

        $.get('/Products/products_html',function(result) {
            $('ul.products_list').html(result);
            paginathing();
        }); 
        
        $(document).on('submit', 'form', function(event) {
            var form = $(this);
            $.post(form.attr('action'), form.serialize(), function(result) {
                $('ul.products_list').html(result);
                remove_pagination();
                paginathing();
            });
            return false;
        });
    })
</script>
<body>
    <div class="wrapper">
        <div id="ex1" class="modal">
            <p>Thanks for clicking. That felt good.</p>
            <a href="#" rel="modal:close">Close</a>
        </div>
<?php if($user_info == NULL): ?>
        <header>
            <h1>Let’s order fresh items for you.</h1>
            <div>
                <a class="signup_btn" href="/Shops/sign_up">Signup</a>
                <a class="login_btn" href="/Shops">Login</a>
            </div>
        </header>
<?php else: ?>
        <header>
            <h1>Let’s order fresh items for everyone.</h1>
            <?php if($user_info['is_admin'] == TRUE): ?>
            <div>
                <a class="signup_btn" href="/Admins">Admin</a>
            </div>
            <?php endif; ?>
        </header>
<?php endif; ?>
        <aside>
            <a href="products_dashboard.html"><img src="<?= base_url('../assets/images/organic_shop_logo.svg')?>" alt="Organic Shop"></a>
            <ul>
                <li><a href="<?= base_url('Products/settings')?>"></a></li>
            </ul> 
        </aside>
        <section id="main_section_catalogue">
            <form action="<?= base_url('Products/search_product')?>" method="post" class="search_form">
                <input type="text" name="search" placeholder="Search Products">
            </form>
            <a class="show_cart" href="<?= base_url('Products/cart')?>">Cart</a>
            <fieldset id="category_forms">
                <h3>Categories</h3>
                <form action="<?= base_url('Products/category_process')?>" method="post" class="category_form active">
                    <input type="hidden" name="category_id" value="0">
                    <input type="submit" value="All">
                </form>
                <form action="<?= base_url('Products/category_process')?>" method="post" class="category_form">
                    <input type="hidden" name="category_id" value="1">
                    <input type="submit" value="Vegetables"> 
                </form>
                <form action="<?= base_url('Products/category_process')?>" method="post" class="category_form">
                    <input type="hidden" name="category_id" value="2">
                    <input type="submit" value="Fruits"> 
                </form>
                <form action="<?= base_url('Products/category_process')?>" method="post" class="category_form">
                    <input type="hidden" name="category_id" value="3">
                    <input type="submit" value="Pork">  
                </form>
                <form action="<?= base_url('Products/category_process')?>" method="post" class="category_form">
                    <input type="hidden" name="category_id" value="4">
                    <input type="submit" value="Beef">  
                </form>
                <form action="<?= base_url('Products/category_process')?>" method="post" class="category_form">
                    <input type="hidden" name="category_id" value="5">
                    <input type="submit" value="Chicken">  
                </form>
            </fieldset>
            <div>
                <ul>
                    <img class="ads_foods" src="/assets/images/ads/Dark Violet Modern Burger Sales Instagram Post.png" alt="ads">
                    <img id="ads_foods_presentation" src="/assets/images/ads/Food Presentation.jpg" alt="foods ads">
                    <img class="ads_foods" src="/assets/images/ads/food ads instagram post.png" alt="foods ads">
                </ul>
                <h3>All Products</h3>
                <ul class="products_list"></ul>
            </div>
        </section>
    </div>
</body>
</html>