<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management - Login</title>

    <!-- Local CSS (no external libraries for your assignment) -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container" id="container">

        <!-- ================= SIGN UP FORM ================= -->
        <div class="form-container sign-up-container">
            <form action="register_process.php" method="POST">
                <h1>Create Account</h1>

                <span>Use your email for registration</span>

                <input type="text" name="name" placeholder="Name" required>
                <input type="email" name="email" placeholder="Email" required>

                <div class="password-container">
                    <input type="password" name="password" id="regPassword" placeholder="Password" required>
                    <i class="toggle-password" onclick="togglePassword('regPassword', this)">👁</i>
                </div>

                <button type="submit">Sign Up</button>
            </form>
        </div>

        <!-- ================= SIGN IN FORM ================= -->
        <div class="form-container sign-in-container">
            <form action="login_process.php" method="POST">
                <h1>Sign in</h1>

                <input type="email" name="email" placeholder="Email" required>

                <div class="password-container">
                    <input type="password" name="password" id="loginPassword" placeholder="Password" required>
                    <i class="toggle-password" onclick="togglePassword('loginPassword', this)">👁</i>
                </div>

                <a href="#" id="forgotPassword">Forgot your password?</a>

                <div class="remember-me">
                    <input type="checkbox" name="remember" id="rememberMe">
                    <label for="rememberMe">Remember me</label>
                </div>

                <button type="submit">Sign In</button>
            </form>
        </div>

        <!-- ================= OVERLAY SLIDER ================= -->
        <div class="overlay-container">
            <div class="overlay">

                <div class="overlay-panel overlay-left">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start your journey with us</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>

                <div class="overlay-panel overlay-right">
                    <h1>Welcome Back!</h1>
                    <p>Login with your personal info to stay connected</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>

            </div>
        </div>

    </div>

    <!-- ============= FORGOT PASSWORD MODAL ============= -->
    <div class="modal" id="forgotPasswordModal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Reset Password</h2>
            <p>Enter your email to receive a reset link.</p>

            <form action="forgot_process.php" method="POST">
                <input type="email" name="reset_email" placeholder="Email" required>
                <button type="submit">Send Reset Link</button>
            </form>
        </div>
    </div>

    <!-- Notifications -->
    <div class="notification" id="notification"></div>

    <!-- Local JavaScript -->
    <script src="js/script.js"></script>

</body>
</html>
