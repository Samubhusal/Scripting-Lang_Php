<?php
try {
    // Code that may throw an exception
    $number = readline("Enter a number: ");
    if (!is_numeric($number)) {
        throw new Exception("Invalid input. Please enter a number.");
    }

    if ($number == 0) {
        throw new Exception("Division by zero is not allowed.");
    }

    $result = 10 / $number;
    echo "Result: " . $result . "\n";

} catch (Exception $e) {
    // Handle the exception
    echo "Error: " . $e->getMessage() . "\n";
} finally {
    // This block always runs
    echo "Execution finished.\n";
}
?>
