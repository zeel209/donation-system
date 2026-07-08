<?php
include("db.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    die("Invalid Request");
}

$donation_id = isset($_POST['donation_id']) ? intval($_POST['donation_id']) : 0;
$transaction_id = isset($_POST['transaction_id']) ? trim($_POST['transaction_id']) : "";

if ($donation_id <= 0 || empty($transaction_id)) {
    die("Please enter Transaction ID.");
}

// Update donor record
$status = "Paid";

$stmt = $conn->prepare("UPDATE donors SET transaction_id=?, status=? WHERE id=?");
$stmt->bind_param("ssi", $transaction_id, $status, $donation_id);

if ($stmt->execute()) {

    // Get donor details
    $stmt2 = $conn->prepare("SELECT name, amount FROM donors WHERE id=?");
    $stmt2->bind_param("i", $donation_id);
    $stmt2->execute();

    $result = $stmt2->get_result();

    if ($row = $result->fetch_assoc()) {

        header("Location: donate_thankyou.php?name=" .
            urlencode($row['name']) .
            "&amount=" .
            urlencode($row['amount']));
        exit();

    } else {

        echo "Donation record not found.";

    }

} else {

    echo "Database update failed.";

}

$stmt->close();
$conn->close();
?>