<?

if ("POST" == $_SERVER['REQUEST_METHOD']) {
    $emailBody = "Name: {$_POST['name']},\n
        Email: {$_POST['email']}.\n
        Message: {$_POST['message']}\n
        Reason for Inquiry: {$_POST['reason']}";
    // TODO: send email

    header('Location: contact.php?status=thanks');
    exit();
}

$pageTitle = 'Contact Mike';
$section = 'contact';
include 'include/header.php'; ?>

<div class="section page">
    <div class="wrapper">
        <h1>Contact</h1>

        <? if ("thanks" == $_GET['status']) { ?>
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

                </table>

                <input type="submit" value="Send">
            </form>
        <? } ?>

    </div>
</div>

<? include 'include/footer.php'; ?>