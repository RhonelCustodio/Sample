<?php
// 1. Establish database connection FIRST
$conn = mysqli_connect("localhost", "root", "", "admin_users");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 2. Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 3. Sanitize inputs (AFTER $conn is defined)
    $a = isset($_POST['as']) ? mysqli_real_escape_string($conn, $_POST['as']) : '';
    $b = isset($_POST['sd']) ? mysqli_real_escape_string($conn, $_POST['sd']) : '';

    // 4. Use prepared statements (recommended for security)
    $sql = "INSERT INTO infos (Email, Password) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $a, $b); // "ss" = both are strings

    // 5. Execute and check result
    if (mysqli_stmt_execute($stmt)) {
        echo "Data inserted successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    // 6. Close connections
    mysqli_stmt_close($stmt);
} else {
    echo "Form not submitted!";
}

// Close database connection
mysqli_close($conn);
?>