<?php

include "config.php";

$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Inventory Management System</title>

        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <div class="container">

            <div class="header">
                <h1>Inventory Management System</h1>

                <a href="add.php" class="btn btn-add">
                    Add Product
                </a>
            </div>

            <?php if (isset($_GET["message"])): ?>

                <div class="message">
                    <?php echo htmlspecialchars($_GET["message"]); ?>
                </div>

            <?php endif; ?>

            <div class="table-wrapper">

                <table>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Supplier</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php if ($result && $result->num_rows > 0): ?>

                        <?php while ($row = $result->fetch_assoc()): ?>

                            <tr>

                                <td>
                                    <?php echo $row["id"]; ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row["product_name"]); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row["category"]); ?>
                                </td>

                                <td>
                                    <?php echo $row["quantity"]; ?>
                                </td>

                                <td>
                                    Rs. <?php echo number_format($row["price"], 2); ?>
                                </td>

                                <td>
                                    <?php echo htmlspecialchars($row["supplier"]); ?>
                                </td>

                                <td>
                                    <?php echo $row["created_at"]; ?>
                                </td>

                                <td class="actions">

                                    <a
                                        href="edit.php?id=<?php echo $row["id"]; ?>"
                                        class="btn btn-edit"
                                    >
                                        Edit
                                    </a>

                                    <a
                                        href="delete.php?id=<?php echo $row["id"]; ?>"
                                        class="btn btn-delete"
                                        onclick="return confirm('Are you sure you want to delete this product?');"
                                    >
                                        Delete
                                    </a>

                                </td>

                            </tr>

                        <?php endwhile; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="8" class="empty">
                                    No products found.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>  
     </body>
</html>