<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;


class Email {
    protected $email;
    protected $nombre;
    protected $token;

    public function __construct($email, $nombre, $token) {
        $this->email = $email;
        $this->nombre = $nombre; 
        $this->token = $token;
    }

    public function enviarConfirmation() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '032466bc5f1b69';
        $mail->Password = '5cc4902647aa63';

        $mail->setFrom('cuentas@uptask.com');
        $mail->addAddress('cuentas@uptask.com');
        $mail->Subject = 'Confirm your account';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hello " . $this->email . "</strong> You have created your Do-it account, you only have to confirm it in the following link.</p>";
        $contenido .= "<p>Click here: <a href='http://localhost:3000/confirmation?token=" . 
        $this->token . "'>Confirm Account</a></p>";
        $contenido .= "<p>If you didn't create this account, you can ignore this message.</p>";
        $contenido .= '<html>';

        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();
    }

    public function enviarInstrucciones() {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '032466bc5f1b69';
        $mail->Password = '5cc4902647aa63';

        $mail->setFrom('cuentas@uptask.com');
        $mail->addAddress('cuentas@uptask.com');
        $mail->Subject = 'Reset your password';

        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hello " . $this->email . "</strong> You seem to have forgotten your password, follow the link below to retrieve it.</p>";
        $contenido .= "<p>Click here: <a href='http://localhost:3000/reset?token=" . 
        $this->token . "'>Reset Account</a></p>";
        $contenido .= "<p>If you didn't create this account, you can ignore this message.</p>";
        $contenido .= '<html>';

        $mail->Body = $contenido;

        //Enviar el email
        $mail->send();
    }
}