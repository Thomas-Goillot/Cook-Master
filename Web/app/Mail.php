<?php 

namespace App;

use PHPMailer\PHPMailer\PHPMailer;

class Mail { 

    private $mail;

    public function __construct() {

        include_once('config/mail.php');

        $this->mail = new PHPMailer(true);

        $this->mail->isSMTP();

        $this->mail->Host = MAIL_HOST;

        $this->mail->SMTPAuth = MAIL_SMTPAUTH;

        $this->mail->Username = MAIL_USERNAME;

        $this->mail->Password = MAIL_PASSWORD;

        $this->mail->SMTPSecure = MAIL_SMTPSECURE;

        $this->mail->Port = MAIL_PORT;

        $this->mail->SMTPDebug = MAIL_DEBUG;

        $this->mail->setFrom(MAIL_USERNAME, MAIL_FROMNAME);      
        
    }

    public function send($to, $subject, $body) {

        $this->mail->addAddress($to);

        $this->mail->isHTML(true);

        $this->mail->Subject = $subject;

        $this->mail->Body = $body;

        $this->mail->send();

    }


}

