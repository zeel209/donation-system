<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php?redirect=checkout");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $full_name = trim($_POST['full_name']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $total = floatval($_POST['total']);
    $payment_method = $_POST['payment_method'];

    // ✅ Demo success flow me Pending ko Success/Confirmed bana rahe hain
    $payment_status = 'Success';
    $order_status = 'Confirmed';
    $payment_id = NULL;
    $upi_transaction_id = NULL;
    $upi_vpa = NULL;
    $upi_provider = NULL;

    if ($payment_method === 'UPI') {
        $upi_vpa = trim($_POST['upi_vpa']);
        $upi_provider = trim($_POST['upi_provider']);
        $upi_transaction_id = 'TXN' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 10));
    }

    // Start transaction
    $conn->begin_transaction();

    try {
        // Insert order
        $stmt = $conn->prepare("INSERT INTO orders (user_id, full_name, phone, address, total, payment_method, payment_id, upi_transaction_id, payment_status, order_status, created_at)
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        if (!$stmt) throw new Exception("Prepare failed for orders insert: " . $conn->error);
        $stmt->bind_param("isssdsssss", $user_id, $full_name, $phone, $address, $total, $payment_method, $payment_id, $upi_transaction_id, $payment_status, $order_status);
        if (!$stmt->execute()) throw new Exception("Execute failed for orders insert: " . $stmt->error);
        $order_id = $stmt->insert_id;
        $stmt->close();

        // Insert into payments table
        $stmtPayment = $conn->prepare("INSERT INTO payments (payment_id, order_id, payment_method, provider, upi_vpa, upi_transaction_id, amount, payment_status, gateway_response, created_at)
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        if (!$stmtPayment) throw new Exception("Prepare failed for payments insert: " . $conn->error);
        $paymentIdStr = "PAY" . $order_id . time();
        $providerVal = ($payment_method === 'UPI') ? $upi_provider : NULL;
        $upiVpaVal = ($payment_method === 'UPI') ? $upi_vpa : NULL;
        $gatewayResponse = json_encode([
            "transaction_id" => $upi_transaction_id,
            "provider" => $upi_provider,
            "status" => "success",
            "message" => "Demo payment received via GPay"
        ]);
        $stmtPayment->bind_param("sissssdss", $paymentIdStr, $order_id, $payment_method, $providerVal, $upiVpaVal, $upi_transaction_id, $total, $payment_status, $gatewayResponse);
        if (!$stmtPayment->execute()) throw new Exception("Execute failed for payments insert: " . $stmtPayment->error);
        $payment_insert_id = $stmtPayment->insert_id;
        $stmtPayment->close();

        // Update orders.payment_id with payments.id
        $stmtUpdateOrder = $conn->prepare("UPDATE orders SET payment_id = ? WHERE id = ?");
        if (!$stmtUpdateOrder) throw new Exception("Prepare failed for orders update: " . $conn->error);
        $stmtUpdateOrder->bind_param("ii", $payment_insert_id, $order_id);
        if (!$stmtUpdateOrder->execute()) throw new Exception("Execute failed for orders update: " . $stmtUpdateOrder->error);
        $stmtUpdateOrder->close();

        // Fetch cart items for the user
        $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
        if (!$stmt) throw new Exception("Prepare failed for cart select: " . $conn->error);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 0) throw new Exception("Your cart is empty. Cannot place order.");

        // Insert each cart item into order_items and update stock
        while ($row = $result->fetch_assoc()) {
            $productId = (int)$row['product_id'];
            $qty = (int)$row['quantity'];
            $name = $row['name'];
            $price = (float)$row['price'];
            $subtotal = (float)$row['subtotal'];

            // ⿡ Insert into order_items
            $stmt2 = $conn->prepare("INSERT INTO order_items (order_id, product_id, name, price, qty, subtotal) VALUES (?, ?, ?, ?, ?, ?)");
            if (!$stmt2) throw new Exception("Prepare failed for order_items insert: " . $conn->error);
            $stmt2->bind_param("iisdid", $order_id, $productId, $name, $price, $qty, $subtotal);
            if (!$stmt2->execute()) throw new Exception("Execute failed for order_items insert: " . $stmt2->error);
            $stmt2->close();

            // ⿢ Update product stock
            $stmtStock = $conn->prepare("UPDATE products SET stock = stock - ? WHERE id = ? AND stock >= ?");
            if (!$stmtStock) throw new Exception("Prepare failed for stock update: " . $conn->error);
            $stmtStock->bind_param("iii", $qty, $productId, $qty);
            if (!$stmtStock->execute()) throw new Exception("Execute failed for stock update: " . $stmtStock->error);
            if ($stmtStock->affected_rows == 0) throw new Exception("Insufficient stock for product ID $productId");
            $stmtStock->close();
        }
        $stmt->close();

        // Clear user's cart
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ?");
        if (!$stmt) throw new Exception("Prepare failed for cart delete: " . $conn->error);
        $stmt->bind_param("i", $user_id);
        if (!$stmt->execute()) throw new Exception("Execute failed for cart delete: " . $stmt->error);
        $stmt->close();

        // Commit transaction
        $conn->commit();

        // Redirect to success page
        header("Location: payment_success.php?order_id=$order_id");
        exit();

    } catch (Exception $e) {
        $conn->rollback();
        die("Transaction failed: " . $e->getMessage());
    }

} else {
    echo "Invalid request!";
}
?>