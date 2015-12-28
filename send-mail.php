<?php

/* ==============================================
Variables you can change - something to test with Git
============================================== */

$mailto = 'info@perigonpartners.com'; // Enter your mail addres here. 
$subject = 'Contact Us via Web'; // Enter the subject here.

$error_message = 'Error sending your message'; // Message displayed if an error occurs
$success_message = 'Message Sent'; // Message displayed if the email has been sent successfully

$human_test = true; // True / False, you want to use the "human test" or not?
$human_right_answer = '9'; // The correct answer to the question
$error_not_human = 'You\'re not human'; // Message displayed when the "human" test fails


/* ==============================================
Do not modify anything below
============================================== */

$frm_name = stripcslashes($_POST['name']);
$frm_email = stripcslashes($_POST['email']);
$frm_message = stripcslashes($_POST['message']);

if($human_test == true) {
	$frm_check = stripcslashes($_POST['check']);
	if($frm_check != $human_right_answer ) {

		echo($error_not_human);
		exit;
		 
	}
}

$message = "Name: $frm_name\r\nEmail: $frm_email\r\nMessage: $frm_message";

$headers = "From: $frm_name <$frm_email>" . "\r\n" . "Reply-To: $frm_email" . "\r\n" . "X-Mailer: PHP/" . phpversion();

function validateEmail($email) {
   if(preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email))
	  return true;
   else
	  return false;
}

if((strlen($frm_name) < 1 ) || (strlen($frm_email) < 1 ) || (strlen($frm_message) < 1 ) || validateEmail($frm_email) == FALSE ) {

	echo($error_message);

} else {

	if( mail($mailto, $subject, $message, $headers) ) {
		
		echo($success_message);

	} else {

		echo($error_message);

	}

}

?>