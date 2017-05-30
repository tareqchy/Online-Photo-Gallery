<?php
// Start Session
session_start();

// Destroy Session
session_destroy();

// Redirect to Login page
header("Location: login.php");
