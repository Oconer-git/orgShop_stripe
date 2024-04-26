<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <link rel="shortcut icon" href="<?= base_url('../assets/images/organic_shop_fav.ico" type="image/x-icon')?>">
    <script src="../assets/js/vendor/jquery.min.js"></script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap-select.min.css">
    <link rel="stylesheet" href="../assets/css/custom/global.css">
    <link rel="stylesheet" href="../assets/css/custom/cart.css">
    <script src="../assets/js/global/cart.js"></script>
    <!--Stripe -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <!-- jquery alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.4/jquery-confirm.min.js"></script>
    

</head>

<script>
    $(document).ready(function() {
        $.get('/Products/get_cart',function(result) {
            $('#cart_load').html(result);
        }); 

        $.get('/Products/shipping_info_html',function(result){
            $('.checkout_form').html(result);
        });

        $(document).on('submit','.cancel_checkout_form',
            function() {
                var form = $(this);
                $.post(form.attr('action'),form.serialize(),function(result) {
                    $('#cart_load').html(result);
                });
                return false;
            }
        );
        
        var $payment_form = $(".payment_form_modal");
        $('form.payment_form_modal').bind('submit', function(e) {
            var $payment_form = $(".payment_form_modal"),
            input_selector = ['input[type=email]', 'input[type=password]',
                            'input[type=text]', 'input[type=file]',
                            'textarea'].join(', '),
            $inputs = $payment_form.find('.required').find(input_selector),
            valid = true;    
        
            if (!$payment_form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($payment_form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripe_response_handler);
            }
        });
        
        function stripe_response_handler(status, response) {
            if (response.error) {
                $.alert({
                    title: 'Wrong credits Information',
                    content: 'Please add your correct credit information',
                });
            } 
            else {
                var token = response['id'];
                $payment_form.find('input[type=text]').empty();
                $payment_form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $payment_form.get(0).submit();
                return false;
            }
        }
    });

</script>
<body>
    <div class="wrapper">
        <?php if($user_info == NULL): ?>
        <header>
            <h1>Let’s order fresh items for you.</h1>
            <div>
                <a class="signup_btn" href="/Shops/sign_up">Signup</a>
                <a class="login_btn" href="/Shops">Login</a>
            </div>
        </header>
        <?php endif; ?>
        <aside>
            <a href="/Products"><img src="../assets/images/organic_shop_logo.svg" alt="Organic Shop"></a>
            <ul>
                <li class="active"><a href="<?= base_url('Products/settings') ?>"></a></li>
            </ul> 
        </aside>
        <section >
            <form action="<?= base_url('/Products/search')?>" method="post" class="search_form">
                <input type="text" name="search" placeholder="Search Products">
            </form>
            <button class="show_cart">Cart</button>
            <section>
                <?php if ($this->session->flashdata('success')): ?>
                <section id="success">
                    <p>Success! Thank you for ordering</p>
                </section>
                <?php endif; ?>
                <section class="cart_items_form">
                    <ul id="cart_load">
                        
                    </ul>
                </section>
                <section class="checkout_form">
                  
                </section>
            </section>
        </section>
        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#card_details_modal">
            Launch demo modal
        </button> -->
        <div class="modal fade form_modal" id="card_details_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button data-dismiss="modal" aria-label="Close" class="close_modal"></button>
                    <div class="panel-body">
                        <form role="form" action="/stripe" method="post" class="payment_form_modal" data-cc-on-file="false" data-stripe-publishable-key="<?php echo $this->config->item('stripe_key') ?>" id="payment-form">
                            <div class='w-75 p-3 form-group card required'>
                                <label class='control-label'>Name on Card</label> 
                                <input class='form-control' size='4' type='text'>
                            </div>
     
                            <div class='w-75 p-3 form-group card required'>
                                <label class='control-label'>Card Number</label> 
                                <input autocomplete='off' class='form-control card-number' size='5' type='text'>
                            </div>
      
                            <div class='h-75 d-inline-block form-group cvc required'>
                                <label class='control-label'>CVC</label> 
                                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
                            </div>

                            <div class='h-75 d-inline-block form-group expiration required'>
                                <label class='control-label'>Expiration Month</label> 
                                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
                            </div>

                            <div class='h-75 d-inline-block form-group expiration required'>
                                <label class='control-label'>Expiration Year</label> 
                                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <h4 id="total_amount_checkout" class="total_amount">Total Amount <span>₱ 0.00</span></h4>
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="popover_overlay"></div>
       
    </div>
</body>
</html>