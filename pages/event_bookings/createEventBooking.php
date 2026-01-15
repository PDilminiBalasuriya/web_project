<?php
// 1. Load the database connection
require_once '../../config.php'; 

// 2. Load auth.php
require_once '../auth.php'; 


// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize inputs based on your DB columns
    $code = mysqli_real_escape_string($conn, $_POST['code']);
    $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);
    $customer_id = mysqli_real_escape_string($conn, $_POST['customer_id']);
    $ticket_id = mysqli_real_escape_string($conn, $_POST['ticket_id']);
    $booking_status_id = mysqli_real_escape_string($conn, $_POST['booking_status_id']);

    // Basic Validation
    if (empty($code) || empty($event_id) || empty($customer_id)) {
        echo "<script>alert('Please fill in all required fields!'); window.history.back();</script>";
        exit();
    }

    // Insert into table: event_bookings
    $sql = "INSERT INTO event_bookings (Code, event_id, customer_id, ticket_id, booking_status_id) 
            VALUES ('$code', '$event_id', '$customer_id', '$ticket_id', '$booking_status_id')";
    
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Booking Created Successfully!'); window.location.href='../bookings_list.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Fetch helper data for dropdowns (Example for Events)
$events_result = mysqli_query($conn, "SELECT id, event_name FROM events ORDER BY event_name ASC");
$customers_result = mysqli_query($conn, "SELECT id, name FROM customers ORDER BY name ASC");
$statuses_result = mysqli_query($conn, "SELECT id, status_name FROM booking_statuses");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Event Booking</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="create-user-page">

    <header class="header-section">
        <nav class="nav-left">
            <a href="events.php" class="nav-link">
                <span class="icon">&#8592;</span> BACK TO LIST
            </a>
        </nav>
        <div class="nav-center"><h2>CREATE NEW BOOKING</h2></div>
        <div class="nav-right">
            <span class="user-display"><span class="icon">&#128100;</span> Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span>
        </div>
    </header>

    <main class="form-wrapper">
        <div class="glass-card">
            <form action="" method="POST">
                <div class="input-group">
                    <label>Booking Code</label>
                    <input type="text" name="code" placeholder="e.g. BK-1001" maxlength="10" required>
                </div>

                <div class="input-group">
                    <label>Title</label>
                    <input type="text" name="title" placeholder="e.g. BK-1001" maxlength="10" required>
                </div>

                <div class="input-group">
                    <label>Type</label>
                    <select name="event_id" required>
                        <option value="" disabled selected>-- Select Event --</option>
                        <?php while($row = mysqli_fetch_assoc($events_result)) {
                            echo "<option value='{$row['id']}'>{$row['event_name']}</option>";
                        } ?>
                    </select>
                </div>

                <div class="input-group">
                    <label>Select Customer</label>
                    <select name="customer_id" required>
                        <option value="" disabled selected>-- Select Customer --</option>
                        <?php while($row = mysqli_fetch_assoc($customers_result)) {
                            echo "<option value='{$row['id']}'>{$row['name']}</option>";
                        } ?>
                    </select>
                </div>

                <div class="input-group">
                    <label>Ticket ID</label>
                    <input type="number" name="ticket_id" required>
                </div>

                <div class="input-group">
                    <label>Status</label>
                    <select name="booking_status_id" required>
                        <?php while($row = mysqli_fetch_assoc($statuses_result)) {
                            echo "<option value='{$row['id']}'>{$row['status_name']}</option>";
                        } ?>
                    </select>
                </div>

                <div class="button-row">
                    <button type="submit" class="submit-btn">Create Booking</button>
                    <button type="button" class="submit-btn close-btn" onclick="location.href='../admin.php'">Close</button>
                </div>
            </form>
        </div>
    </main>

</body>
</html>