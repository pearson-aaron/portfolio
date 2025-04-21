<?php

/*

Thank you for choosing FormToEmail by FormToEmail.com

Version 1.9 December 31st 2006

COPYRIGHT FormToEmail.com 2003 - 2006

You are not permitted to sell this script, but you can use it, copy it or distribute it, providing that you do not delete this copyright notice, and you do not remove any reference to FormToEmail.com


You can get the Pro version of this script here: http://formtoemail.com/formtoemail_pro_version.php
---------------------------------------------------------------------------------------------------

FormToEmail-Pro Features:

Check for required fields.
Show sender's IP address.
Block IP addresses.
Check for a set cookie.
Check comments for web addresses or rude words.
Check for gobbledegook characters (Å ð ç etc).
Auto redirect to "Thank You" page.
No branding.

---------------------------------------------------------------------------------------------------


FormToEmail DESCRIPTION

FormToEmail is a contact-form processing script written in PHP. It allows you to place a form on your website which your visitors can fill out and send to you.  The contents of the form are sent to the email address (or addresses) which you specify below.  The form allows your visitors to enter their name, email address and comments.  If they try to send a blank form, they will be returned to the form.

Your visitors (and nasty spambots!) cannot see your email address!  The script cannot be hijacked by spammers.

When the form is sent, your visitor will get a confirmation of this on the screen, and will be given a link to continue to your homepage, or other page if you specify it.

Should you need the facility, you can add additional fields to your form, which this script will also process without making any additional changes to the script.  You can also use it to process other forms.  The script will handle the "POST" or "GET" methods.  It will also handle multiple select inputs and multiple check box inputs.  If using these, you must name the field as an array using square brackets, like so: <select name="fruit[]" multiple>.  The same goes for check boxes if you are using more than one with the same name, like so: <input type="checkbox" name="fruit[]" value="apple">Apple<input type="checkbox" name="fruit[]" value="orange">Orange<input type="checkbox" name="fruit[]" value="banana">Banana

This is a PHP script.  In order for it to run, you must have PHP (version 4.1.0 or later) on your webhosting account, and have the PHP mail() function enabled.  If you are not sure about this, please ask your webhost about it.

SETUP INSTRUCTIONS

Step 1: Put the form on your webpage
Step 2: Enter your email address and continue link below
Step 3: Upload the files to your webspace

Step 1:

To put the form on your webpage, copy the code below as it is, and paste it into your webpage:

<form action="FormToEmail.php" method="post">
<table border="0" bgcolor="#ececec" cellspacing="5">
<tr><td>Name</td><td><input type="text" size="30" name="name"></td></tr>
<tr><td>Email address</td><td><input type="text" size="30" name="email"></td></tr>
<tr><td valign="top">Comments</td><td><textarea name="comments" rows="6" cols="30"></textarea></td></tr>
<tr><td>&nbsp;</td><td><input type="submit" value="Send"><font face="arial" size="1">&nbsp;&nbsp;FormToEmail by <a href="http://FormToEmail.com">FormToEmail.com</a></font></td></tr>
</table>
</form>

Step 2:

Enter your email address.

Enter the email address below to send the contents of the form to.  You can enter more than one email address separated by commas, like so: $my_email = "bob@example.com,sales@example.co.uk,jane@example.com";

*/

$my_email = "pearson@hush.com";

/*

Enter the continue link to offer the user after the form is sent.  If you do not change this, your visitor will be given a continue link to your homepage.

If you do change it, remove the "/" symbol below and replace with the name of the page to link to, eg: "mypage.htm" or "http://www.elsewhere.com/page.htm"

*/

$continue = "index.html";

/*

Step 3:

Save this file (FormToEmail.php) and upload it together with your webpage to your webspace.  IMPORTANT - The file name is case sensitive!  You must save it exactly as it is named above!  Do not put this script in your cgi-bin directory (folder) it may not work from there.

THAT'S IT, FINISHED!

You do not need to make any changes below this line.

*/

//  Initialise variables

$errors = array();

if($_SERVER['REQUEST_METHOD'] == "POST"){$form_input = $_POST;}elseif($_SERVER['REQUEST_METHOD'] == "GET"){$form_input = $_GET;}else{exit;}

// Remove leading whitespace from all values.

function recursive_array_check(&$element_value)
{

if(!is_array($element_value)){$element_value = ltrim($element_value);}
else
{

foreach($element_value as $key => $value){$element_value[$key] = recursive_array_check($value);}

}

return $element_value;

}

recursive_array_check($form_input);

// Check referrer is from same site.

if(!(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) && stristr($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']))){$errors[] = "You must enable referrer logging to use the form";}

// Check for a blank form.

function recursive_array_check_blank($element_value)
{

global $set;

if(!is_array($element_value)){if(!empty($element_value)){$set = 1;}}
else
{

foreach($element_value as $value){if($set){break;} recursive_array_check_blank($value);}

}

}

recursive_array_check_blank($form_input);

if(!$set){$errors[] = "You cannot send a blank form";}

// Strip HTML tags from all fields.

function recursive_array_check2(&$element_value)
{

if(!is_array($element_value)){$element_value = strip_tags($element_value);}
else
{

foreach($element_value as $key => $value){$element_value[$key] = recursive_array_check2($value);}

}

return $element_value;

}

recursive_array_check2($form_input);

// Validate name field.

if(isset($form_input['name']) && !empty($form_input['name']))
{

if(preg_match("`[\r\n]`",$form_input['name'])){$errors[] = "You have submitted an invalid new line character";}

if(preg_match("/[^a-z' -]/i",stripslashes($form_input['name']))){$errors[] = "You have submitted an invalid character in the name field";}

}

// Validate email field.

if(isset($form_input['email']) && !empty($form_input['email']))
{

if(preg_match("`[\r\n]`",$form_input['email'])){$errors[] = "You have submitted an invalid new line character";}

if(!preg_match('/^([a-z][a-z0-9_.-\/\%]*@[^\s\"\)\?<>]+\.[a-z]{2,6})$/i',$form_input['email'])){$errors[] = "Email address is invalid";}

}

// Display any errors and exit if errors exist.

if(count($errors)){foreach($errors as $value){print "$value<br>";} exit;}

// Build message.

function build_message($request_input){if(!isset($message_output)){$message_output = "";}if(!is_array($request_input)){$message_output = $request_input;}else{foreach($request_input as $key => $value){if(!is_numeric($key)){$message_output .= "\n\n".$key.": ".build_message($value);}else{$message_output .= "\n\n".build_message($value);}}}return $message_output;}

$message = build_message($form_input);

$message = $message . "\n\n-- \nThank you for using FormToEmail from http://FormToEmail.com";

$message = stripslashes($message);

$subject = "FormToEmail Comments";

$headers = "From: " . $form_input['email'] . "\n" . "Return-Path: " . $form_input['email'] . "\n" . "Reply-To: " . $form_input['email'] . "\n";

mail($my_email,$subject,$message,$headers);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>

<head>
<title>Form To Email PHP script from FormToEmail.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body bgcolor="#ffffff" text="#000000">

<div>
<center>
<b>Thank you <?php print stripslashes($form_input['name']); ?></b>
<br>Your message has been sent
<p><a href="<?php print $continue; ?>">Click here to continue</a></p>
<p><b>FormToEmail</b> by <a href="http://FormToEmail.com">FormToEmail.com</a></p>
</center>
</div>

</body>
</html>