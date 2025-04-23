<?php

class AuthController
{
    // REGISTRO
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../core/db.php';
            global $db;

            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            $type = $_POST['type'] ?? 'particular';

            if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
                $_SESSION['error_register'] = "Todos los campos son obligatorios.";
                header("Location: ?r=auth/register&type=$type");
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error_register'] = "Correo no válido.";
                header("Location: ?r=auth/register&type=$type");
                exit;
            }

            if ($password !== $confirm) {
                $_SESSION['error_register'] = "Las contraseñas no coinciden.";
                header("Location: ?r=auth/register&type=$type");
                exit;
            }

            $stmt = $db->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $_SESSION['error_register'] = "Este correo ya está registrado.";
                header("Location: ?r=auth/register&type=$type");
                exit;
            }

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $db->prepare("INSERT INTO usuarios (username, email, password, tipo, creado_en) VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([$username, $email, $hashed, $type]);

            $usuario_id = $db->lastInsertId();

            switch ($type) {
                case 'hotel':
                    $stmt = $db->prepare("INSERT INTO transfer_hotel (usuario, password, nombre, direccion) VALUES (?, ?, ?, '')");
                    $stmt->execute([$usuario_id, $hashed, $username]);
                    break;

                case 'vehiculo':
                    $stmt = $db->prepare("INSERT INTO transfer_vehiculo (email_conductor, password, Descripcion) VALUES (?, ?, ?)");
                    $stmt->execute([$email, $hashed, $username]);
                    break;

                    case 'particular':
                        default:
                            // Sólo grabamos el nombre + la contraseña (necesaria en el esquema) 
                            // y enlazamos vía id_usuario; el resto de campos quedan en cadena vacía
                            $stmt = $db->prepare("
                                INSERT INTO transfer_viajeros (
                                    nombre, apellido1, apellido2,
                                    direccion, codigoPostal, ciudad, pais,
                                    password, id_usuario
                                ) VALUES (?, '', '', '', '', '', '', ?, ?)
                            ");
                            $stmt->execute([
                                $username,     // nombre
                                $hashed,       // password (obligatorio en tu tabla)
                                $usuario_id    // FK hacia usuarios.id
                            ]);
                            break;
            }

            $_SESSION['success_register'] = "Registro exitoso. Ya puedes iniciar sesión.";
            header("Location: ?r=auth/login&type=$type");
            exit;
        }

        $contenido = __DIR__ . '/../views/auth/register.php';
        include __DIR__ . '/../views/layout.php';
    }

    // LOGIN
    public function login()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $type = $_POST['type'] ?? 'particular';

            if (empty($email) || empty($password)) {
                $_SESSION['error_login'] = "Todos los campos son obligatorios.";
                header("Location: ?r=auth/login&type=$type");
                exit;
            }

            $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($password, $usuario['password'])) {
                if ($usuario['tipo'] !== $type) {
                    $_SESSION['error_login'] = "No tienes permisos para acceder con este tipo de usuario.";
                    header("Location: ?r=auth/login&type=$type");
                    exit;
                }
                            $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'username' => $usuario['username'],
                    'email' => $usuario['email'],
                    'tipo' => $usuario['tipo']
                ];

                session_write_close();

                switch ($usuario['tipo']) {
                    case 'admin':
                        header("Location: ?r=dashboard/admin");
                        break;
                    case 'hotel':
                        header("Location: ?r=dashboard/hotel");
                        break;
                    case 'vehiculo':
                        header("Location: ?r=dashboard/vehiculo");
                        break;
                    case 'particular':
                    default:
                        header("Location: ?r=dashboardcliente/index");
                        break;
                }
                exit;
            } else {
                $_SESSION['error_login'] = "Credenciales incorrectas.";
                header("Location: ?r=auth/login&type=$type");
                exit;
            }
        } else {
            $contenido = __DIR__ . '/../views/auth/login.php';
            include __DIR__ . '/../views/layout.php';
        }
    }

    // LOGOUT
    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: ?r=home/index");
        exit;
    }
}
