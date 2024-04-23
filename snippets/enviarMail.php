<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
$destino;
if (!isset($_SESSION))
    session_start();

function enviarMail($destinatario, $nombre, $asunto, $cuerpoHtml, $cuerpoPlano, $mailCopia, $alertaExito, $alertaError){
    try {
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'veterinariasananton237@gmail.com';
        $mail->Password   = 'bgwo fgaw muxi pujq';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        //Destinatarios
        $mail->setFrom('veterinariasananton237@gmail.com', 'Veterinaria San Antón');
        $mail->addAddress($destinatario, $nombre);
        if (isset($mailCopia))
            $mail->addCC($mailCopia);

        //Contenido
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body    = $cuerpoHtml;
        $mail->AltBody = $cuerpoPlano;

        $mail->send();

        $_SESSION['alerta'] = $alertaExito;

    } catch (Exception $e) {
        $_SESSION['alerta'] = $alertaError;
        $_SESSION['icono_alerta'] = 'error';
    }
}



switch ($_POST['operacion']) {
    case 'recuperarClave':
        
        break;

    case 'consulta':
        if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['codArea']) && isset($_POST['telefono']) && isset($_POST['motivo']) && isset($_POST['problema']))
        {
            $destinatario = 'veterinariasananton237@gmail.com';
            $nombre = 'Veterinaria San Antón';
            $asunto = 'Consulta';
            
            $cuerpoHtml = "<p>Hola $_POST[nombre] $_POST[apellido], somos Veterinaria San Antón!</p>";
            $cuerpoHtml .= "<p>Recibimos su consulta sobre <b>$_POST[motivo]</b>. Nos comunicaremos con usted en breve</p>";
            $cuerpoHtml .= "<p>El número de teléfono que nos suministró es: $_POST[codArea]-$_POST[telefono]</p><br>";
            $cuerpoHtml .= "<h3>Su consulta</h3>";
            $cuerpoHtml .= "<p>$_POST[problema]</p>";
            
//direccion codigo postal y ciudad están disponibles tambien


            $cuerpoPlano = "Nombre y apellido: $_POST[nombre] $_POST[apellido]\n";
            $cuerpoPlano .= "Teléfono: $_POST[codArea]-$_POST[telefono]\n\n";
            $cuerpoPlano .= "Motivo consulta: $_POST[motivo]\n";
            $cuerpoPlano .= "Problema: $_POST[problema]";


            $mailCopia = $_POST['email'];
            $alertaExito = 'Consulta enviada con éxito. Recibirá una copia en su casilla de correo.';
            $alertaError = 'No se pudo enviar la consulta';
            $destino = '../nuestraUbicacion.php';
            enviarMail($destinatario, $nombre, $asunto, $cuerpoHtml, $cuerpoPlano, $mailCopia, $alertaExito, $alertaError);
        }
        else
        {
            $_SESSION['alerta'] = 'No se pudo enviar la consulta';
            $_SESSION['icono_alerta'] = 'error';
        }
        break;

    case 'informeGastos':
        
        break;
}



header('Location:' . $destino);
die();