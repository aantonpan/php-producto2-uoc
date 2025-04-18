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

            // Validaciones básicas
            if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
                echo "Todos los campos son obligatorios.";
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Correo no válido.";
                return;
            }

            if ($password !== $confirm) {
                echo "Las contraseñas no coinciden.";
                return;
            }

            // Comprobar si ya existe ese email
            $stmt = $db->prepare("SELECT id FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                echo "Este correo ya está registrado.";
                return;
            }

            // Hash de contraseña
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            // Insertar en tabla usuarios
            $stmt = $db->prepare("INSERT INTO usuarios (username, email, password, tipo, creado_en) VALUES (?, ?, ?, ?, NOW())");
            $stmt->execute([$username, $email, $hashed, $type]);

            $usuario_id = $db->lastInsertId();

            // Insertar según tipo
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
                            $stmt = $db->prepare("INSERT INTO transfer_viajeros (
                                nombre, apellido1, apellido2, direccion, codigoPostal, ciudad, pais, email, password
                            ) VALUES (?, '', '', '', '', '', '', ?, ?)");
                            $stmt->execute([$username, $email, $hashed]);
                            break;
                        
            }

            header("Location: ?r=auth/login&type=$type");
            exit;
        }

        // Si no es POST, mostrar formulario
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
                echo "Todos los campos son obligatorios.";
                return;
            }

            // Buscar usuario
            $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($password, $usuario['password'])) {
                // Guardar en sesión
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'username' => $usuario['username'],
                    'email' => $usuario['email'],
                    'tipo' => $usuario['tipo']
                ];

                // Redirección según tipo
                session_write_close();

                switch ($usuario['tipo']) {
                    case 'admin':
                        header("Location: ?r=admin/index");
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
                    echo "Credenciales incorrectas.";
                    return;
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
        header("Location: ?r=auth/login&type=particular");
        exit;
    }
}
