<?php
//session_start();
require_once "auth.php";
adminOnly(); // Make sure this function exists in auth.php

require_once '../config.php'; // Database connection

// Redirect if not logged in or not admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'Admin') {
    header("Location: ../login.php");
    exit();
}

$current_user = $_SESSION['username'];

// Fetch all users with roles
$sql = "
    SELECT e.Id, e.Code, e.Title, e.Type_Id, e.Venue, e.City, e.Date, e.Start Time, e.End Time, e.Status_Id, s.Status Type, t.Type
    FROM event e
    LEFT JOIN event_type t ON e.Type_Id = t.Type_Id
    LEFT JOIN event_status s ON e.Status_Id = s.Status_Id
    ORDER BY e.Id
";
$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<link rel="stylesheet" href="../css/style5.css">
<style>
    body { font-family: Arial, sans-serif; }
    .header-section { display: flex; justify-content: space-between; align-items: center; padding: 10px 20px; background: #f2f2f2; }
    .nav-link { text-decoration: none; margin-right: 10px; }
    .table-section { margin: 20px; }
    table { width: 100%; border-collapse: collapse; }
    th, td { border: 1px solid #333; padding: 10px; text-align: center; }
    th { background: #eee; }
    .reg-btn, .view-btn, .upt-btn, .del-btn { padding: 5px 10px; margin: 2px; cursor: pointer; }
</style>
</head>
<body>

<header class="header-section">
    <nav class="nav-left">
        <a href="home.php" class="nav-link active">&#8962; Home</a>
    </nav>
    <div class="nav-center">
        <h2>Events</h2>
    </div>
    <div class="nav-right">
        <span class="user-display">&#128100; Welcome, <strong><?php echo htmlspecialchars($current_user); ?></strong></span>
        <span class="nav-divider">|</span>
        <a href="logout.php" class="logout-link">Logout &#10150;</a>
    </div>
</header>

<div class="action-section" style="margin:20px;">
    <a href="users/createUser.php" style="text-decoration:none;">
        <button class="reg-btn"> Add New Event</button>
    </a>
</div>

<div class="table-section">
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Event</th>
                    <th>City</th>
                    <th>Event</th>
                    <th>City</th>
                    <th>Event</th>
                    <th>City</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($user = $result->fetch_assoc()): ?>
                        <?php
                            $event_Title = isset($event['Title']) ? intval($event['Title']) : 'No Event Title';
                            $event_City = isset($event['City']) ? $event['City'] : 'No City';
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td>
                                <select class="drop-down" disabled>
                                    <option value="0" <?php echo ($user_role_id == 0) ? 'selected' : ''; ?>>No Role</option>
                                    <?php foreach ($roles as $id => $role_name_option): ?>
                                        <option value="<?php echo intval($id); ?>" <?php echo ($user_role_id == intval($id)) ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($role_name_option); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                                <button class="view-btn" onclick="location.href='events/viewEvent.php?id=<?php echo $user['id']; ?>'">View</button>
                                <button class="upt-btn" onclick="location.href='events/updateEvent.php?id=<?php echo $user['id']; ?>'">Update</button>
                                <button class="del-btn" onclick="if(confirm('Are you sure you want to delete this Event?')) location.href='event/deleteEvent.php?id=<?php echo $user['id']; ?>'">Delete</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="3">No Events Found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
