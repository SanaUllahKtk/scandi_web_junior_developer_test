<?php include_once('../private/initialize.php'); ?>
<?php


use MyApp\classes\Book;
use MyApp\classes\DVD;
use MyApp\classes\Furniture;

$errors = validate_inputs();

if (isset($_POST['submit']) && empty($errors)) {
  $result = '';
  $args = [];
  $args['sku'] = $_POST['sku'] ?? NULL;
  $args['name'] = $_POST['name'] ?? NULL;
  $args['price'] = $_POST['price'] ?? NULL;
  $args['weight_kg'] = $_POST['weight_kg'] ?? NULL;
  $args['size'] = $_POST['size'] ?? NULL;
  $args['width'] = $_POST['width'] ?? NULL;
  $args['length'] = $_POST['length'] ?? NULL;
  $args['height'] = $_POST['height'] ?? NULL;

  if ($_POST['weight_kg'] != NULL) {
    $book = new Book($args);
    $result = $book->save();
  }

  if ($_POST['size'] != NULL) {
    $dvd = new DVD($args);
    $result = $dvd->save();
  }

  if ($_POST['width'] != NULL && $_POST['length'] != NULL && $_POST['height'] != NULL) {
    $furniture = new Furniture($args);
    $result = $furniture->save();
  }

  if ($result === true) {
    header('Location: index.php');
    exit;
  } else {
  }
}

?>
<!-- Have different page title for each page -->
<?php $page_title = 'Product Add'; ?>
<?php include('../private/shared/head.php'); ?>

<body>
  <header class="mt-3">
    <nav>
      <h1>Product Add</h1>
      <div id='form-buttons'>
        <button name='submit' id="submit" type="submit" form='product_form' class="btn btn-success">Save</button>
        <a href="./index.php">
          <button type='button' class='btn btn-danger'>Cancel</button>
        </a>
      </div>
    </nav>
  </header>
  <?= $errors; ?>

  <div class="container">
    <form action="" id='product_form' method='POST'>
      <div class="form-group">
      <label for="sku">SKU</label>
      <input type="text" class="form-control" name="sku" id='sku' maxlength='9' placeholder="Enter SKU" value="<?= $_POST['sku'] ?? '';  ?>">
      </div>


      <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name='name' class="form-control" id='name' maxlength="30" placeholder='Product name' value="<?= $_POST['name'] ?? ''; ?>">
      </div>


      <div class="form-group">
      <label for="price">Price ($)</label>
      <input type="text" name='price' class="form-control" id='price' placeholder="0.0" value="<?= $_POST['price'] ?? ''; ?>">
      </div>


      <div class="form-group">
      <label for="productType">Type Switcher</label>
      <select name="typeSwitcher" id="productType" class="form-control">
        <option value="dvd" id='DVD' <?= get_selected_type('dvd'); ?>>DVD</option>
        <option value="book" id='Book' <?= get_selected_type('book'); ?>>Book</option>
        <option value="furniture" id='Furniture' <?= get_selected_type('furniture'); ?>>Furniture</option>
      </select>
      </div>
      


      <div id='size-container' class="form-group">
        <p>Please provide a size in megabyte (MB).</p>
        <label for="size">Size (MB)</label>
        <input type="text" name='size' class="form-control" id='size' placeholder='0' maxlength='5' value="<?= $_POST['size'] ?? ''; ?>">
      </div>

      <div id='weight-container' class="form-group">
        <p>Please provide a weight in kilograms (KG).</p>
        <label for="weight">Weight (KG)</label>
        <input type="text" name='weight_kg' class='form-control' id='weight' placeholder='0.0' maxlength='3' value="<?= $_POST['weight_kg'] ?? ''; ?>">
      </div>

      <div id='dimensions-container' class="form-group">
        <p>Please provide dimensions in HxWxL (height/width/length) format.</p>
        <label for="height">Height (CM)</label>
        <input type="text" name='height' class='form-control' id='height' placeholder='0' maxlength='5' value="<?= $_POST['height'] ?? ''; ?>">
        <label for="width">Width (CM)</label>
        <input type="text" name='width' id='width' class='form-control' placeholder='0' maxlength='5' value="<?= $_POST['width'] ?? ''; ?>">
        <label for="length">Length (CM)</label>
        <input type="text" name='length' id='length' class='form-control' placeholder='0' maxlength='5' value="<?= $_POST['length'] ?? ''; ?>">
      </div>
    </form>
  </div>



  <?php include('../private/shared/footer.php'); ?>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script src='./script.js'></script>
</body>

</html>