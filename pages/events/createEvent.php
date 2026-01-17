<?php
// 1. Load the database connection first
require_once '../../config.php'; 

// 2. Load auth.php
require_once '../auth.php'; 
eventManagerOnly();

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Safety check: verify both keys are present
    if (isset($_POST['password']) && isset($_POST['confirm_password'])) {
        
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $role_id  = mysqli_real_escape_string($conn, $_POST['role_id']);
        $password = $_POST['password'];
        $confirm  = $_POST['confirm_password'];

        // --- CHARACTER VALIDATIONS ---
        if (strlen($username) < 4) {
            echo "<script>alert('Username must be at least 4 characters long!'); window.history.back();</script>";
            exit();
        }
        elseif (strlen($password) < 8) {
            echo "<script>alert('Password must be at least 8 characters long!'); window.history.back();</script>";
            exit();
        }
        elseif ($password !== $confirm) {
            echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
            exit();
        }

        // ... Password convert to hash and insert into database
        $hashed_pass = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, Role_Id) VALUES ('$username', '$hashed_pass', '$role_id')";
        
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('User Created Successfully!'); window.location.href='admin.php';</script>";
        }
    } else {
        // This will trigger if the HTML 'name' attribute is missing/wrong
        echo "Error: Form data missing. Check your input names.";
    }
}

// Fetch roles for the dropdown using db
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
    <title>Create New Event</title>
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="create-user-page">

    <header class="header-section">
        <nav class="nav-left">
            <a href="events.php" class="nav-link">
                <span class="icon">&#8592;</span> BACK TO LIST
            </a>
        </nav>
        <div class="nav-center"><h2>CREATE NEW EVENT</h2></div>
        <div class="nav-right">
            <span class="user-display"><span class="icon">&#128100;</span> Welcome, <strong><?php echo $_SESSION['username']; ?></strong></span>
        </div>
    </header>

    <main class="form-wrapper">
        <div class="glass-card">
            <form action="" method="POST">
                <div class="input-group">
                    <label>Code</label>
                    <input type="text" name="code" id="code" placeholder="Enter Event Code" required>
                </div>

                <div class="input-group">
                    <label>Title</label>
                    <input type="text" name="title" id="title" placeholder="Enter Event Title" required>
                </div>

                <div class="input-group">
                    <label>Venue</label>
                    <input type="text" name="venue" id="venue" placeholder="Enter Event Venue" required>
                </div>

                <div class="input-group">
                    <label>City</label>
                    <input type="text" name="city" id="city" placeholder="Enter Event City" required>
                </div>

                <div class="input-group">
                    <label>Date</label>
                    <input type="text" name="date" id="date" placeholder="Enter Event Date" required>
                </div>

                <div class="input-group">
                    <label>Start Time</label>
                    <input type="text" name="username" id="username" placeholder="Min 4 characters" required>
                </div>

                <div class="input-group">
                    <label>End Time</label>
                    <input type="text" name="username" id="username" placeholder="Min 4 characters" required>
                </div>

                <div class="input-group">
                    <label>Assign Event Type</label>
                    <input type="text" name="username" id="username" placeholder="Min 4 characters" required>
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

                <div class="button-row">
                    <button type="submit" class="submit-btn">Create an Event</button>
                    <button type="button" class="submit-btn close-btn" onclick="location.href='events.php'" >Close</button>
                </div>
            </form>
        </div>
    </main>


    <script>

<script>
    document.querySelector('form').onsubmit = function(e) {
        var username = document.getElementById('username').value;
       
        // Username validation
        if (username.length < 4) {
            alert("Username must be at least 4 characters long!");
            e.preventDefault();
            return false;
        }
    };
    </script>
</script>

</body>
</html>