<?php 
include('head.php'); 
session_start(); // Ensure session is started
?>

<body>
    <div class="container">
        <div class="row">
            <center><h3>Voting System - Admin Panel</h3></center>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <center><h3 class="panel-title">Verify Email</h3></center>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <!-- Code input -->
                                <div class="form-group">
                                    <center><label for="verification_code">Enter Verification Code</label></center>
                                    <input class="form-control" placeholder="Enter the verification code" name="verification_code" type="text" required>
                                </div>

                                <!-- Verify button -->
                                <button class="btn btn-lg btn-success btn-block" name="verify">Verify</button>
                            </fieldset>
                        </form>
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['verify'])) {
                            require_once 'dbcon.php';

                            // Ensure user ID is available in session
                            if (!isset($_SESSION['id'])) {
                                echo "<script>alert('Session expired. Please log in again.');</script>";
                                header("location: index.php");
                                exit();
                            }

                            $id = $_SESSION['id'];
                            $entered_code = htmlspecialchars(trim($_POST['verification_code']));

                            // Debugging: Show raw entered code
                            echo "<center><font color='blue'>Raw Entered Code: " . htmlspecialchars($entered_code) . "</font></center>";

                            // Ensure both codes are integers
                            $entered_code = (int) $entered_code;

                            // Fetch the verification code securely
                            $stmt = $conn->prepare("SELECT code FROM verification WHERE user_id = ?");
                            if ($stmt) {
                                $stmt->bind_param("i", $id);
                                $stmt->execute();
                                $stmt->store_result();

                                // Check if a record was found
                                if ($stmt->num_rows > 0) {
                                    $stmt->bind_result($db_code);
                                    $stmt->fetch();

                                    // Debugging: Show raw database code
                                    echo "<center><font color='blue'>Raw Database Code: " . htmlspecialchars($db_code) . "</font></center>";

                                    // Ensure database code is also treated as an integer
                                    $db_code = (int) $db_code;

                            

                                    // Compare entered code with the database code
                                    if ($entered_code === $db_code) {
                                           // Delete the verification code from the database after successful verification
                                    $delete_stmt = $conn->prepare("DELETE FROM verification WHERE user_id = ?");
                                    $delete_stmt->bind_param("i", $id);
                                    $delete_stmt->execute();
                                    $delete_stmt->close();
                                        header("location: candidate.php");
                                        exit();
                                    } else {
                                        echo "<center><font color='red' size='3'>Invalid verification code. Please try again.</font></center>";
                                    }
                                } else {
                                    echo "<center><font color='red' size='3'>Verification code not found for this user.</font></center>";
                                }

                                $stmt->close();
                            } else {
                                echo "<script>alert('Database error: Unable to prepare statement.');</script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
