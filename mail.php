<?php
//connecting to db
include "connection.php";
?>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
									
	$mail->isSMTP();											
	$mail->Host	 = 'smtp.gmail.com;';					
	$mail->SMTPAuth = true;							
	$mail->Username = 'surajnaruka4@gmail.com';				
	$mail->Password = '63635787@@';						
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 587;

	$mail->setFrom("surajnaruka4@gmail.com");		
    $sql1 = "SELECT * FROM `customers` WHERE send_email=1";
    $result1 = mysqli_query($conn, $sql1); 
	if(mysqli_num_rows($result1) > 0){
        $mail->addReplyTo("surajnaruka4@gmail.com");

        while($x=mysqli_fetch_assoc($result1)){
            $mail->addBCC($x['email']);
        }

        $mail->isHTML(true);								
	$mail->Subject = 'Error Technologies';
	$mail->Body = '<strong>Account Was Successfully
    Created For Your Email</strong>';
	$mail->AltBody = 'Account Was Successfully
    Created For Your Email';
	if($mail->send())
    {
        echo "Email Sended Successfully";
    }
    else{
        echo "failed";
    }
    }
  
	else{
        echo "no data found";
    }


?>
