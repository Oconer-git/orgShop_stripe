<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>

    <script src="../assets/js/vendor/jquery.min.js"></script>
    <script src="../assets/js/vendor/popper.min.js"></script>
    <script src="../assets/js/vendor/bootstrap.min.js"></script>
    <script src="../assets/js/vendor/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/vendor/bootstrap-select.min.css">

    <link rel="stylesheet" href="../assets/css/custom/admin_global.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/alfrcr/paginathing/dist/paginathing.min.js"></script>
    <script src="../assets/js/global/admin_products.js"></script>
</head>
<body>
    <div class="wrapper">
        <header>
            <h1>Let’s provide fresh items for everyone.</h1>
            <h2>Products</h2>
            <div>
                <a class="switch" href="<?= base_url('/products') ?>">Switch to Shop View</a>
                <button class="profile">
                    <img src="../assets/images/profile.png" alt="#">
                </button>
            </div>
            <div class="dropdown show">
                <a class="btn btn-secondary dropdown-toggle profile_dropdown" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu admin_dropdown" aria-labelledby="dropdownMenuLink">
                <form class= "log_out" action="<?= base_url('Admins/log_out_process') ?>" method= "POST">
                        <input type="hidden" name="action" value="log_out">
                        <input type="submit" value="log out" class="dropdown-item">
                    </form>
                </div>
            </div>
        </header>
        <aside>
            <a href="#"><img src="../assets/images/organi_shop_logo_dark.svg" alt="Organic Shop"></a>
            <ul>
                <li><a href="/admins">Orders</a></li>
                <li class="active"><a href="#">Products</a></li>
            </ul>
        </aside>
        <section>
            <form action="/Admins/search_product" method="post" class="search_form">
                <input type="text" name="search" placeholder="Search Products">
            </form>
            <button class="add_product" data-toggle="modal" data-target="#add_product_modal">Add Product</button>
            <section class="status_section">
                <h3>Categories</h3>
                <form action="<?= base_url('Admins/products_category_process')?>" method="post" class="status_form active">
                    <input type="hidden" name="category_id" value="0">
                    <input type="submit" value="All">
                </form>
                <form action="<?= base_url('Admins/products_category_process')?>" method="post" class="status_form">
                    <input type="hidden" name="category_id" value="1">
                    <input type="submit" value="Vegetables"> 
                </form>
                <form action="<?= base_url('Admins/products_category_process')?>" method="post" class="status_form">
                    <input type="hidden" name="category_id" value="2">
                    <input type="submit" value="Fruits"> 
                </form>
                <form action="<?= base_url('Admins/products_category_process')?>" method="post" class="status_form">
                    <input type="hidden" name="category_id" value="3">
                    <input type="submit" value="Pork">  
                </form>
                <form action="<?= base_url('Admins/products_category_process')?>" method="post" class="status_form">
                    <input type="hidden" name="category_id" value="4">
                    <input type="submit" value="Beef">  
                </form>
                <form action="<?= base_url('Admins/products_category_process')?>" method="post" class="status_form">
                    <input type="hidden" name="category_id" value="5">
                    <input type="submit" value="Chicken">  
                </form>
            </section>
            <div>
                <table class="products_table products_content">
                    <thead>
                        <tr>
                            <th><h3>All Products</h3></th>
                            <th>ID #</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Inventory</th>
                            <th>Sold</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
 
                    </tbody>
                </table>
            </div>
        </section>
        <div class="modal fade form_modal" id="add_product_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button data-dismiss="modal" aria-label="Close" class="close_modal"></button>
                    <form id="add_product_modal_form" class="delete_product_form" action="<?= base_url('admins/add_product_process') ?>" method="post" enctype="multipart/form-data">
                        <h2>Add a Product</h2>
                        <ul>    
                            <li>
                                <input type="text" name="name" required>
                                <label>Product Name</label>
                            </li>
                            <li>   
                                <textarea name="description" required></textarea>
                                <label>Description</label>
                            </li>
                            <li>
                                <label>Category</label>
                                <select class="selectpicker" name="category">
                                    <option value="1">Vegetables</option>
                                    <option value="2">Fruits</option>
                                    <option value="3">Pork</option>
                                    <option value="4">Beef</option>
                                    <option value="5">Chicken</option>
                                </select>
                            </li>
                            <li>
                                <input type="number" name="price" value="1" required>
                                <label>Price</label>
                            </li>
                            <li>
                                <input type="number" name="inventory" value="1" required>
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
                        <input type="hidden" name="action" value="add_product">
                        <button type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade form_modal" id="edit_product_modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <button data-dismiss="modal" aria-label="Close" class="close_modal"></button>
                    <form id="edit_product_modal_form" class="delete_product_form" action="<?= base_url('admins/edit_product_process') ?>" method="post" enctype="multipart/form-data">
                        <h2>Add a Product</h2>
                        <ul>    
                            <li>
                                <input type="text" name="name">
                                <label>Products Name edit</label>
                            </li>
                            <li>   
                                <textarea name="description"></textarea>
                                <label>Description</label>
                            </li>
                            <li>
                                <label>Category</label>
                                <select class="selectpicker" name="category">
                                    <option value="1">Vegetables</option>
                                    <option value="2">Fruits</option>
                                    <option value="3">Pork</option>
                                    <option value="4">Beef</option>
                                    <option value="5">Chicken</option>
                                </select>
                            </li>
                            <li>
                                <input type="number" name="price" value="null" >
                                <label>Price</label>
                            </li>
                            <li>
                                <input type="number" name="inventory" value="null">
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
                        <input id="product_id" type="hidden" name="id">
                        <input type="hidden" name="action" value="edit_product">
                        <button type="button" data-dismiss="modal" aria-label="Close">Cancel</button>
                        <button type="submit">Save</button>
                    </form>
                </div>
            </div>
        </div>
    <div class="popover_overlay"></div>
</body>
</html>