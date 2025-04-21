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
            LEFT JOIN transfer_viajeros v ON u.email = v.email
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

        // Si se envió contraseña, la encriptamos
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

        // Cargamos usuario
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            echo "Usuario no encontrado.";
            return;
        }

        // Si es particular, buscamos también su perfil extendido
        if ($usuario['tipo'] === 'particular') {
            $stmtViajero = $db->prepare("SELECT * FROM transfer_viajeros WHERE email = ?");
            $stmtViajero->execute([$usuario['email']]);
            $viajero = $stmtViajero->fetch(PDO::FETCH_ASSOC);

            if ($viajero) {
                $usuario = array_merge($usuario, $viajero); // añadimos campos extra
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

        // Actualizar en tabla usuarios
        if (!empty($password)) {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("UPDATE usuarios SET username = ?, email = ?, password = ?, tipo = ? WHERE id = ?");
            $stmt->execute([$username, $email, $hashed, $tipo, $id]);
        } else {
            $stmt = $db->prepare("UPDATE usuarios SET username = ?, email = ?, tipo = ? WHERE id = ?");
            $stmt->execute([$username, $email, $tipo, $id]);
        }

        // Si es particular, actualizamos también transfer_viajeros
        if ($tipo === 'particular') {
            $nombre = $_POST['nombre'] ?? '';
            $apellido1 = $_POST['apellido1'] ?? '';
            $apellido2 = $_POST['apellido2'] ?? '';
            $direccion = $_POST['direccion'] ?? '';
            $codigoPostal = $_POST['codigoPostal'] ?? '';
            $ciudad = $_POST['ciudad'] ?? '';
            $pais = $_POST['pais'] ?? '';
            $imagenPerfil = null;

            // Manejo de imagen
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

            // Verificar si ya existe viajero con ese email
            $stmt = $db->prepare("SELECT id_viajero FROM transfer_viajeros WHERE email = ?");
            $stmt->execute([$email]);
            $viajero = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($viajero) {
                // Actualizar
                $query = "UPDATE transfer_viajeros 
                        SET nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, codigoPostal = ?, ciudad = ?, pais = ?";
                $params = [$nombre, $apellido1, $apellido2, $direccion, $codigoPostal, $ciudad, $pais];

                if ($imagenPerfil) {
                    $query .= ", imagen_perfil = ?";
                    $params[] = $imagenPerfil;
                }

                $query .= " WHERE email = ?";
                $params[] = $email;

                $stmt = $db->prepare($query);
                $stmt->execute($params);
            } else {
                // Insertar nuevo
                $stmt = $db->prepare("INSERT INTO transfer_viajeros 
                    (nombre, apellido1, apellido2, direccion, codigoPostal, ciudad, pais, email, imagen_perfil) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $nombre, $apellido1, $apellido2, $direccion, $codigoPostal,
                    $ciudad, $pais, $email, $imagenPerfil
                ]);
            }
        }

        // Subida de imagen si es cliente particular
        if ($tipo === 'particular' && isset($_FILES['imagen_perfil']) && $_FILES['imagen_perfil']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../public/uploads/';
            $filename = 'perfil_' . time() . '_' . basename($_FILES['imagen_perfil']['name']);
            $uploadPath = $uploadDir . $filename;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $uploadPath)) {
                // Actualiza la ruta en la tabla transfer_viajeros
                $stmt = $db->prepare("UPDATE transfer_viajeros SET imagen_perfil = ? WHERE email = ?");
                $stmt->execute(["uploads/" . $filename, $email]);
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
