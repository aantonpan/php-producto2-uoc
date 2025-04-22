<?php

class PerfilController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario = $_SESSION['usuario'] ?? null;

        if (!$usuario) {
            echo "Usuario no autenticado.";
            return;
        }

        $stmt = $db->prepare("SELECT * FROM transfer_viajeros WHERE id_usuario = ?");
        $stmt->execute([$usuario['id']]);
        $perfil = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$perfil) {
            $stmt = $db->prepare("INSERT INTO transfer_viajeros (id_usuario, nombre) VALUES (?, ?)");
            $stmt->execute([$usuario['id'], $usuario['username']]);

            $stmt = $db->prepare("SELECT * FROM transfer_viajeros WHERE id_usuario = ?");
            $stmt->execute([$usuario['id']]);
            $perfil = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        if (!$perfil) {
            echo "No se pudo cargar el perfil del usuario.";
            return;
        }

        $contenido = __DIR__ . '/../views/perfil/index.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function edit()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario_id = $_SESSION['usuario']['id'];
        $email_actual = $_SESSION['usuario']['email'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $apellido1 = $_POST['apellido1'] ?? '';
            $apellido2 = $_POST['apellido2'] ?? '';
            $direccion = $_POST['direccion'] ?? '';
            $codigoPostal = $_POST['codigoPostal'] ?? '';
            $ciudad = $_POST['ciudad'] ?? '';
            $pais = $_POST['pais'] ?? '';
            $nuevo_email = $_POST['email'] ?? $email_actual;

            $password = $_POST['password'] ?? '';
            $password2 = $_POST['password2'] ?? '';

            if (!empty($password) || !empty($password2)) {
                if ($password !== $password2) {
                    $_SESSION['error_perfil'] = "Las contraseñas no coinciden.";
                    header("Location: ?r=perfil/index&edit=1");
                    exit;
                }

                $stmt = $db->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
                $stmt->execute([password_hash($password, PASSWORD_DEFAULT), $usuario_id]);
            }

            if ($nuevo_email !== $email_actual) {
                $stmt = $db->prepare("SELECT id FROM usuarios WHERE email = ? AND id != ?");
                $stmt->execute([$nuevo_email, $usuario_id]);
                if ($stmt->fetch()) {
                    $_SESSION['error_perfil'] = "Ese correo electrónico ya está en uso.";
                    header("Location: ?r=perfil/index&edit=1");
                    exit;
                }

                try {
                    $db->beginTransaction();

                    $stmt = $db->prepare("UPDATE usuarios SET email = ? WHERE id = ?");
                    $stmt->execute([$nuevo_email, $usuario_id]);

                    $db->commit();

                    $_SESSION['usuario']['email'] = $nuevo_email;
                    $email_actual = $nuevo_email;
                } catch (PDOException $e) {
                    $db->rollBack();
                    $_SESSION['error_perfil'] = "Error al actualizar el email. " . $e->getMessage();
                    header("Location: ?r=perfil/index&edit=1");
                    exit;
                }
            }

            $imagenPerfil = null;
            if (!empty($_FILES['imagen_perfil']['name'])) {
                $nombreArchivo = 'perfil_' . time() . '_' . basename($_FILES['imagen_perfil']['name']);
                $rutaFinal = __DIR__ . '/../../public/uploads/' . $nombreArchivo;

                if (!is_dir(dirname($rutaFinal))) {
                    mkdir(dirname($rutaFinal), 0777, true);
                }

                if (move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $rutaFinal)) {
                    $imagenPerfil = 'uploads/' . $nombreArchivo;
                } else {
                    $_SESSION['error_perfil'] = "Error al subir la imagen.";
                    header("Location: ?r=perfil/index&edit=1");
                    exit;
                }
            }

            if ($imagenPerfil) {
                $stmt = $db->prepare("UPDATE transfer_viajeros 
                    SET nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, codigoPostal = ?, ciudad = ?, pais = ?, imagen_perfil = ?
                    WHERE id_usuario = ?");
                $stmt->execute([$nombre, $apellido1, $apellido2, $direccion, $codigoPostal, $ciudad, $pais, $imagenPerfil, $usuario_id]);
            } else {
                $stmt = $db->prepare("UPDATE transfer_viajeros 
                    SET nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, codigoPostal = ?, ciudad = ?, pais = ?
                    WHERE id_usuario = ?");
                $stmt->execute([$nombre, $apellido1, $apellido2, $direccion, $codigoPostal, $ciudad, $pais, $usuario_id]);
            }

            $_SESSION['success_perfil'] = "Perfil actualizado correctamente.";
            header("Location: ?r=perfil/index");
            exit;
        }

        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            echo "No se pudo cargar el perfil del usuario.";
            return;
        }

        $stmt = $db->prepare("SELECT * FROM transfer_viajeros WHERE id_usuario = ?");
        $stmt->execute([$usuario_id]);
        $perfil = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$perfil) {
            $stmt = $db->prepare("INSERT INTO transfer_viajeros (id_usuario, nombre) VALUES (?, ?)");
            $stmt->execute([$usuario_id, $usuario['username']]);

            $stmt = $db->prepare("SELECT * FROM transfer_viajeros WHERE id_usuario = ?");
            $stmt->execute([$usuario_id]);
            $perfil = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $contenido = __DIR__ . '/../views/perfil/index.php';
        include __DIR__ . '/../views/layout.php';
    }
}
