<?php
// 1. Load the database connection first
require_once '../../config.php'; 

// 2. Load auth.php
require_once '../auth.php'; 
adminOnly();

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Safety check: verify both keys are present
    if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
        
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $role_id  = mysqli_real_escape_string($conn, $_POST['role_id']);
        $password = $_POST['password'];
        $confirm  = $_POST['confirm_password'];

        if ($password !== $confirm) {
            echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
            exit();
        }

        // ... Proceed to hash and insert into database
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, Role_Id) VALUES ('$username', '$hashed_pass', '$role_id')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('User Created Successfully!'); window.location.href='../admin.php';</script>";
        }
    } else {
        // This will trigger if the HTML 'name' attribute is missing/wrong
        echo "Error: Form data missing. Check your input names.";
    }
}

// Fetch roles for the dropdown using $conn
$role_query = "SELECT role_id, role_name FROM roles ORDER BY role_name ASC";
$role_result = mysqli_query($conn, $role_query);

$roles_list = array();
if ($role_result && mysqli_num_rows($role_result) > 0) {
    while ($row = mysqli_fetch_assoc($role_result)) {
        $roles_list[] = $row;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create New User</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="create-user-page">

    <header class="header-section">
        <nav class="nav-left">
            <a href="../admin.php" class="nav-link">
                <span class="icon">&#8592;</span> BACK TO LIST
            </a>
        </nav>
        <div class="nav-center"><h2>CREATE NEW USER</h2></div>
        <div class="nav-right">
            <span class="user-display"><span class="icon">&#128100;</span> Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span>
        </div>
    </header>

    <main class="form-wrapper">
        <div class="glass-card">
            <form action="" method="POST">
                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Enter username" required>
                </div>

                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" id="pass" placeholder="Enter password" required>
                </div>

                <div class="input-group">
                    <label>Confirm Your Password</label>
                    <input type="password" name="confirm_password" id="confirm_pass" placeholder="Enter your password again" required>
                </div>

                <div class="input-group">
                    <label>Assign Role</label>
                        <select name="role_id" class="drop-down-active" required>
                            <option value="" disabled selected>-- Select a Role --</option>
    
                            <?php 
                            if (!empty($roles_list)) {
                                foreach ($roles_list as $role) {
                                    echo '<option value="' . $role['role_id'] . '">' . htmlspecialchars($role['role_name']) . '</option>';
                                }
                            }
                            ?>
                        </select>
                </div>

                <button type="submit" class="submit-btn">CREATE AN USER</button>
            </form>
        </div>
    </main>


    <script>
    document.querySelector('form').onsubmit = function(e) {
    var pass = document.getElementById('pass').value;
    var confirm = document.getElementById('confirm_pass').value;

    if (pass !== confirm) {
        alert("Passwords do not match!");
        e.preventDefault(); // Stops the form from submitting
        return false;
    }
};</script>

</body>
</html>