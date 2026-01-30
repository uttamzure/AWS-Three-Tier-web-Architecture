<?php
// Database configuration
$servername = "database-1.c7i28u2gwg4n.us-west-1.rds.amazonaws.com";
$username   = "root";        // change if needed
$password   = "admin#123";            // change if needed
$dbname     = "Three_tier_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<div style='
        display:flex; justify-content:center; align-items:center; height:100vh;
        font-family: Arial, sans-serif; font-size:24px; color:#fff;
        background: linear-gradient(135deg, #ff4e50, #f9d423);
        text-align:center; padding:20px; border-radius:12px;
    '>Connection failed: " . $conn->connect_error . "</div>");
}

// Check if form data is received
if (isset($_POST['name']) && isset($_POST['city'])) {

    $name = $_POST['name'];
    $city = $_POST['city'];

    // Prepare SQL statement (prevents SQL injection)
    $stmt = $conn->prepare("INSERT INTO users (name, city) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $city);

    if ($stmt->execute()) {
        echo "<div style='
            display:flex; justify-content:center; align-items:center; height:100vh;
            font-family: Arial, sans-serif; font-size:32px; color:#fff;
            background: linear-gradient(135deg, #43cea2, #185a9d);
            text-align:center; padding:30px; border-radius:12px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        '>✅ Data inserted successfully!</div>";
    } else {
        echo "<div style='
            display:flex; justify-content:center; align-items:center; height:100vh;
            font-family: Arial, sans-serif; font-size:32px; color:#fff;
            background: linear-gradient(135deg, #ff416c, #ff4b2b);
            text-align:center; padding:30px; border-radius:12px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.3);
        '>❌ Error inserting data.</div>";
    }

    $stmt->close();
} else {
    echo "<div style='
        display:flex; justify-content:center; align-items:center; height:100vh;
        font-family: Arial, sans-serif; font-size:32px; color:#fff;
        background: linear-gradient(135deg, #f7971e, #ffd200);
        text-align:center; padding:30px; border-radius:12px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    '>⚠️ Invalid request.</div>";
}

// Close connection
$conn->close();
?>