                <?php if(isset($price)):?>
                    <h3>Billing Information</h3>
                    <ul>
                        <li>
                            <p class="info">Name:</p>
                            <p class="info_name"> <?= $billing_info['first_name']?> </p>
                        </li>
                        <li>
                            <p class="info">First Address:</p>
                            <p class="info_name:"><?= $billing_info['address1']?></p>
                        </li>
                        <li>
                            <p class="info">Second Address:</p>
                            <p class="info_name:"><?= $billing_info['address2']?></p>
                        </li>
                        <li>
                            <p class="info">City:</p>
                            <p class="info_name:"><?= $billing_info['city']?></p>
                        </li>
                        <li>
                            <p class="info">State:</p>
                            <p class="info_name:"><?= $billing_info['state']?></p>
                        </li>
                        <li>
                            <p class="info">Zip:</p>
                            <p class="info_name:"><?= $billing_info['zip']?></p>
                        </li>
                    </ul>
                    <h3 class="shipping">Shipping Information</h3>
                    <ul>
                        <li>
                            <p class="info">Name:</p>
                            <p class="info_name"> <?= $shipping_info['first_name']?> </p>
                        </li>
                        <li>
                            <p class="info">First Address:</p>
                            <p class="info_name:"><?= $shipping_info['address1']?></p>
                        </li>
                        <li>
                            <p class="info">Second Address:</p>
                            <p class="info_name:"><?= $shipping_info['address2']?></p>
                        </li>
                        <li>
                            <p class="info">City:</p>
                            <p class="info_name:"><?= $shipping_info['city']?></p>
                        </li>
                        <li>
                            <p class="info">State:</p>
                            <p class="info_name:"><?= $shipping_info['state']?></p>
                        </li>
                        <li>
                            <p class="info">Zip:</p>
                            <p class="info_name:"><?= $shipping_info['zip']?></p>
                        </li>
                    </ul>
                    <h3>Order Summary</h3>
                    <h4 id="total_price">Items <span>₱ <?= $price ?></span></h4>
                    <h4 id="shipping">Shipping Fee <span>₱ 50.00</span></h4>
                    <h4 id="total_amount_checkout" class="total_amount">Total Amount <span>₱ <?= $price + 50 ?></span></h4>
                    <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#card_details_modal">Proceed to Checkout</button>
                <?php endif; ?>