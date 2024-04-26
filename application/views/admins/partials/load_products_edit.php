                <?php if($products):
                    foreach($products as $product): ?>
                        <tr>
                            <td>
                                <span>
                                    <img src="<?=$product['image']?>" alt="Item <?= $product['name'] ?>">  
                                </span>
                            </td>
                            <td><span> <?= $product['name']." #".$product['id']?> </span></td>
                            <td><span>₱ <?= $product['price'] ?></span></td>
                            <td><span><?= $product['category'] ?></span></td>
                            <td><span><?= $product['inventory'] ?></span></td>
                            <td><span><span><?= $product['sold'] ?></span></td>
                            <td>
                                <span>
                                    <button class="edit_product" value="<?= $product['id']?>">Edit</button>
                                    <button class="delete_product">X</button>
                                </span>
                                <form class="delete_product_form product_delete" action="/Admins/delete_product_process" method="post">
                                    <p>Are you sure you want to remove this item?</p>
                                    <button type="button" class="cancel_remove">Cancel</button>
                                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                    <button type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                <?php   
                    endforeach; ?>
                <?php else: ?>
                    No products available
                <?php endif; ?>
              