<DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Contact Form</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="./styles.css" />
    </head>

    <body>
        <div id="ServerInfoBox">
            <?php
                function printServerInfo() {
                    echo "<strong>Server Info</strong>";
                    echo "<br>";
                    echo "<br>";
                    echo "File Name: " . $_SERVER['PHP_SELF'];
                    echo "<br>";
                    echo "Host Header: " . $_SERVER['HTTP_HOST'];
                    echo "<br>";
                    echo "Completer URL: " . $_SERVER['HTTP_REFERER'];
                    echo "<br>";
                    echo "User Agent: " . $_SERVER['HTTP_USER_AGENT'];
                    echo "<br>";
                    echo "Script Name: " . $_SERVER['SCRIPT_NAME'];
                    echo "<br>";
                    echo "Version of The Common Gateway Interface: " . $_SERVER['GATEWAY_INTERFACE'];
                    echo "<br>";
                    echo "Server Address: " . $_SERVER['SERVER_ADDR'];
                    echo "<br>";
                    echo "Server Software: " . $_SERVER['SERVER_SOFTWARE'];
                    echo "<br>";
                    echo "Server Protocol: " . $_SERVER['SERVER_PROTOCOL'];
                }

                printServerInfo();
            ?>
        </div>

        <div id="ContactFormBox">

        <?php
                $full_name_err = $email_err = $phone_number_err = $subject_err = $message_err = "";

                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    
                    if (empty($_POST["full-name"])) {
                        $full_name_err = "Name is required";
                    } else {
                        $full_name = test_input($_POST["full-name"]);

                        // check if name only contains letters and whitespace
                        if (!preg_match("/^[a-zA-Z-' ]*$/",$full_name)) {
                            $full_name_err = "Only letters and white space allowed";
                        }
                    }

                    if (empty($_POST["email"])) {
                        $email_err = "Email is required";
                    } else {
                        $email = test_input($_POST["email"]);

                        // check if e-mail address is well-formed
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $email_err = "Invalid email format";
                        }
                    }

                    if (empty($_POST["phone-number"])) {
                        $phone_number_err = "Phone number is required";
                    } else {
                        $phone_number = test_input($_POST["phone-number"]);

                        // check if phone number syntax is valid
                        if (!preg_match("/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/", $phone_number)) {
                            $phone_number_err = "Invalid phone number";
                        }
                    }

                    if (empty($_POST["subject"])) {
                        $subjec_err = "";
                    } else {
                        $subject = test_input($_POST["subject"]);
                    }
                    
                    if (empty($_POST["message"])) {
                        $message_err = "Message is required";
                    } else {
                        $message = test_input($_POST["message"]);
                    }

                    $time = test_input(date("Y/m/d"));

                }
            ?>

            <h1>Send Us Your Message</h1>

            <form id="ContactForm" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <label for="full-name" id="full-name-label">Full Name</label>
                <input type="text" id="full-name" name="full-name" placeholder="Enter your name" required>
                <span class="error">* <?php echo $full_name_err;?></span>

                <label for="email" id="number-label">Email</label>
                <input type="text" id="email" name="email" placeholder="Enter your email address" required>
                <span class="error">* <?php echo $email_err;?></span>

                <label for="phone-number" id="phone-number-label">Phone Number</label>
                <input type="text" id="phone-number" name="phone-number" placeholder="Enter your phone number" required>
                <span class="error">* <?php echo $phone_number_err;?></span>

                <label for="subject" id="subject-label">Subject</label>
                <input type="text" id="subject" name="subject" placeholder="Enter the subject" required>
                <span class="error">* <?php echo $subject_err;?></span>

                <label for="message" id="message-label">Message</label>
                <textarea type="text" id="message" name="message" placeholder="Enter your message"></textarea>
                <span class="error">* <?php echo $message_err;?></span>

                <button type="submit" name="submitBtn">Submit</button>

            </form>
        
        </div>

        <div id="InputBox">
            <h1>Input Information</h1>
            <p><strong>Full Name: </strong><?php echo $full_name ?></p>
            <p><strong>Email: </strong><?php echo $email ?></p>
            <p><strong>Phone Number: </strong><?php echo $phone_number ?></p>
            <p><strong>Subject: </strong><?php echo $subject ?></p>
            <p><strong>Message: </strong><?php echo $message ?></p>
            <p><strong>Time: </strong><?php echo $time ?></p>
        </div>

    </body>
</html>
