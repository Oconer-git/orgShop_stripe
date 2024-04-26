                <label class="settings_name">Billing</label> 
                <fieldset class="name">
                    <label> First name </label>
                    <input type="text" placeholder="First name" name="billing_first_name" value="<?= $billing_info['first_name'] ?>">
                </fieldset>
                    
                <fieldset class="name">
                    <label> Last name </label>
                    <input type="text" placeholder="Last name" name="billing_last_name" value="<?= $billing_info['last_name'] ?>">
                </fieldset>

                <fieldset class="address">
                    <label> Address1 </label>
                    <input type="text" name="billing_address1" value="<?= $billing_info['address1'] ?>" placeholder="Street Address, Apt/Unit Number, City/Town, State/Province, [Postal Code] [Country]">
                </fieldset>

                <fieldset class="address">
                    <label> Address2 </label>
                    <input type="text" name="billing_address2" value="<?= $billing_info['address2'] ?>" placeholder="Street Address, Apt/Unit Number, City/Town, State/Province, [Postal Code] [Country]">
                </fieldset>
                    
                <fieldset class="address_additional">
                    <label> City </label>
                    <input type="text" name="billing_city" value="<?= $billing_info['city'] ?>" placeholder="Los Angeles">
                </fieldset>
                    
                <fieldset class="address_additional">
                    <label> State </label>
                    <input type="text" name="billing_state" value="<?= $billing_info['state'] ?>" placeholder="California">
                </fieldset>

                <fieldset class="address_additional">
                    <label> Zip </label>
                    <input type="text" name="billing_zip" value="<?= $billing_info['zip'] ?>" placeholder="90001">
                </fieldset>
                    
                <!-- Shipping -->
                <label class="settings_name shipping">Shipping</label>
                <fieldset class="name">
                    <label> First name </label>
                    <input type="text" name="shipping_first_name" value="<?= $shipping_info['first_name'] ?>" placeholder="First name">
                </fieldset>
                    
                <fieldset class="name">
                    <label> Last name </label>
                    <input type="text" name="shipping_last_name" placeholder="Last name" value="<?= $shipping_info['last_name'] ?>">
                </fieldset>

                <fieldset class="address">
                    <label> Address1 </label>
                    <input type="text" name="shipping_address1" value="<?= $shipping_info['address1'] ?>" placeholder="Street Address, Apt/Unit Number, City/Town, State/Province, [Postal Code] [Country]">
                </fieldset>

                <fieldset class="address">
                    <label> Address2 </label>
                    <input type="text" name="shipping_address2" value="<?= $shipping_info['address2'] ?>" placeholder="Street Address, Apt/Unit Number, City/Town, State/Province, [Postal Code] [Country]">
                </fieldset>
                    
                <fieldset class="address_additional">
                    <label> City </label>
                    <input type="text" name="shipping_city" value="<?= $shipping_info['city'] ?>" placeholder="Los Angeles">
                </fieldset>
                    
                <fieldset class="address_additional">
                    <label> State </label>
                    <input type="text" name="shipping_state" value="<?= $shipping_info['state'] ?>" placeholder="California">
                </fieldset>

                <fieldset class="address_additional">
                    <label> Zip </label>
                    <input type="text" name="shipping_zip" value="<?= $shipping_info['zip'] ?>" placeholder="90001">
                </fieldset>
                <input type="submit" value="save">
