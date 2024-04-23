<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once '../vendor/autoload.php';
require_once '../consultasdb/connection.php';

$destino;
if (!isset($_SESSION))
    session_start();


function buscarUsuario($correo){

    $query = "SELECT id, nombre, apellido FROM clientes WHERE email = '$correo'";
    $resultados = consultaSQL($query);

    if (mysqli_num_rows($resultados) == 1)
    {
        $rta = mysqli_fetch_array($resultados);
        $rta['tipoUsuario'] = 'cliente';
        return $rta;
    }
    
    $query = "SELECT id, nombre, apellido FROM personal WHERE email = '$correo'";
    $resultados = consultaSQL($query);

    if (mysqli_num_rows($resultados) == 1)
    {
        $rta = mysqli_fetch_array($resultados);
        $rta['tipoUsuario'] = 'personal';
        return $rta;
    }
    
    return null;
}


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
        $_SESSION['icono_alerta'] = 'success';

    } catch (Exception $e) {
        $_SESSION['alerta'] = $alertaError;
        $_SESSION['icono_alerta'] = 'error';
        header('Location:' . $destino);
        die();
    }
}



switch ($_POST['operacion'])
{
    case 'recuperarClave':
        $destino = '../index.php';

        if (isset($_POST['correo']))
        {
            $datosUsuario = buscarUsuario($_POST['correo']);

            if ($datosUsuario)
            {
                $alfabeto = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $codigo = '';
        
                for($i = 0; $i < 10; $i++)
                   $codigo .= $alfabeto[rand(0, 61)];
        
                $enlace = $rutaInicio . "restablecerClave.php?c=$codigo&i=$datosUsuario[id]";


                $destinatario = $_POST['correo'];
                $nombre = "$datosUsuario[nombre] $datosUsuario[apellido]";
                $asunto = 'Recuperar contraseña';
                
                $cuerpoHtml = "<p>Hola $datosUsuario[nombre] $datosUsuario[apellido], somos Veterinaria San Antón!</p>";
                $cuerpoHtml .= "<p>Ingrese al siguiente enlace para definir su nueva contraseña: <a href='$enlace'>Click aquí</a></p>";

                $cuerpoPlano = "Hola $datosUsuario[nombre] $datosUsuario[apellido]!\n";
                $cuerpoPlano .= "Ingrese al siguiente enlace para definir su nueva contraseña: $enlace";
    
    
                $alertaExito = 'Se envió un email a su casilla de correo electrónico. Siga los pasos indicados para restablecer su contraseña.';
                $alertaError = 'Error al tratar de restablecer su contraseña.';

                enviarMail($destinatario, $nombre, $asunto, $cuerpoHtml, $cuerpoPlano, null, $alertaExito, $alertaError);


                $query = "INSERT INTO reset_claves (tipo_usuario, id_usuario, codigo, fecha_hora, utilizado) VALUES ('$datosUsuario[tipoUsuario]', 
                    '$datosUsuario[id]', '" . md5($codigo) . "', CURRENT_TIMESTAMP(), 0)";
                consultaSQL($query);
            }
            else
            {
                $_SESSION['alerta'] = 'No hay un usuario registrado con el correo suministrado.';
                $_SESSION['icono_alerta'] = 'error';
            }
        }
        else
        {
            $_SESSION['alerta'] = 'No se pudo enviar el correo para recuperar su contraseña.';
            $_SESSION['icono_alerta'] = 'error';
        }

        break;

    case 'consulta':
        $destino = '../nuestraUbicacion.php';

        if (isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['email']) && isset($_POST['codArea']) && isset($_POST['telefono']) && isset($_POST['motivo']) && isset($_POST['problema']))
        {
            $destinatario = 'veterinariasananton237@gmail.com';
            $nombre = 'Veterinaria San Antón';
            $asunto = "Consulta $_POST[motivo]";
            
            $cuerpoHtml = "<p>Hola $_POST[nombre] $_POST[apellido], <b>somos Veterinaria San Antón!</b></p><hr>";
            $cuerpoHtml .= "<p>Hemos recibido su consulta sobre <b>$_POST[motivo]</b>. Nos comunicaremos con usted a la brevedad.</p>";
            $cuerpoHtml .= "<p>El número de teléfono que nos suministró es: $_POST[codArea]-$_POST[telefono]</p><br>";
            $cuerpoHtml .= "<h3>Su consulta:</h3>";
            $cuerpoHtml .= "<p>$_POST[problema]</p><hr>";
            $cuerpoHtml .= "<b>Si algunos de los datos es erróneo, envíe nuevamente la consulta y en descripción de la consulta realice las aclaraciones pertinentes.</b><br>";
            $cuerpoHtml .= "<b>Si usted no envió la consulta, desestime este mensaje.</b>";
            


            $cuerpoPlano = "Nombre y apellido: $_POST[nombre] $_POST[apellido]\n";
            $cuerpoPlano .= "Teléfono: $_POST[codArea]-$_POST[telefono]\n\n";
            $cuerpoPlano .= "Motivo consulta: $_POST[motivo]\n";
            $cuerpoPlano .= "Problema: $_POST[problema]";


            $mailCopia = $_POST['email'];
            $alertaExito = 'Consulta enviada con éxito. Recibirá una copia en su casilla de correo.';
            $alertaError = 'No se pudo enviar la consulta';
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