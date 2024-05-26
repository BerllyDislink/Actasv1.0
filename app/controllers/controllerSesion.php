<?php
require_once "../models/users.model.php";
require_once "../helpers/sesion_helper.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

class Users
{
    public $userModel;

    public function __construct()
    {
        $this->userModel = new UsersModel;
    }

    public function register()
    {
        $_POST = filter_input_array(INPUT_POST);

        $data = [
            'correo' => trim($_POST['correo']) . trim($_POST['emailInst']),
            'password' => trim($_POST['password']),
            'repeatPassword' => trim($_POST['repeatPassword']),
            'codigo_correo' => random_int(100000, 999999),
        ];

        if (strlen($data['password']) < 6) {
            flash("register", "Su contraseña debe tener más de 6 caracteres");
            redirect("../views/register.php");
        } else if ($data['password'] !== $data['repeatPassword']) {
            flash("register", "Las contraseñas no coinciden");
            redirect("../views/register.php");
        }

        if ($this->userModel->obtenerDato($data["correo"])) {
            flash("register", "El correo ya existe");
            redirect("../views/register.php");
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->userModel->guardarDatoConfirmacion($data);

        $this->enviarEmail($data['correo'], $data['codigo_correo']);

        redirect("../views/confirmacion.php");
        return $data;
    }

    public function register2()
    {
        $_POST = filter_input_array(INPUT_POST);

        $data = [
            'correo' => trim($_POST['correo']),
            'password' => trim($_POST['password']),
            'nombres' => trim($_POST['nombres']),
            'apellidos' => trim($_POST['apellidos']),
            'facultad' => trim($_POST['facultad']),
            'carrera' => trim($_POST['departamento']),
        ];

        $this->userModel->guardarDato($data);
        redirect("../views/login.php");
    }

    public function confirmarCorreo()
    {
        $_POST = filter_input_array(INPUT_POST);

        $codigo = trim($_POST['codigo']);
        $user = $this->userModel->obtenerDatoConfirmacion($codigo);
        if ($user) {
            if ($user['codigo_correo'] == $codigo) {
                //if ($this->userModel->guardarDato($user)) {
                redirect("../views/register2.php");
                //} else {
                //  die("Algo salió mal");
                //}
            } else {
                flash("confirmar", "El codigo es incorrecto");
                redirect("../views/confirmacion.php");
            }
        } else if ($user == "xd") {
            echo ("xd");
        } else {
            echo ($user);
        }
    }

    public function login()
    {
        $_POST = filter_input_array(INPUT_POST);

        $data = [
            'correo' => trim($_POST['correo']) . trim($_POST['emailInst']),
            'password' => trim($_POST['password']),
        ];

        if ($this->userModel->obtenerDato($data['correo'])) {

            $loggedInUser = $this->userModel->login($data['correo'], $data['password']);
            if ($loggedInUser) {
                $this->createUserSession($loggedInUser);
            } else {
                flash("login", "Contraseña incorrecta");
                redirect("../views/login.php");
            }
        } else {
            flash("login", "No se encontró el usuario");
            redirect("../views/login.php");
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['users_id'] = $user->users_id;
        $_SESSION['correo'] = $user->correo;
        redirect("../views/crud.php");
    }

    public function logout()
    {
        unset($_SESSION['users_id']);
        unset($_SESSION['correo']);
        session_destroy();
        redirect("../views/inicio.php");
    }

    public function enviarEmail($correo, $codigo_correo)
    {
        $mail = new PHPMailer(true);

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp-relay.brevo.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = '7545be001@smtp-brevo.com';                     //SMTP username
            $mail->Password   = 'nbFIjEOqM91dhLzS';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('juandiegobt4zul@gmail.com', 'Juan Diego');
            $mail->addAddress($correo);     //Add a recipient
            $mail->addReplyTo('juandiegobt4zul@gmail.com', 'Juan Diego');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz', 'name');         //Add attachments, Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $contenido = "Este es su codigo:" . $codigo_correo;
            $mail->Subject = 'Este es tu codigo de verificacion';
            $mail->Body    = $codigo_correo;
            $mail->AltBody = $codigo_correo;

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

$init = new Users;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST['type']) {
        case 'register':
            $init->register();
            break;
        case 'login':
            $init->login();
            break;
        case 'confirmar':
            $init->confirmarCorreo();
            break;
        case 'register2':
            $init->register2();
            break;
    }
} else {
    switch ($_GET['q']) {
        case 'logout':
            $init->logout();
            break;
        default:
            redirect("..views/inicio.php");
    }
}
