<?

$notice = '';
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $message = trim($_POST["message"]);

        if (empty($name) || empty($email) || empty($message)) {
            throw new Exception("You must specify a value for name, email address, and message.");
        }

        foreach( $_POST as $value ){
            if (stripos($value,'Content-Type:') !== FALSE ) {
                throw new Exception("There was a problem with the information you entered.");
            }
        }

        if ($_POST["address"] != "") {
            throw new Exception("Your form submission has an error.");
        }

        require_once("include/phpmailer/class.phpmailer.php");
        $mail = new PHPMailer();

        if (!$mail->ValidateAddress($email)) {
            throw new Exception("You must specify a valid email address.");
        }

        $email_body .= "Name: " . $name . "<br>";
        $email_body .= "Email: " . $email . "<br>";
        $email_body .= "Message: " . $message;

        $mail->SetFrom($email, $name);
        $address = "orders@shirts4mike.com";
        $mail->AddAddress($address, "Shirts 4 Mike");
        $mail->Subject = "Shirts 4 Mike Contact Form Submission | " . $name;
        $mail->MsgHTML($email_body);

        if (!$mail->Send()) {
            throw new Exception("There was a problem sending the email: " . $mail->ErrorInfo);
        }

        header("Location: contact.php?status=thanks");
        exit;
    }
} catch (Exception $e) {
    $notice = $e->getMessage();
}

$pageTitle = 'Contact Mike';
$section = 'contact';

include 'include/header.php'; ?>

<div class="section page">
    <div class="wrapper">
        <h1>Contact</h1>

        <? if ($notice) { ?>
            <p><?= $notice ?></p>
        <? } elseif ("thanks" == $_GET['status']) { ?>
            <p>Thanks for the email! I&rsquo;ll be in touch shortly.</p>
        <? } else { ?>
            <p>I&rsquo;d love to hear from you! Complete the form to send me an email.</p>
            <form action="contact.php" method="post">
                <table>
                    <tr>
                        <th>
                            <label for="name">Name</label>
                        </th>
                        <td>
                            <input type="text" name="name" id="name">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="email">Email</label>
                        </th>
                        <td>
                            <input type="email" name="email" id="email">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="message">Message</label>
                        </th>
                        <td>
                            <textarea name="message" id="message"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="reason">Reason for Inquiry</label>
                        </th>
                        <td>
                            <select name="reason" id="reason">
                                <option value="business">Business</option>
                                <option value="technical">Technical</option>
                                <option value="miscellaneous">Miscellaneous</option>
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
        <? } ?>
    </div>
</div>

<? include 'include/footer.php'; ?>