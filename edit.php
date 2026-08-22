<?php

include "config.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: index.php?message=Invalid product ID");
    exit;

}

$id = (int) $_GET["id"];

$error = "";

$sql = "SELECT * FROM products WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

$stmt->execute();

$result = $stmt->get_result();

$product = $result->fetch_assoc();

if (!$product) {

    header("Location: index.php?message=Product not found");
    exit;

}

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

        $updateSql = "UPDATE products
                      SET product_name = ?,
                          category = ?,
                          quantity = ?,
                          price = ?,
                          supplier = ?
                      WHERE id = ?";

        $update = $conn->prepare($updateSql);

        $update->bind_param(
            "ssidsi",
            $product_name,
            $category,
            $quantity,
            $price,
            $supplier,
            $id
        );

        if ($update->execute()) {

            header(
                "Location: index.php?message=Product updated successfully"
            );

            exit;

        } else {

            $error = "Unable to update product.";

        }
    }

    $product["product_name"] = $product_name;
    $product["category"] = $category;
    $product["quantity"] = $quantity;
    $product["price"] = $price;
    $product["supplier"] = $supplier;
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

    <title>Edit Product</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="form-container">

    <h2>Edit Product</h2>

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
            value="<?php echo htmlspecialchars(
                $product["product_name"]
            ); ?>"
            required
        >

        <label>Category</label>

        <input
            type="text"
            name="category"
            value="<?php echo htmlspecialchars(
                $product["category"]
            ); ?>"
            required
        >

        <label>Quantity</label>

        <input
            type="number"
            name="quantity"
            min="0"
            value="<?php echo $product["quantity"]; ?>"
            required
        >

        <label>Price</label>

        <input
            type="number"
            name="price"
            min="0"
            step="0.01"
            value="<?php echo $product["price"]; ?>"
            required
        >

        <label>Supplier</label>

        <input
            type="text"
            name="supplier"
            value="<?php echo htmlspecialchars(
                $product["supplier"]
            ); ?>"
            required
        >

        <div class="form-buttons">

            <button
                type="submit"
                class="btn btn-edit"
            >
                Update Product
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