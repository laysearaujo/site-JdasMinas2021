<?php


if(isset($_POST['email'])) {
	
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "gamejamdasminas@gmail.com";
    $email_subject = "[GJM 2020] - GAME JAM DAS MINAS -";
 
    
 
    // validation expected data exists
    if(!isset($_POST['email']) ||
        !isset($_POST['name']) ||       
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $name = $_POST['name']; // required    
    $email_from = $_POST['email']; // required
    $message = $_POST['message']; // not required
    
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
 
 
 
  if(strlen($message) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Nome: ".clean_string($name)."\n"; 
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Mensagem: ".clean_string($message)."\n";
    
 
    // create email headers
    $headers =  "Content-Type:text/html; charset=UTF-8\n";
    $headers .= "From:  jamdasminas.com.br<gamejamdasminas@gmail.com>\n"; 
    //Vai ser //mostrado que  o email partiu deste email e seguido do nome
    $headers .= "X-Sender:  <gamejamdasminas@gmail.com>\n"; 
    //email do servidor //que enviou
    $headers .= "X-Mailer: PHP  v".phpversion()."\n";
    $headers .= "X-IP:  ".$_SERVER['REMOTE_ADDR']."\n";
    $headers .= "Return-Path:  <gamejamdasminas@gmail.com>\n"; 
    //caso a msg //seja respondida vai para  este email.
    $headers .= "MIME-Version: 1.0\n";

// $headers = 'From: '.$email_from."\r\n".
// 'Reply-To: '.$email_from."\r\n" .
// 'X-Mailer: PHP/' . phpversion();
    $emailsTo="gamejamdasminas@gmail.com"; 	
     
    @mail($emailsTo, $email_subject, $email_message, $headers);  
    

?>
 
<!-- include your own success html here -->
 
Agradecemos sua mensagem. Muito em breve entraremos em contato!
 
<?php
 
}
?>

