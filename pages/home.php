<?php include("../includes/auth.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Home - Event Management</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="header">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="logout.php">Logout</a>
</div>

<div class="content">
    <h3>Event Management System</h3>
    <p>This is your home dashboard.</p>
</div>

</body>
</html>
