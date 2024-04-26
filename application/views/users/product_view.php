<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="shortcut icon" href="<?= base_url('../assets/images/organic_shop_fav.ico" type="image/x-icon')?>">
    <script src="<?= base_url('../assets/js/vendor/jquery.min.js')?>"></script>
    <script src="<?= base_url('../assets/js/vendor/popper.min.js')?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('../assets/js/vendor/bootstrap-select.min.js')?>"></script>
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/vendor/bootstrap-select.min.css')?>">

    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/global.css')?>">
    <link rel="stylesheet" href="<?= base_url('../assets/css/custom/product_view.css')?>">
</head>

<script>
    $(document).ready(function() {
        $("#add_to_cart").click(function(){
            $("<span class='added_to_cart'>Added to cart successfully!</span>")
            .insertAfter(this)
            .fadeIn()
            .delay(1000)
            .fadeOut(function() {
                $(this).remove();
            });   
        });

        $(document).on('submit', '#add_to_cart_form', function(event) {
            var form = $(this);
            $.post(form.attr('action'), form.serialize());
            return false;
        });

        var product_price = <?= $product['price'] ?>;
    
        // Function to update total amount
        function update_total_amount(quantity) {
            var total_amount = product_price * quantity;
            $('.total_amount').text('₱ ' + total_amount.toFixed(2));
        }
        
        // Event handler for increase/decrease buttons
        $('.increase_decrease_quantity').click(function() {
            var control_value = parseInt($(this).data('quantity-ctrl'));
            var current_quantity = parseInt($('input[name="quantity"]').val());
            
            // Increase quantity
            if (control_value === 1) {
                current_quantity += 1;
            }
            // Decrease quantity (ensure quantity never goes below 1)
            else if (control_value === 0 && current_quantity > 1) {
                current_quantity -= 1;
            }
            
            // Update input value and total amount
            $('input[name="quantity"]').val(current_quantity);
            update_total_amount(current_quantity);
        });
        
        // Initial update of total amount
        update_total_amount(1);

    })
</script>
<body>
    <div class="wrapper">
        <aside>
            <a href="<?= base_url('/Products') ?>"><img src="<?= base_url('../assets/images/organic_shop_logo.svg')?>" alt="Organic Shop"></a>
        </aside>
        <section >
            <form action="<?= base_url('/Products/search') ?>" method="post" class="search_form">
                <input type="text" name="search" placeholder="Search Products">
            </form>
            <a class="show_cart" href="<?= base_url('Products/cart')?>">Cart</a>
            <a href="<?= base_url('/Products') ?>">Go Back</a>
    <?php if (!$this->session->flashdata('no_match')): ?>
            <ul>
                <li>
                    <img src="<?= base_url($product['image']) ?>" alt="<?= $product['name'] ?>">
                    <ul>
                        <li class="active"><button class="show_image"><img src="<?= base_url($product['image1']) ?>" alt="<?= $product['name'] ?>"></button></li>
                        <li><button class="show_image"><img src="<?= base_url($product['image2']) ?>" alt="<?= $product['name'] ?>"></button></li>
                        <li><button class="show_image"><img src="<?= base_url($product['image3']) ?>" alt="<?= $product['name'] ?>"></button></li>
                        <li><button class="show_image"><img src="<?= base_url($product['image4']) ?>" alt="<?= $product['name'] ?>"></button></li>
                    </ul>
                </li>
                <li>
                    <h2><?= $product['name'] ?></h2>
                    <ul class="rating">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <span><?= $product['sold'] ?> sold</span>
                    <span class="amount">₱ <?= $product['price'] ?></span>
                    <span id="product_buy_info">BUY PER KILO 🛒</span>
                    <p id="product_description"><?= $product['description'] ?></p>
                    <form action="<?= base_url('Products/add_to_cart_process')?>" method="post" id="add_to_cart_form">
                        <ul>
                            <li>
                                <label>Quantity</label>
                                <input type="text" min-value="1" max-value="<?= $product['inventory'] ?>" name="quantity" value="1">
                                <ul>
                                    <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="1"></button></li>
                                    <li><button type="button" class="increase_decrease_quantity" data-quantity-ctrl="0"></button></li>
                                </ul>
                            </li>
                            <li>
                                <label>Total Amount</label>
                                <span class="total_amount"> ₱ <?= $product['price']?></span>
                            </li>
                            <li><button type="submit" id="add_to_cart">Add to Cart</button></li>
                        </ul>
                        <input type="hidden" name="id" value="<?= $product['id']?>">
                    </form>
                </li>
            </ul>
            <section>
                <h3>Similar Items</h3>
                <ul>
      <?php if($similar_products != NULL): ?>
        <?php foreach($similar_products as $similar_product): ?>
                    <li>
                        <a href="<?= base_url("/Products/item/".$similar_product['id']) ?>">
                            <img src="<?= base_url($similar_product['image']) ?>" alt="<?= $similar_product['name'] ?>">
                            <h3><?= $similar_product['name'] ?></h3>
                            <ul class="rating">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <span>36 Rating</span>
                            <span class="price">₱ <?= $similar_product['price'] ?></span>
                        </a>
                    </li>
          <?php endforeach; ?>
      <?php endif; ?>

                </ul>
            </section>
    <?php else: ?>
            <h4 class="no_matched_message">No matched items found</h4>
    <?php endif; ?>
        </section>
    </div>
</body>
</html>