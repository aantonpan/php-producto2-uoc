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

        $stmt = $db->prepare("SELECT * FROM transfer_viajeros WHERE email = ?");
        $stmt->execute([$usuario['email']]);
        $perfil = $stmt->fetch(PDO::FETCH_ASSOC);

        // Crear perfil si no existe
        if (!$perfil) {
            $stmt = $db->prepare("INSERT INTO transfer_viajeros (email, nombre) VALUES (?, ?)");
            $stmt->execute([$usuario['email'], $usuario['username']]);

            $stmt = $db->prepare("SELECT * FROM transfer_viajeros WHERE email = ?");
            $stmt->execute([$usuario['email']]);
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
        $email = $_SESSION['usuario']['email'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $apellido1 = $_POST['apellido1'] ?? '';
            $apellido2 = $_POST['apellido2'] ?? '';
            $direccion = $_POST['direccion'] ?? '';
            $codigoPostal = $_POST['codigoPostal'] ?? '';
            $ciudad = $_POST['ciudad'] ?? '';
            $pais = $_POST['pais'] ?? '';

            // Nueva contraseña (opcional)
            $password = $_POST['password'] ?? '';
            $password2 = $_POST['password2'] ?? '';

            if (!empty($password) || !empty($password2)) {
                if ($password !== $password2) {
                    $_SESSION['error'] = "Las contraseñas no coinciden.";
                    header("Location: ?r=perfil/index&edit=1");
                    exit;
                }

                $stmt = $db->prepare("UPDATE usuarios SET password = ? WHERE id = ?");
                $stmt->execute([password_hash($password, PASSWORD_DEFAULT), $usuario_id]);
            }

            // Subida de imagen (si se ha subido)
            $imagenPerfil = null;
            if (!empty($_FILES['imagen_perfil']['name'])) {
                $nombreArchivo = 'perfil_' . time() . '_' . basename($_FILES['imagen_perfil']['name']);
                $rutaFinal = __DIR__ . '/../../public/uploads/' . $nombreArchivo;

                if (!is_dir(dirname($rutaFinal))) {
                    mkdir(dirname($rutaFinal), 0777, true);
                }

                if (move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $rutaFinal)) {
                    $imagenPerfil = 'uploads/' . $nombreArchivo; // Esta es la ruta que se usará en <img>
                } else {
                    echo "Error al subir la imagen.";
                    return;
                }
            }

            // Actualizar transfer_viajeros
            if ($imagenPerfil) {
                $stmt = $db->prepare("UPDATE transfer_viajeros 
                    SET nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, codigoPostal = ?, ciudad = ?, pais = ?, imagen_perfil = ?
                    WHERE email = ?");
                $stmt->execute([$nombre, $apellido1, $apellido2, $direccion, $codigoPostal, $ciudad, $pais, $imagenPerfil, $email]);
            } else {
                $stmt = $db->prepare("UPDATE transfer_viajeros 
                    SET nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, codigoPostal = ?, ciudad = ?, pais = ?
                    WHERE email = ?");
                $stmt->execute([$nombre, $apellido1, $apellido2, $direccion, $codigoPostal, $ciudad, $pais, $email]);
            }

            $_SESSION['success'] = "Perfil actualizado correctamente.";
            header("Location: ?r=perfil/index");
            exit;
        }

        // Mostrar formulario si no es POST
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            echo "No se pudo cargar el perfil del usuario.";
            return;
        }

        $stmt = $db->prepare("SELECT * FROM transfer_viajeros WHERE email = ?");
        $stmt->execute([$usuario['email']]);
        $perfil = $stmt->fetch(PDO::FETCH_ASSOC);

        // Si no existe, crearlo
        if (!$perfil) {
            $stmt = $db->prepare("INSERT INTO transfer_viajeros (email, nombre) VALUES (?, ?)");
            $stmt->execute([$usuario['email'], $usuario['username']]);

            $stmt = $db->prepare("SELECT * FROM transfer_viajeros WHERE email = ?");
            $stmt->execute([$usuario['email']]);
            $perfil = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $contenido = __DIR__ . '/../views/perfil/index.php';
        include __DIR__ . '/../views/layout.php';
    }

}
