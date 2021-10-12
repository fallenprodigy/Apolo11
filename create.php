<?php

// connection
$pdo = new PDO('mysql:host=localhost;dbname=products_crud', 'root', '');
// exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';

$errors = [];

$title = '';
$description = '';
$price = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    if (!$title) {
        $errors[] = 'Product title is required';

    }
    
    if (!$price) {
        $errors[] = 'Product price is required';
    }

    if (empty($errors)) {
         $statement = $pdo->prepare("INSERT INTO products 
                    (title, image, description , price, create_date)
                    VALUES (:title, :image, :description, :price, :date)");
        $statement->bindValue(':title', $title);
        $statement->bindValue(':image', '');
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':date', date('Y-m-d H:i:s'));

        $statement->execute();
        header('Location: index.php');

    }


   

   
};
?>






<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Products</title>
  </head>
  <body>
    <h1>Create new Product</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <div><?php echo $error ?></div>
                <?php endforeach; ?>
        </div>
    <?php  endif; ?>
    <form method="POST">
    <div class="mb-3">
        <label for="exampleInputImage" class="form-label" >Product image</label><br>
        <input type="file" name='name' class="form-control" id="exampleInputImage">
    </div>
  <div class="mb-3">
        <label for="exampleInputTitle" class="form-label" >Product title</label>
        <input type="text" name="title" class="form-control" id="exampleInputTitle" value="<?php echo $title ?>">
  </div>
   <div class="mb-3">
        <label for="exampleInputDescription" >Product description</label>
        <textarea name="description"  class="form-control" id="exampleInputDescription"><?php echo $description ?></textarea>
  </div>
  <div class="mb-3">
        <label for="exampleInputPrice" class="form-label" >Product price</label>
        <input name="price" type="number" class="form-control" id="exampleInputPrice" value="<?php echo $price ?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

  </body>
</html>