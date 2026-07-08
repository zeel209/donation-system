<?php
include("db.php");

if ($_SERVER['REQUEST_METHOD'] != "POST") {
    die("Invalid Request");
}

if (
    !isset($_POST['donation_id']) ||
    !isset($_POST['razorpay_payment_id'])
) {
    die("Payment Failed");
}

$donation_id = intval($_POST['donation_id']);
$payment_id = trim($_POST['razorpay_payment_id']);

$status = "Paid";

// Update Payment Details
$stmt = $conn->prepare("UPDATE donors SET transaction_id=?, status=? WHERE id=?");

if (!$stmt) {
    die("Database Error: " . $conn->error);
}

$stmt->bind_param("ssi", $payment_id, $status, $donation_id);

if ($stmt->execute()) {

    // Fetch Donor Details
    $stmt2 = $conn->prepare("SELECT name, amount FROM donors WHERE id=?");
    $stmt2->bind_param("i", $donation_id);
    $stmt2->execute();

    $result = $stmt2->get_result();

    if ($row = $result->fetch_assoc()) {

        header("Location: donate_thankyou.php?name=" .
            urlencode($row['name']) .
            "&amount=" .
            urlencode($row['amount']));
        exit;

    } else {

        echo "Donation record not found.";

    }

} else {

    echo "Database Update Failed.";

}

$stmt->close();
$conn->close();
?>