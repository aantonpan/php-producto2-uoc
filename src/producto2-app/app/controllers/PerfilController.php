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

        $id = $usuario['id'];
        $tipo = $usuario['tipo'];

        $perfil = [];

        if ($tipo === 'particular') {
            $stmt = $db->prepare("SELECT * FROM transfer_viajeros WHERE email = ?");
            $stmt->execute([$usuario['email']]);
            $perfil = $stmt->fetch(PDO::FETCH_ASSOC);
        } elseif ($tipo === 'admin') {
            $stmt = $db->prepare("SELECT id, username, email, tipo FROM usuarios WHERE id = ?");
            $stmt->execute([$id]);
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
        $tipo = $_SESSION['usuario']['tipo'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $tipo === 'particular') {
            $nombre = $_POST['nombre'] ?? '';
            $apellido1 = $_POST['apellido1'] ?? '';
            $apellido2 = $_POST['apellido2'] ?? '';
            $direccion = $_POST['direccion'] ?? '';
            $codigoPostal = $_POST['codigoPostal'] ?? '';
            $ciudad = $_POST['ciudad'] ?? '';
            $pais = $_POST['pais'] ?? '';

            // Procesar imagen si se subió
            $nombreImagen = null;
            if (!empty($_FILES['imagen_perfil']['name'])) {
                $nombreImagen = 'perfil_' . time() . '_' . basename($_FILES['imagen_perfil']['name']);
                $rutaDestino = __DIR__ . '/../../public/uploads/perfiles/' . $nombreImagen;

                // Asegura que exista la carpeta
                if (!file_exists(dirname($rutaDestino))) {
                    mkdir(dirname($rutaDestino), 0777, true);
                }

                if (!move_uploaded_file($_FILES['imagen_perfil']['tmp_name'], $rutaDestino)) {
                    echo "Error al subir la imagen.";
                    return;
                }
            }

            // Actualizar datos en la tabla transfer_viajeros
            if ($nombreImagen) {
                $stmt = $db->prepare("UPDATE transfer_viajeros 
                    SET nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, codigoPostal = ?, ciudad = ?, pais = ?, imagen_perfil = ?
                    WHERE email = (SELECT email FROM usuarios WHERE id = ?)");
                $stmt->execute([$nombre, $apellido1, $apellido2, $direccion, $codigoPostal, $ciudad, $pais, $nombreImagen, $usuario_id]);
            } else {
                $stmt = $db->prepare("UPDATE transfer_viajeros 
                    SET nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, codigoPostal = ?, ciudad = ?, pais = ?
                    WHERE email = (SELECT email FROM usuarios WHERE id = ?)");
                $stmt->execute([$nombre, $apellido1, $apellido2, $direccion, $codigoPostal, $ciudad, $pais, $usuario_id]);
            }

            header("Location: ?r=perfil/index");
            exit;
        }

        // Mostrar vista index si no es POST
        $stmt = $db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->execute([$usuario_id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            echo "No se pudo cargar el perfil del usuario.";
            return;
        }

        if ($tipo === 'particular') {
            $stmt = $db->prepare("SELECT * FROM transfer_viajeros WHERE email = ?");
            $stmt->execute([$usuario['email']]);
            $perfil = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $perfil = $usuario;
        }

        $contenido = __DIR__ . '/../views/perfil/index.php';
        include __DIR__ . '/../views/layout.php';
    }
}
