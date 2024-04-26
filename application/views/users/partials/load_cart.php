<script>
   $(document).ready(function() {
        function calculate_total_price() {
            var total_price = 0;
            $('.total_item_price').each(function() {
                total_price += parseFloat($(this).text().replace('₱', ''));
            });
            $('#total_price span').text('₱ ' + total_price.toFixed(2));
            return total_price;
         }

        // Calculate total amount in checkout
        function calculate_total_amount() {
            var total_price = calculate_total_price();
            var shipping_fee = 50; // Assuming fixed shipping fee
            var total_amount = total_price + shipping_fee;
            $('#total_amount_checkout span').text('₱ ' + total_amount.toFixed(2));
        }

        // Initial calculation
        calculate_total_amount();

        // Remove item functionality
        $('.remove_item').click(function() {
            var form = $(this).closest('form');
            // Remove form or mark it for removal
            form.remove();
            calculate_total_amount();
        });
        ///////////////
        
    });
</script>


<?php if($carts != NULL): ?>
    <?php foreach($carts as $cart): ?>
            <form id="form<?= $cart['id'] ?>" action="<?= base_url('Products/delete_cart_process')?>" class="cancel_checkout_form" method="POST">
                <input type="hidden" name="id" value="<?= $cart['id'] ?>">
                <img src="<?= base_url($cart['image']) ?>" alt="<?= $cart['name']?> ">
                <h3><?= $cart['name']?></h3>
                <span class="price">₱ <?= $cart['price']?></span>
                <ul>
                    <li>
                        <label>Qty/Kilogram</label>
                        <span class="total_quantity"> <?= $cart['quantity'] ?></span>
                    </li>
                    <li>
                        <label>Total Amount</label>
                        <span class="total_item_price">₱ <?= $cart['quantity'] * $cart['price'] ?></span>
                    </li>
                    <li>
                        <input type="submit" value="cancel">
                    </li>
                </ul>
            </form>
    <?php endforeach; ?>
          <?php endif; ?>