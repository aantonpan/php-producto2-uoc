<?php

class PerfilAdminController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario = $_SESSION['usuario'] ?? null;

        if (!$usuario || $usuario['tipo'] !== 'admin') {
            echo "Acceso denegado.";
            return;
        }

        // Cargamos datos del usuario desde la base de datos
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario['id']]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            echo "No se pudo cargar el perfil del administrador.";
            return;
        }

        // Cargar la vista con layout de admin
        $contenido = __DIR__ . '/../views/admin/perfil/index.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function edit()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario = $_SESSION['usuario'] ?? null;

        if (!$usuario || $usuario['tipo'] !== 'admin') {
            echo "Acceso denegado.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $password2 = $_POST['password2'] ?? '';

            if ($password !== $password2) {
                $_SESSION['error'] = "Las contraseñas no coinciden.";
                header("Location: ?r=perfiladmin/index");
                exit;
            }

            // Actualizar según si hay o no nueva contraseña
            if (!empty($password)) {
                $stmt = $db->prepare("UPDATE usuarios SET email = ?, password = ? WHERE id = ?");
                $stmt->execute([$email, password_hash($password, PASSWORD_DEFAULT), $usuario['id']]);
            } else {
                $stmt = $db->prepare("UPDATE usuarios SET email = ? WHERE id = ?");
                $stmt->execute([$email, $usuario['id']]);
            }

            // Actualizar también la sesión
            $_SESSION['usuario']['email'] = $email;

            $_SESSION['success'] = "Perfil actualizado correctamente.";
            header("Location: ?r=perfiladmin/index");
            exit;
        }

        header("Location: ?r=perfiladmin/index");
    }
}
