<?php

include "config.php";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {

    header("Location: index.php?message=Invalid product ID");
    exit;

}

$id = (int) $_GET["id"];

$sql = "DELETE FROM products WHERE id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("i", $id);

if ($stmt->execute()) {

    header(
        "Location: index.php?message=Product deleted successfully"
    );

} else {

    header(
        "Location: index.php?message=Unable to delete product"
    );

}

exit;

?>