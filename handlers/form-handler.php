<?php
require 'class.Mailer.php';

date_default_timezone_set("Asia/Kolkata");

$mailer = new Mailer();

if (isset($_POST['subscribe'])) {

    $email = $errors = $info = null;

    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = htmlspecialchars($_POST['email']);
    } else {
        $errors = 'Please enter a valid email address.';
    }

    if (empty($errors)) {
        try {
            // Send an email to the Owner
            $subject = "New email subscriber from website";

            $markup_message = "<div style='margin:0; padding:0px; font-family:sans-serif; color:#141414 !important;'>
            <p style='margin-bottom:8px'>Hi,</p>
            <p style='margin-bottom: 10px'>
                You have received a new email subscriber from your website.</p>
            <p style='margin-bottom:10px'>
                <strong style='display:inline-block;width:140px;margin-right:10px; color:#232323 !important;'>Email address : </strong>
                    <a href='mailto:" . $email . "'>" . $email . "</a></p>
            </div>";

            // $mailer->sendMail('avidive4@gmail.com', $markup_message, $subject);

            echo json_encode(['status' => true, 'message' => 'Thank you for subscribing to our newsletter.']);
        } catch (Exception $err) {
            echo json_encode(['status' => false, 'message' => 'Something went wrong, try again later.', 'info' => $err->errorMessage()]);
        }
    } else {
        // Return validation errors
        echo json_encode(['status' => false, 'message' => $errors]);
    }
}

if (isset($_POST['submit'])) {
    $name = $email = $message = $errors = null;

    if (!empty($_POST['name'])) {
        $name = htmlspecialchars($_POST['name']);
    } else {
        $errors = 'Please enter your name. <br />';
    }

    if (!empty($_POST['email'])) {
        if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = htmlspecialchars($_POST['email']);
        } else {
            $errors .= 'Please enter a valid email address. <br />';
        }
    } else {
        $errors .= 'Please enter your email address. <br />';
    }

    if (!empty($_POST['message'])) {
        $message = htmlspecialchars(substr($_POST['message'], 0, 300));
    }

    if (empty($errors)) {
        try {

            $subject = "Enquiry From Website";

            $markup_message =
                "<div style='margin:0; padding:0px; font-family:sans-serif; color:#141414 !important;'>
                <p style='margin-bottom:8px'>Hi,</p>
                <p style='margin-bottom: 10px'>
                    You have received a new enquiry from your website.</p>
                <p style='margin-bottom:10px'>
                    <strong style='display:inline-block;width:140px;margin-right:10px; color:#232323 !important;'>Name : </strong>" . $name . "</p>
                <p style='margin-bottom:10px'>
                    <strong style='display:inline-block;width:140px;margin-right:10px; color:#232323 !important;'>Email address : </strong>
                        <a href='mailto:" . $email . "'>" . $email . "</a></p>
                <p style='margin-bottom:10px'>
                    <strong style='display:inline-block;width:140px;margin-right:10px; color:#232323 !important;'>Message : </strong>" . $message . "</p>
            </div>";

            // $mailer->sendMail('avidive4@gmail.com', $markup_message, $subject);

            echo json_encode(['status' => true, 'message' => 'Thank you for contacting us.']);
        } catch (Exception $err) {
            echo json_encode(['status' => false, 'message' => 'Something went wrong, try again later.', 'info' => $err->errorMessage()]);
        }
    } else {
        // Return validation errors
        echo json_encode(['status' => false, 'message' => $errors]);
    }
}
