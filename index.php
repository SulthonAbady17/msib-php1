<?php

session_start();

$i = 1;
$products = [
    ['name' => 'Chips', 'price' => 12000],
    ['name' => 'Biscuits', 'price' => 5000],
    ['name' => 'Soft Drink', 'price' => 8000],
    ['name' => 'Isotonix Drink', 'price' => 4500],
];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $product = explode('-', $_POST['product']);
    $price = $product[1];
    $product = $product[0];
    $quantity = $_POST['quantity'];
    $amount = $price * $quantity;
    $discount = $quantity > 2 ? (20 / 100) * $amount : 0;
    $tax = (10 / 100) * ($amount - $discount);
    $total = ($amount - $discount) + $tax;

    $_SESSION['name'] = $name;
    $_SESSION['product'] = $product;
    $_SESSION['price'] = $price;
    $_SESSION['quantity'] = $quantity;
    $_SESSION['amount'] = $amount;
    $_SESSION['discount'] = $discount;
    $_SESSION['tax'] = $tax;
    $_SESSION['total'] = $total;
}

?>

<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-3 mx-auto w-50">
            <div class="col">
                <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product) : ?>
                            <tr>
                                <th scope="row" class="text-center"><?= $i++; ?></th>
                                <td><?= $product['name']; ?></td>
                                <td class="text-end"><?= "Rp. " . number_format($product['price'], 0, ",", "."); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-1 mx-auto w-50">
            <div class="col-7">
                <div class="card">
                    <div class="card-header">
                        Purchase
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your name" required>
                            </div>
                            <div class="mb-3">
                                <label for="product" class="form-label">product</label>
                                <select class="form-select" id="product" name="product">
                                    <?php foreach ($products as $product) : ?>
                                        <option value="<?= $product['name'] . '-' . $product['price']; ?>"><?= $product['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="0" required>
                            </div>
                            <div class="mb-3 text-end">
                                <button class="btn btn-secondary" type="reset">Cancel</button>
                                <button class="btn btn-primary" type="submit" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-1">
                            <b>Name : </b> <?= $_SESSION['name']; ?>
                        </div>
                        <div class="mb-1">
                            <b>Product : </b> <?= $_SESSION['product']; ?>
                        </div>
                        <div class="mb-1">
                            <b>Quantity : </b> <?= $_SESSION['quantity']; ?>
                        </div>
                        <div class="mb-1">
                            <b>Price : </b> <?= "Rp. " . number_format($_SESSION['price'], 0, ",", "."); ?>
                        </div>
                        <div class="mb-1">
                            <b>Amount : </b> <?= "Rp. " . number_format($_SESSION['amount'], 0, ",", "."); ?>
                        </div>
                        <div class="mb-1">
                            <b>Discount : </b> <?= "Rp. " . number_format($_SESSION['discount'], 0, ",", "."); ?>
                        </div>
                        <div class="mb-1">
                            <b>Tax : </b> <?= "Rp. " . number_format($_SESSION['tax'], 0, ",", "."); ?>
                        </div>
                        <div class="mb-1">
                            <b>Total : </b> <?= "Rp. " . number_format($_SESSION['total'], 0, ",", "."); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>