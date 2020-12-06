<?php
//DEBUG ONLY, remove it after
//ini_set('display_errors', 0);

//4*. It returns proper info in JSON format[Receipts!]
//   a. What is AJAX?
//   b. What is JSON?
//   c. How to build JSON (in PHP)
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json; charset=UTF-8');

//TODO:Take care the form submission [Work as the post office]
//1. Check the submission --> Validare the data [Is there "non-mailable" items??]
//2. Prepare the email[Print out the label and put on the package / prepare the package in certain format]
//3. Send out the email [Send out the package]

$results = [
    'test_key1'=>'test_value_1',
    'test_key2'=>'test_value_2',
];
$visitor_name = '';
$visitor_email = '';
$visitor_message = '';
$visitor_goal = '';

//1. Check the submission
// $_POST['firstname]

if (isset($_POST['firsttname'])) {
    $visitor_name = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
}

if (isset($_POST['lastname'])) {
    $visitor_name .= ' '.filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
}

if (isset($_POST['email'])) {
    $visitor_email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
}

if (isset($_POST['message'])) {
    $visitor_message = filter_var(htmlspecialchars($_POST['message']), FILTER_SANITIZE_STRING);
}
if (isset($_POST['goal'])) {
    $visitor_goal = filter_var($_POST['goal'], FILTER_SANITIZE_EMAIL);
}



$results['name'] = $visitor_name;
$results['message'] = $visitor_message;

//2. Prepare the email
$email_subject = 'Inquiry from Portfolio Site';
$email_recipient = 'test@junhwa1207@gmail.com';//Your Email, or AKA, 'To email
$email_message = sprintf('Name: %s, Email: %s, Message: %s', $visitor_name, $visitor_email, $visitor_message, $visitor_goal);

//Make sure you run the code in PHP 7.4 +

//Otherwise, you would need to make $email_headers as string https://www.php.net/manual/en/function..mail.php
$email_headers = array(
    //Best Practice, but it may need you to have a mail set up in noreply@yourdomain.ca
    //'From'=> 'noreply@yourdomain.ca',
    //'Reply-To'=>$visitor_email,
    'From'=>$visitor_email //
);

//3. Send out the email

// $email_result = mail($email_recipient, $email_subject, $email_message, $email_headers);
// if ($email_result) {
//     $results['message'] = sprintf('Thank you for contacting us, %s. You will get a reply within 24 hours.', $visitor_name);
// } else {
//     $results['message'] = sprintf('We are sorry but the email did not go through.');
// }



$email_result = mail($email_recipient, $email_subject, $email_message, $email_headers);
if ($email_result) {
    $results['message'] = sprintf('Thank you for contacting us, %s. You will get a reply within 24 hours.', $visitor_name);
}
if (empty($_POST['firstname'])) {
    $results['message'] = sprintf('First Name is Required');
}
if (empty($_POST['lastname'])) {
    $results['message'] = sprintf('Last Name is Required');
}
if (empty($_POST['email'])) {
    $results['message'] = sprintf('Email is Required');
}

echo json_encode($results);
