<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
          <?php foreach($similar_products as $similar_product): ?>
                    <li>
                        <a href="<?= base_url("/Products/item/".$similar_product['id']) ?>">
                            <img src="<?= base_url($similar_product['image']) ?>" alt="<?= $similar_product['name'] ?>">
                            <h3>something</h3>
                            <ul class="rating">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <span>36 Rating</span>
                            <span class="price">Php <?= $similar_product['price'] ?>.00</span>
                        </a>
                    </li>
          <?php endforeach; ?>

</body>
</html>