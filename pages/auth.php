<?php
session_start();

/* Check login */
function checkLogin() {
    if (!isset($_SESSION['username'])) {
        header("Location: ../login.php");
        exit();
    }
}

/* Admin-only access */
function adminOnly() {
    checkLogin();

    if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
        header("Location: home.php");
        exit();
    }
}
