<?php
// Include database connection
include('db.php');

// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);

// Check if the required data is present
if ($data && isset($data['customerName'], $data['customerPhone'], $data['customerEmail'], $data['pickupOrDelivery'], $data['reference'])) {
    
    // Extract customer details
    $customerName = $data['customerName'];
    $customerPhone = $data['customerPhone'];
    $customerEmail = $data['customerEmail'];
    $pickupOrDelivery = $data['pickupOrDelivery'];
    $deliveryAddress = isset($data['deliveryAddress']) ? $data['deliveryAddress'] : ''; // Delivery address is optional for pickup
    $reference = $data['reference'];
    $orders = json_encode($data['orders']); // Encoding orders as JSON string

    // Insert customer details into the database
    $stmt = $conn->prepare("INSERT INTO orders (customer_name, customer_phone, customer_email, pickup_or_delivery, delivery_address, payment_reference, orders) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('sssssss', $customerName, $customerPhone, $customerEmail, $pickupOrDelivery, $deliveryAddress, $reference, $orders);
    
    if ($stmt->execute()) {
        // Return a success response
        echo json_encode(['success' => true]);
    } else {
        // Return an error response
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid data']);
}

$conn->close();
?>
