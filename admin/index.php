<?php
// Start the session and include any login checks if needed
session_start();

// Brute-force protection settings
$max_attempts = 5; // Maximum number of allowed attempts
$lockout_time = 60; // Lockout time in seconds

// Initialize session variables for brute force protection
if (!isset($_SESSION['failed_attempts'])) {
    $_SESSION['failed_attempts'] = 0;
}
if (!isset($_SESSION['lockout_time'])) {
    $_SESSION['lockout_time'] = 0;
}

// Check if user is locked out
if (time() < $_SESSION['lockout_time']) {
    $remaining_time = $_SESSION['lockout_time'] - time();
    echo "You are locked out. Please try again after <span id='remaining-time'>$remaining_time</span> seconds.";
    echo "<script>
        let remainingTime = $remaining_time;

        // Function to update the countdown timer
        function updateTimer() {
            if (remainingTime > 0) {
                remainingTime--;
                document.getElementById('remaining-time').textContent = remainingTime;
            } else {
                // Redirect when the timer reaches zero
                window.location.href = 'candidate.php';
            }
        }

        // Update the timer every second
        setInterval(updateTimer, 1000);
    </script>";
    exit();
}

?>

<?php include('head.php'); ?>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<body>
    <div class="container">
        <div class="row">
            <center><h3>Voting System - Admin Panel</h3></center>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <center><h3 class="panel-title">Admin Log In</h3></center>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post">
                            <fieldset>
                                <!-- Username input -->
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input class="form-control" placeholder="Please Enter your Username" name="username" type="text" autofocus required>
                                </div>

                                <!-- Password input -->
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                </div>

                                <!-- reCAPTCHA -->
                                <div class="g-recaptcha" data-sitekey="6LfYKG8qAAAAACMRyvdGwsSRzkqRx6tNdaLJEeGl"></div>
                                <br/>

                                <!-- Login button -->
                                <button class="btn btn-lg btn-success btn-block" name="login">Login</button>
                            </fieldset>
                        </form>

                        <?php
                        // Login logic
                        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
                            include('login_query.php'); // Assume this processes login and returns success or failure

                            // Simulated login validation (replace with actual validation logic)
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $login_successful = false; // Replace with actual check

                            if ($login_successful) {
                                // Reset failed attempts on successful login
                                $_SESSION['failed_attempts'] = 0;
                                echo "Login successful! Redirecting...";
                                // Add your redirection or session handling here
                            } else {
                                $_SESSION['failed_attempts']++;
                                $remaining_attempts = $max_attempts - $_SESSION['failed_attempts'];

                                if ($_SESSION['failed_attempts'] >= $max_attempts) {
                                    $_SESSION['lockout_time'] = time() + $lockout_time;
                                    echo "Too many failed attempts. You are locked out for $lockout_time seconds.";
                                    echo "<script>
                                        setTimeout(function() {
                                            window.location.href = 'index.php';
                                        }, " . ($lockout_time * 1000) . ");
                                    </script>";
                                    exit();
                                } else {
                                    echo "Invalid credentials. Attempt " . $_SESSION['failed_attempts'] . " of $max_attempts. You have $remaining_attempts attempt(s) remaining.";
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include('script.php'); ?>

</body>
</html>
