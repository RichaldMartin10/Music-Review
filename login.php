<?php
// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if both username and password are provided
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Database connection
        $servername = "db"; // Docker service name
        $username = "root";
        $password = "joyel1234";
        $dbname = "music";

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Escape user inputs for security
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // Check if user exists in the database
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        // Check if user exists and if password matches
        if (mysqli_num_rows($result) == 1) {
            // Set session variables
            $_SESSION['username'] = $username;

            // Redirect user to index.html
            header("Location: index.html");
            exit();
        } else {
            // Display error message if login credentials are incorrect
            $error = "Invalid username or password";
        }

        // Close connection
        mysqli_close($conn);
    }
}
?>
