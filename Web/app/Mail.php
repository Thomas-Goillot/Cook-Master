<?php

namespace App;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class Mail
{

    private $mail;

    public function __construct()
    {

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

    /**
     * Send email
     *
     * @param string $to
     * @param string $subject
     * @param string $body
     * @return void
     */
    public function send(string $to, string $subject, string $body): void
    {

        try {

            $this->mail->addAddress($to);

            $this->mail->isHTML(true);

            $this->mail->Subject = $subject;

            $this->mail->Body = $body;

            $this->mail->send();
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
