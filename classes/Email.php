<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {

    public $email;
    public $nombre;
    public $token;

public function __construct($email, $nombre, $token)
{
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;

}


    public function enviarConfirmacion(){

        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c1193730885391';
        $mail->Password = 'f0bf091399734c';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('mamarrenopal@gmail.com', 'AppSalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->email . "</strong> Has creado tu cuenta en AppSalon, solo debes confirmar en el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a>";
        $contenido .= "<p>Si tu no has creado esta cuenta, puedes ignorar el mensaje.</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();

    }

    public function enviarInstrucciones(){
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = 'c1193730885391';
        $mail->Password = 'f0bf091399734c';

        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('mamarrenopal@gmail.com', 'AppSalon.com');
        $mail->Subject = 'Reestablace tu contraseña';

        //Set HTML
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = '<html>';
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu contraseña, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Reestablecer contraseña</a>";
        $contenido .= "<p>Si tu no has pedido cambiar contraseña, puedes ignorar el mensaje.</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();
    }
}