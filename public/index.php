<?php

use MyApp\classes\Product;

include_once('../private/initialize.php');

$products = Product::select_all();

// Delete the selected items
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteId'])) {

  Product::delete();
}

?>
<!-- Have different page title for each page -->
<?php $page_title = 'Product List'; ?>
<?php include('../private/shared/head.php'); ?>

<body style="min-height: 100vh;">
  <header class="mt-3">
    <nav>
      <h1>Product List</h1>
      <div id='nav-buttons'>
        <a href="./new_product.php"><button id='add-product-btn' type='button' class="btn btn-primary">ADD</button></a>
        <button id='delete-product-btn' form='product_list' type='submit' name='delete' class="btn btn-danger">MASS DELETE</button>
      </div>
    </nav>
  </header>


  <main>
    <!-- Get all the products from the database and display them -->
    <div class="container">
      <form action="" id='product_list' method='POST'>
        <div class="row">
          <?php foreach ($products as $product) { ?>


            <div class="col-4">
              <div class='product-info card p-2'>
                <div class="checkbox mr-0">
                  <input type="checkbox" name="deleteId[]" value="<?= $product->id ?>" class="delete-checkbox">
                </div>


                <label><b>Sku: </b> <?= $product->sku; ?></label>
                <label><b>Product Name: </b> <?= $product->name; ?></label>

                <label><b>Price: </b><?= $product->price; ?></label>

                <label><?php
                        if (!empty($product->weight_kg))
                          echo  "<b> Weight: </b> " . $product->weight_kg . " KG";

                        if (!empty($product->size))
                          echo  "<b> Size: </b> " . $product->size . "MB";


                        if (!empty($product->dimensions))
                          echo "<b> Dimensions: </b> " . extract_from_database_array($product->dimensions);

                        ?>
                </label>
              </div>


            </div>

          <?php }; ?>
        </div>
      </form>
    </div>
  </main>

</body>
<?php include('../private/shared/footer.php'); ?>

</html>