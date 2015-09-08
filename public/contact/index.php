<?php
require_once '../include/config.php';

/* This file contains instructions for three different states of the form:
 *   - Displaying the initial contact form
 *   - Handling the form submission and sending the email
 *   - Displaying a thank you message
 */

$notice = $name = $email = $message = $reason = "";

try {

    // a request method of post indicates that
    // we are receiving a form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // the form has fields for name, email, message and sending reason
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $message = trim($_POST["message"]);
        $reason = trim($_POST["reason"]);

        // the fields name, email, and message are required
        if (empty($name) || empty($email) || empty($message)) {
            throw new Exception("You must specify a value for name, email address, and message.");
        }

        // this code checks for malicious code attempting
        // to inject values into the email header
        foreach ($_POST as $value) {
            if (stripos($value,'Content-Type:') !== FALSE ) {
                throw new Exception("There was a problem with the information you entered.");
            }
        }

        // the field named address is used as a spam honeypot
        // it is hidden from users, and it must be left blank
        if ($_POST["address"] != "") {
            throw new Exception("Your form submission has an error.");
        }

        require_once ROOT_PATH . 'include/phpmailer/class.phpmailer.php';
        $mail = new PHPMailer();

        if (!$mail->ValidateAddress($email)) {
            throw new Exception("You must specify a valid email address.");
        }

        // let's send the email
        $email_body .= "Name: " . $name . "<br>";
        $email_body .= "Email: " . $email . "<br>";
        $email_body .= "Message: " . $message;

        $mail->SetFrom($email, $name);
        $address = "orders@shirts4mike.com";
        $mail->AddAddress($address, "Shirts 4 Mike");
        $mail->Subject = "Shirts 4 Mike Contact Form Submission | " . $name;
        $mail->MsgHTML($email_body);

        // TODO: Send email
        if (!$mail->Send()) {
            throw new Exception("There was a problem sending the email: " . $mail->ErrorInfo);
        }

        $notice = "Thanks for the email! I&rsquo;ll be in touch shortly.";
    }
} catch (Exception $e) {
    $notice = $e->getMessage();
}

$pageTitle = 'Contact Mike';
$section = 'contact';

include ROOT_PATH . 'include/header.php'; ?>

<div class="section page">
    <div class="wrapper">
        <h1>Contact</h1>
        <? if ($notice) { ?>
            <p class="message"><?= $notice ?></p>
        <? } else { ?>
            <p>I&rsquo;d love to hear from you! Complete the form to send me an email.</p>
        <? } ?>

        <form action="<?= BASE_URL ?>contact/" method="post">
            <table>
                <tr>
                    <th>
                        <label for="name">Name</label>
                    </th>
                    <td>
                        <input type="text" name="name" id="name" value="<?= $name ? htmlspecialchars($name) : '' ?>">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="email">Email</label>
                    </th>
                    <td>
                        <input type="email" name="email" id="email" value="<?= $email ? htmlspecialchars($email) : '' ?>"">
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="message">Message</label>
                    </th>
                    <td>
                        <textarea name="message" id="message"><?= $message ? htmlspecialchars($message) : ''?></textarea>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="reason">Reason for Inquiry</label>
                    </th>
                    <td>
                        <select name="reason" id="reason">
                            <option value="business" <?= 'business' === $reason ? 'selected' : '' ?>>Business</option>
                            <option value="technical" <?= 'technical' === $reason ? 'selected' : '' ?>>Technical</option>
                            <option value="miscellaneous" <?= 'miscellaneous' === $reason ? 'selected' : '' ?>>Miscellaneous</option>
                        </select>
                    </td>
                </tr>

                <? // honeypot for spambots ?>
                <tr style="display: none;">
                    <th>
                        <label for="address">Address</label>
                    </th>
                    <td>
                        <input type="text" name="address" id="address">
                        <p>Humans (and frogs): please leave this field blank.</p>
                    </td>
                </tr>

            </table>

            <input type="submit" value="Send">
        </form>
    </div>
</div>

<? include ROOT_PATH . 'include/footer.php'; ?>