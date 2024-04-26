        <?php if(isset($product)): ?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <button data-dismiss="modal" aria-label="Close" class="close_modal"></button>
                    <form id="edit_product_modal_form" class="delete_product_form" action="<?= base_url('admins/edit_product_process') ?>" method="post" enctype="multipart/form-data">
                        <h2>Add a Product</h2>
                        <ul>    
                            <li>
                                <input type="text" name="name" value="<?= $product['name'] ?>" required>
                                <label>Products Name </label>
                            </li>
                            <li>   
                                <textarea name="description" required value="<?= $product['description'] ?>"></textarea>
                                <label>Description</label>
                            </li>
                            <li>
                                <label>Category</label>
                                <select class="selectpicker" name="category" value="<?= $product['category_id'] ?>">
                                    <option value="1">Vegetables</option>
                                    <option value="2">Fruits</option>
                                    <option value="3">Pork</option>
                                    <option value="4">Beef</option>
                                    <option value="5">Chicken</option>
                                </select>
                            </li>
                            <li>
                                <input type="number" name="price" value="<?= $product['price'] ?>" required>
                                <label>Price</label>
                            </li>
                            <li>
                                <input type="number" name="inventory" value="<?= $product['inventory'] ?>" required>
                                <label>Inventory</label>
                            </li>
                            <li>
                                <label>Upload Images (5 Max)</label>
                                <label>main</label>
                                <ul>
                                    <li>
                                        <input type="file" name="image0" accept="image/*" class="upload_image">
                                    </li>
                                    <li>
                                        <input type="file" name="image1" accept="image/*" class="upload_image">
                                    </li>
                                    <li>
                                        <input type="file" name="image2" accept="image/*" class="upload_image">
                                    </li>
                                    <li>
                                        <input type="file" name="image3" accept="image/*" class="upload_image">
                                    <li>
                                        <input type="file" name="image4" accept="image/*" class="upload_image">
                                    </li>
                                </ul>
                              
                            </li>
                        </ul>
                        <input type="hidden" name="action" value="edit_product">
                        <button type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
        <?php endif ?>