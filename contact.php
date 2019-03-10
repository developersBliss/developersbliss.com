<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <?php include 'head.php'; ?>
    <title>Contact | developersBliss</title>
</head>

<body class="singular page">
    <?php include 'header.php'; ?>
    
    <article class="page hentry">
        <div class="entry-content">
            <h1>Contact</h1>
            <p>You can leave a message using the contact form below.</p>
		<?php if(array_key_exists("error", $_REQUEST)): ?>
			<p style="color:red">The captcha you entered was incorrect.</p>
		<?php endif; ?>
            <div class="form-container">
                <div class="response"></div>
                <form class="forms" action="submit.php" method="post">
                    <fieldset>
                        <ol>
                            <li class="form-row text-input-row">
                                <input type="text" name="name" class="text-input defaultText required" title="Name (Required)"/>
                            </li>
                            <li class="form-row text-input-row">
                                <input type="text" name="email" class="text-input defaultText required email" title="Email (Required)"/>
                            </li>
                            <li class="form-row text-input-row">
                                <input type="text" name="subject" class="text-input defaultText" title="Subject"/>
                            </li>
                            <li class="form-row text-area-row">
                                <textarea name="message" class="text-area required"></textarea>
                            </li>
                            <li class="form-row hidden-row">
                                <input type="hidden" name="hidden" value="" />
                            </li>
                            <li class="button-row">
                                <?php
                                    require_once('recaptchalib.php');
                                    $publickey = "6LfaP-ISAAAAAL-Xmuc-iizb4y_bYGQ1AaQzBqWA";
                                    echo recaptcha_get_html($publickey);
                                ?>
                                <input type="submit" value="Submit" name="submit" class="btn-submit" />
                            </li>
                        </ol>
                        <input type="hidden" name="v_error" id="v-error" value="Required" />
                        <input type="hidden" name="v_email" id="v-email" value="Enter a valid email" />
                    </fieldset>
                </form>
            </div> 
        </div>
    </article>
    <?php include 'footer.php'; ?>
</body>
</html>