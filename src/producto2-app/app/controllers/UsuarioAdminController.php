<?php

class UsuarioAdminController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $stmt = $db->query("SELECT * FROM usuarios ORDER BY creado_en DESC");
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $contenido = __DIR__ . '/../views/admin/usuario/index.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function create()
    {
        $usuario = [];

        $contenido = __DIR__ . '/../views/admin/usuario/create.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function store()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $tipo = $_POST['tipo'];

        if (empty($username) || empty($email) || empty($tipo)) {
            echo "Todos los campos son obligatorios.";
            return;
        }

        // Si se envió contraseña, la encriptamos
        $hashed = $password ? password_hash($password, PASSWORD_DEFAULT) : null;

        $stmt = $db->prepare("INSERT INTO transfer_usuarios (username, email, password, tipo, creado_en)
                              VALUES (?, ?, ?, ?, NOW())");
        $stmt->execute([$username, $email, $hashed, $tipo]);

        header("Location: ?r=usuarioadmin/index");
        exit;
    }

    public function edit()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID no válido.";
            return;
        }

        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id_usuario = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            echo "Usuario no encontrado.";
            return;
        }

        $contenido = __DIR__ . '/../views/admin/usuario/edit.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function update()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID no válido.";
            return;
        }

        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $tipo = $_POST['tipo'];

        if (empty($username) || empty($email) || empty($tipo)) {
            echo "Todos los campos son obligatorios.";
            return;
        }

        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("UPDATE transfer_usuarios SET username = ?, email = ?, password = ?, tipo = ? WHERE id_usuario = ?");
            $stmt->execute([$username, $email, $hashed, $tipo, $id]);
        } else {
            $stmt = $db->prepare("UPDATE transfer_usuarios SET username = ?, email = ?, tipo = ? WHERE id_usuario = ?");
            $stmt->execute([$username, $email, $tipo, $id]);
        }

        header("Location: ?r=usuarioadmin/index");
        exit;
    }

    public function delete()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'] ?? null;
        if (!$id) {
            echo "ID no válido.";
            return;
        }

        $stmt = $db->prepare("DELETE FROM transfer_usuarios WHERE id_usuario = ?");
        $stmt->execute([$id]);

        header("Location: ?r=usuarioadmin/index");
        exit;
    }
}
