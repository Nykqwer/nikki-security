<?php
require_once 'dbcon.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepared statement for secure query
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $fetch = $result->fetch_assoc();

    if (!$fetch) {
        echo "<br><center><font color='red' size='3'>Invalid username or password</font></center>";
    } else {
 
      
            session_start();
            $_SESSION['id'] = $fetch['user_id'];

            $userID = $fetch['user_id']; // Extract user_id


            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'nykolopez25@gmail.com'; // Your email
                $mail->Password = 'xnyqzpvbjvsxndhg'; // Your app password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('gojostaruo@gmail.com', 'Barangay Authentication');
                $mail->addAddress('nykolopez25@gmail.com', 'adimar');

                $mail->isHTML(true);
                $verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
                $mail->Subject = 'Email Verification';
                $mail->Body = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

                $mail->send();

                // Store the verification code in the database
                $stmt = $conn->prepare("INSERT INTO verification(user_id, code) VALUES (?, ?)");
                $stmt->bind_param("is", $userID, $verification_code);
                $stmt->execute();

    
                header("location:verify.php");
                exit();
            } catch (Exception $e) {
                echo "<script>alert('Message could not be sent: {$mail->ErrorInfo}');</script>";
            }

    }
}
?>
