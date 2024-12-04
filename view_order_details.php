<?php
// Include database connection
include('db.php');

// Get the order ID from the URL
$order_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch order details from the database
$query = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $order_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the order exists
if ($result->num_rows > 0) {
    $order = $result->fetch_assoc();
    
    echo '<h1>Order Details</h1>';
    echo '<table border="1" cellpadding="10">';
    echo '<tr><th>ID</th><td>' . $order['id'] . '</td></tr>';
    echo '<tr><th>Customer Name</th><td>' . $order['customer_name'] . '</td></tr>';
    echo '<tr><th>Phone</th><td>' . $order['customer_phone'] . '</td></tr>';
    echo '<tr><th>Email</th><td>' . $order['customer_email'] . '</td></tr>';
    echo '<tr><th>Pickup/Delivery</th><td>' . ucfirst($order['pickup_or_delivery']) . '</td></tr>';
    echo '<tr><th>Delivery Address</th><td>' . ($order['pickup_or_delivery'] == 'delivery' ? $order['delivery_address'] : 'N/A') . '</td></tr>';
    echo '<tr><th>Payment Reference</th><td>' . $order['payment_reference'] . '</td></tr>';
    echo '<tr><th>Orders</th><td><pre>' . $order['orders'] . '</pre></td></tr>';
    echo '</table>';
} else {
    echo 'Order not found.';
}

$stmt->close();
$conn->close();
?>
