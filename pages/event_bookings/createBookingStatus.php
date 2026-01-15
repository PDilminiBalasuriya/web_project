<?php
// 1. Load the database connection first
require_once '../../config.php'; 

// 2. Load auth.php
require_once '../auth.php'; 
adminOnly();

// --- ADD THIS CHECK HERE ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['role_name'])) {
        
        $role_name = mysqli_real_escape_string($conn, $_POST['role_name']);

        if (strlen($role_name) < 3) {
            echo "<script>alert('Role name must be at least 3 characters long!'); window.history.back();</script>";
            exit();
        }

        // Database insertion
        $sql = "INSERT INTO roles (role_name) VALUES ('$role_name')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('User Role Created Successfully!'); window.location.href='admin.php';</script>";
            exit(); // Good practice to exit after a redirect
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Error: Form data missing. Check your input field name.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create User Roles</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="create-user-page">

    <header class="header-section">
        <nav class="nav-left">
            <a href="admin.php" class="nav-link">
                <span class="icon">&#8592;</span> BACK TO LIST
            </a>
        </nav>
        <div class="nav-center"><h2>CREATE USER ROLES</h2></div>
        <div class="nav-right">
            <span class="user-display"><span class="icon">&#128100;</span> Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span>
        </div>
    </header>

    <main class="form-wrapper">
        <div class="glass-card">
            <form action="" method="POST">
                <div class="input-group">
                    <label>Role Name</label>
                    <input type="text" name="role_name" id="role_name" placeholder="Min 3 characters" required>
                </div>

                
                <div class="button-row">
                    <button type="submit" class="submit-btn">Create User Roles</button>
                    <button type="button" class="submit-btn close-btn" onclick="location.href='admin.php'" >Close</button>
                </div>
            </form>
        </div>
    </main>


    <script>
<script>
    document.querySelector('form').onsubmit = function(e) {
        var username = document.getElementById('role_name').value;


        // Role Name validation
        if (role_name.length < 4) {
            alert("Username must be at least 4 characters long!");
            e.preventDefault();
            return false;
        }

    };
    </script>
</script>

</body>
</html>