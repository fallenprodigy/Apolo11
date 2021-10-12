<?php

// connection
$pdo = new PDO('mysql:host=localhost;dbname=products_crud', 'root', '');
// exception
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare('SELECT * FROM products');
$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

// print_r($products);

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
  <body class="dog">
    <h1>Products CRUD!</h1>
    <p>
      <a href="./create.php"><button type="button" class="btn btn-sm btn-success">Add product</button></a>

    </p>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Image</th>
      <th scope="col">Price</th>
      <th scope="col">Create Date</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($products as $i => $product) { ?>
      <tr>
      <th scope="row"><?php echo $i + 1 ?></th>
      <td>Image</td>
      <td><?php echo $product['title'] ?> </td>
      <td><?php echo $product['price'] ?> </td>
      <td><?php echo $product['create_date'] ?> </td>
      <td>
        <button type="button" class="btn btn-sm btn-primary">Edit</button>
        <button type="button" class="btn btn-sm btn-danger">Delete</button>

      </td>
    </tr>

    <?php } ?>
  </tbody>
</table>
  </body>
</html>