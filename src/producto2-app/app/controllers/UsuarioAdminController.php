<?php

class UsuarioAdminController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $stmt = $db->query("
            SELECT u.*, v.nombre AS nombre_actualizado, v.apellido1, v.apellido2
            FROM usuarios u
            LEFT JOIN transfer_viajeros v ON u.id = v.id_usuario
            ORDER BY u.creado_en DESC
        ");

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

        $hashed = $password ? password_hash($password, PASSWORD_DEFAULT) : null;

        $stmt = $db->prepare("INSERT INTO usuarios (username, email, password, tipo, creado_en)
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

        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            echo "Usuario no encontrado.";
            return;
        }

        if ($usuario['tipo'] === 'particular') {
            $stmtViajero = $db->prepare("SELECT * FROM transfer_viajeros WHERE id_usuario = ?");
            $stmtViajero->execute([$usuario['id']]);
            $viajero = $stmtViajero->fetch(PDO::FETCH_ASSOC);

            if ($viajero) {
                $usuario = array_merge($usuario, $viajero);
            }
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
            $stmt = $db->prepare("UPDATE usuarios SET username = ?, email = ?, password = ?, tipo = ? WHERE id = ?");
            $stmt->execute([$username, $email, $hashed, $tipo, $id]);
        } else {
            $stmt = $db->prepare("UPDATE usuarios SET username = ?, email = ?, tipo = ? WHERE id = ?");
            $stmt->execute([$username, $email, $tipo, $id]);
        }

        if ($tipo === 'particular') {
            $nombre = $_POST['nombre'] ?? '';
            $apellido1 = $_POST['apellido1'] ?? '';
            $apellido2 = $_POST['apellido2'] ?? '';
            $direccion = $_POST['direccion'] ?? '';
            $codigoPostal = $_POST['codigoPostal'] ?? '';
            $ciudad = $_POST['ciudad'] ?? '';
            $pais = $_POST['pais'] ?? '';
            $imagenPerfil = null;

            if (isset($_FILES['imagen_perfil']) && $_FILES['imagen_perfil']['error'] === UPLOAD_ERR_OK) {
                $tmp_name = $_FILES['imagen_perfil']['tmp_name'];
                $nombreArchivo = uniqid('perfil_') . '_' . basename($_FILES['imagen_perfil']['name']);
                $rutaDestino = 'uploads/' . $nombreArchivo;

                if (!is_dir('uploads')) {
                    mkdir('uploads', 0755, true);
                }

                if (move_uploaded_file($tmp_name, $rutaDestino)) {
                    $imagenPerfil = $rutaDestino;
                }
            }

            $stmt = $db->prepare("SELECT id_viajero FROM transfer_viajeros WHERE id_usuario = ?");
            $stmt->execute([$id]);
            $viajero = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($viajero) {
                $query = "UPDATE transfer_viajeros 
                        SET nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, codigoPostal = ?, ciudad = ?, pais = ?";
                $params = [$nombre, $apellido1, $apellido2, $direccion, $codigoPostal, $ciudad, $pais];

                if ($imagenPerfil) {
                    $query .= ", imagen_perfil = ?";
                    $params[] = $imagenPerfil;
                }

                $query .= " WHERE id_usuario = ?";
                $params[] = $id;

                $stmt = $db->prepare($query);
                $stmt->execute($params);
            } else {
                $stmt = $db->prepare("INSERT INTO transfer_viajeros 
                    (id_usuario, nombre, apellido1, apellido2, direccion, codigoPostal, ciudad, pais, email, imagen_perfil) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $id, $nombre, $apellido1, $apellido2, $direccion, $codigoPostal,
                    $ciudad, $pais, $email, $imagenPerfil
                ]);
            }
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

        $stmt = $db->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: ?r=usuarioadmin/index");
        exit;
    }
}
