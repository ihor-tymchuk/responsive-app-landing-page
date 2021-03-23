<?php 
// EDIT THE 2 LINES BELOW AS REQUIRED
$send_email_to = "ihor@gib-education.com";
$email_subject = "Customer: message";
function send_email($name,$email,$email_message)
{
  global $send_email_to;
  global $email_subject;
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
  $headers .= "From: ".$email. "\r\n";
  $message = "<strong>Email = </strong>".$email."<br>";
  $message .= "<strong>Name = </strong>".$name."<br>";  
  $message .= "<strong>Message = </strong>".$email_message."<br>";
  mail($send_email_to, $email_subject, $message);
  return true;
}

function validate($name,$email,$message)
{
  $return_array = array();
  $return_array['success'] = '1';
  $return_array['name_msg'] = $name;
  $return_array['email_msg'] = $email;
  $return_array['message_msg'] = $message;
  if($email == '')
  {
    $return_array['success'] = '0';
    $return_array['email_msg'] = 'not number phone';
  }
  else
  {
    // $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(strlen($email) < 10) {
      $return_array['success'] = '0';
      $return_array['email_msg'] = 'number phone less 10 digits';  
    }
  }
  if($name == '')
  {
    $return_array['success'] = '0';
    $return_array['name_msg'] = 'not name';
  }
  else
  {
    // $string_exp = "/^[A-Za-z .'-]+$/";
    if (strlen($name)<2) {
      $return_array['success'] = '0';
      $return_array['name_msg'] = 'name less 2 letters';
    }
  }
		
  if($message == '')
  {
    $return_array['success'] = '0';
    $return_array['message_msg'] = 'not message';
  }
  else
  {
    if (strlen($message) < 2) {
      $return_array['success'] = '0';
      $return_array['message_msg'] = 'msg less 2 letters';
    }
  }
  return $return_array;
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];


$return_array = validate($name,$email,$message);

if($return_array['success'] == '1')
{
	send_email($name,$email,$message);
} 
header('Content-type: text/json');
// echo json_encode($return_array);
die();
?>

