<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "jaop.7@outlook.com";
    $email_subject = "Solicitud de informacion en Página de Gluck";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['email']) ||
        !isset($_POST['message']) ||
        !isset($_POST['eventDate'])) {
        died('Parece que faltó de llenar alguno de los campos.');       
    }
 
     
 
    $name = $_POST['name']; // required
    $phone = $_POST['phone']; // required
    $email_from = $_POST['email']; // required
    $message = $_POST['message']; // not required
    $eventDate = $_POST['eventDate']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
//   if(!preg_match($string_exp,$last_name)) {
//     $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
//   }
 
//   if(strlen($comments) < 2) {
//     $error_message .= 'The Comments you entered do not appear to be valid.<br />';
//   }
 
//   if(strlen($error_message) > 0) {
//     died($error_message);
//   }
 
    $email_message = "Datos enviados en forma de Página:.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Nombre: ".clean_string($name)."\n";
    $email_message .= "Teléfono: ".clean_string($phone)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Mensaje: ".clean_string($message)."\n";
    $email_message .= "Fecha: ".clean_string($eventDate)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Gracias por contactarnos, nos pondremos en contacto contigo muy pronto. :)
 
<?php
 
}
?>
