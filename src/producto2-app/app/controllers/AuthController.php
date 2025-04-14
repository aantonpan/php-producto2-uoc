<?php

class AuthController

    // REGISTRO
    {
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../core/db.php';
            global $db;

            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];

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
                echo "Ya existe un usuario con ese correo.";
                return;
            }

            // Insertar nuevo usuario
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $tipo = 'particular'; // todos los registros desde la web son particulares

            $insert = $db->prepare("INSERT INTO usuarios (username, email, password, tipo) VALUES (?, ?, ?, ?)");
            $insert->execute([$username, $email, $hashedPassword, $tipo]);

            // Redirigir al login
            header("Location: ?r=auth/login&type=particular");
            exit;
        } else {
            // Mostrar formulario
            $contenido = __DIR__ . '/../views/auth/register.php';
            include __DIR__ . '/../views/layout.php';
        }
    }


    //LOGIN
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

            // Buscar usuario por email
            $stmt = $db->prepare("SELECT * FROM usuarios WHERE email = ?");
            $stmt->execute([$email]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($password, $usuario['password'])) {
                // Guardar sesión
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'username' => $usuario['username'],
                    'email' => $usuario['email'],
                    'tipo' => $usuario['tipo']
                ];

                // Redirigir
                if ($usuario['tipo'] === 'admin') {
                    header("Location: ?r=admin/index");
                } else {
                    header("Location: ?r=perfil/index");
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
        session_start(); // Por si acaso no está iniciado aún
        session_unset(); // Elimina todas las variables de sesión
        session_destroy(); // Destruye la sesión

        // Redirige al login de particular por defecto
        header("Location: ?r=auth/login&type=particular");
        exit;
    }


}
