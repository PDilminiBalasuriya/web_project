<?php
require_once "../auth.php";
require_once '../../config.php'; // your DB connection file

// Redirect if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../../login.php");
    exit();
}

$current_user = $_SESSION['username'];

/**
 * 1. Fetch all Bookings with Joins
 * We join with events, customers, and booking_statuses to get readable names
 */
$sql = "SELECT 
            b.Id, 
            b.Code, 
            e.event_name, 
            c.name AS customer_name, 
            b.ticket_id, 
            s.status_name 
        FROM event_bookings b
        LEFT JOIN events e ON b.event_id = e.id
        LEFT JOIN customers c ON b.customer_id = c.id
        LEFT JOIN booking_statuses s ON b.booking_status_id = s.id
        ORDER BY b.Id DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Booking Management</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>

<body class="page-layout">

<header class="header-section">
    <nav class="nav-left">
        <a href="../home.php" class="nav-link active">
            <span class="icon">&#8962;</span> Home
        </a>
    </nav>

    <div class="nav-center">
        <h2>EVENT BOOKING MANAGEMENT</h2>
    </div>

    <div class="nav-right">
        <span class="user-display">
            <span class="icon">&#128100;</span> Welcome, <strong><?php echo htmlspecialchars($current_user); ?></strong>
        </span>
        <span class="nav-divider">|</span>
        <a href="logout.php" class="logout-link">
            Logout <span class="icon">&#10150;</span>
        </a>
    </div>
</header>

<div class="action-section">
    <div class="button-wrapper">
        <button class="reg-btn" onclick="window.location.href='createEventBooking.php'">
            Create New Booking
        </button>
    </div>
</div>

<div class="table-section">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Booking Code</th>
                    <th>Event Name</th>
                    <th>Customer</th>
                    <th>Ticket ID</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($booking = $result->fetch_assoc()): ?>
                    <tr class="cell-record-row">
                        <td><strong><?php echo htmlspecialchars($booking['Code']); ?></strong></td>
                        <td><?php echo htmlspecialchars(isset($booking['event_name']) ? $booking['event_name'] : 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars(isset($booking['customer_name']) ? $booking['customer_name'] : 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($booking['ticket_id']); ?></td>
                        <td>
                            <span class="status-badge">
                                <td><?php echo htmlspecialchars(isset($booking['status_name']) ? $booking['status_name'] : 'N/A'); ?></td>

                            </span>
                        </td>
                        <td>
                            <button class="view-btn" onclick="location.href='viewBooking.php?id=<?php echo $booking['Id']; ?>'">View</button>
                            <button class="upt-btn" onclick="location.href='updateBooking.php?id=<?php echo $booking['Id']; ?>'">Update</button>
                            <button class="del-btn" onclick="confirmDelete(<?php echo $booking['Id']; ?>)">Delete</button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center;">No bookings found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function confirmDelete(id) {
    if(confirm('Are you sure you want to delete this booking?')) {
        window.location.href = 'deleteBooking.php?id=' + id;
    }
}
</script>

</body>
</html>