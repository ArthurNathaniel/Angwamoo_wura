<?php
// Include database connection
include('db.php');

// Default query to fetch all orders
$query = "SELECT * FROM orders";

// Check if a date filter is applied
if (isset($_POST['order_date']) && !empty($_POST['order_date'])) {
    $order_date = $_POST['order_date'];
    $query .= " WHERE DATE(payment_time) = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $order_date);
} else {
    $stmt = $conn->prepare($query);
}

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Display date filter form
echo '<form method="POST" action="">
        <label for="order_date">Filter by Date (YYYY-MM-DD): </label>
        <input type="date" name="order_date" id="order_date" required>
        <button type="submit">Filter Orders</button>
      </form>';

// Check if any orders exist
if ($result->num_rows > 0) {
    // Display orders in a table
    echo '<h1>Orders List</h1>';
    echo '<table border="1" cellpadding="10">';
    echo '<tr>
            <th>ID</th>
            <th>Customer Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Pickup/Delivery</th>
            <th>Delivery Address</th>
            <th>Payment Reference</th>
            <th>Orders</th>
            <th>Action</th>
          </tr>';
    
    // Loop through the orders and display each row
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['customer_name'] . '</td>';
        echo '<td>' . $row['customer_phone'] . '</td>';
        echo '<td>' . $row['customer_email'] . '</td>';
        echo '<td>' . ucfirst($row['pickup_or_delivery']) . '</td>';
        echo '<td>' . ($row['pickup_or_delivery'] == 'delivery' ? $row['delivery_address'] : 'N/A') . '</td>';
        echo '<td>' . $row['payment_reference'] . '</td>';
        echo '<td><pre>' . $row['orders'] . '</pre></td>';
        echo '<td><a href="view_order_details.php?id=' . $row['id'] . '">View Details</a></td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo 'No orders found for the selected date.';
}

$stmt->close();
$conn->close();
?>
