<?php

include "config.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $product_name = trim($_POST["product_name"]);
    $category = trim($_POST["category"]);
    $quantity = (int) $_POST["quantity"];
    $price = (float) $_POST["price"];
    $supplier = trim($_POST["supplier"]);

    if (
        $product_name === "" ||
        $category === "" ||
        $supplier === ""
    ) {

        $error = "Please fill in all fields.";

    } elseif ($quantity < 0 || $price < 0) {

        $error = "Quantity and price cannot be negative.";

    } else {

        $sql = "INSERT INTO products
                (product_name, category, quantity, price, supplier)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ssids",
            $product_name,
            $category,
            $quantity,
            $price,
            $supplier
        );

        if ($stmt->execute()) {

            header(
                "Location: index.php?message=Product added successfully"
            );

            exit;

        } else {

            $error = "Unable to add product.";

        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Add Product</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="form-container">

    <h2>Add New Product</h2>

    <?php if ($error): ?>

        <div class="error">
            <?php echo htmlspecialchars($error); ?>
        </div>

    <?php endif; ?>

    <form method="POST">

        <label>Product Name</label>

        <input
            type="text"
            name="product_name"
            required
        >

        <label>Category</label>

        <input
            type="text"
            name="category"
            required
        >

        <label>Quantity</label>

        <input
            type="number"
            name="quantity"
            min="0"
            required
        >

        <label>Price</label>

        <input
            type="number"
            name="price"
            min="0"
            step="0.01"
            required
        >

        <label>Supplier</label>

        <input
            type="text"
            name="supplier"
            required
        >

        <div class="form-buttons">

            <button
                type="submit"
                class="btn btn-add"
            >
                Save Product
            </button>

            <a
                href="index.php"
                class="btn btn-cancel"
            >
                Cancel
            </a>

        </div>

    </form>

</div>

</body>
</html>