<?php
require_once '../../config.php'; 
require_once '../auth.php'; 
adminOnly();

if (isset($_GET['id'])) {
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT u.*, r.role_name FROM users u LEFT JOIN roles r ON u.Role_Id = r.role_id WHERE u.id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
        exit;
    }
} else {
    echo "No user ID provided.";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View User Details</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="create-user-page">

    <header class="header-section">
        <nav class="nav-left">
            <a href="../admin.php" class="nav-link"><span class="icon">&#8592;</span> BACK TO LIST</a>
        </nav>
        <div class="nav-center"><h2>USER DETAILS</h2></div>
        <div class="nav-right">
             <span class="user-display"><span class="icon">&#128100;</span>Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span>
        </div>
    </header>

    <main class="form-wrapper" style="padding-top: 20px;">
        <div class="glass-card">
            <div class="view-group" style="width: 100%; max-width: 480px;">
                
                <div class="input-group">
                    <label>User ID</label>
                    <div class="view-data"><?php echo $user['id']; ?></div>
                </div>

                <div class="input-group">
                    <label>Username</label>
                    <div class="view-data"><?php echo htmlspecialchars($user['username']); ?></div>
                </div>

                <div class="input-group">
                    <label>Assigned Role</label>
                    <div class="view-data"><?php echo htmlspecialchars(isset($user['role_name']) ? $user['role_name'] : 'No Role Assigned'); ?></div>
                </div>



                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <div class="view-actions">
                        <button class="submit-btn edit-btn" onclick="location.href='updateUser.php'">Edit User</button>
                        <button class="submit-btn close-btn" onclick="location.href='../admin.php'" >Close</button>
                    </div>

                    
                </div>

            </div>
        </div>
    </main>
</body>
</html>
