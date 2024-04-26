        <?php if(isset($products)):?>
            <?php foreach($products as $product): ?>
                    <li>
                        hello
                        <a href="<?= base_url('/Products/item/'.$product['id']) ?>">
                            <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                            <h3><?= $product['name'] ?></h3>
                            <ul class="rating">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <span><?= $product['sold'] ?> sold</span>
                            <span class="price">₱ <?= $product['price'] ?></span>
                        </a>
                    </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li> No products found </li>
        <?php endif; ?>