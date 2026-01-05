<?php include("../includes/auth.php"); ?>
<?php if($_SESSION['role'] != 'admin') { header("Location: home.php"); } ?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Event Management</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<h2>Admin Panel</h2>

<ul class="admin-menu">
    <li><a href="#">Add Users</a></li>
    <li><a href="#">Edit Users</a></li>
    <li><a href="#">Delete Users</a></li>
    <li><a href="#">View Reports</a></li>
</ul>

</body>
</html>
