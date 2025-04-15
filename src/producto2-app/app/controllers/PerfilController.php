<?php

class PerfilController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario = $_SESSION['usuario'];
        $tipo = $usuario['tipo'];
        $id = $usuario['id'];
        $datos = [];

        if ($tipo === 'particular') {
            // Buscamos los datos del viajero
            $stmt = $db->prepare("SELECT * FROM transfer_viajeros WHERE id_viajero = ?");
            $stmt->execute([$id]);
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        } elseif ($tipo === 'admin') {
            // Si es admin, usamos solo la tabla usuarios
            $stmt = $db->prepare("SELECT id, username, email, tipo FROM usuarios WHERE id = ?");
            $stmt->execute([$id]);
            $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Vista común
        $contenido = __DIR__ . '/../views/perfil/index.php';
        include __DIR__ . '/../views/layout.php';
    }

    public function update()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $usuario = $_SESSION['usuario'];
        $tipo = $usuario['tipo'];
        $id = $usuario['id'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($tipo === 'particular') {
                $stmt = $db->prepare("UPDATE transfer_viajeros 
                    SET nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, codigoPostal = ?, ciudad = ?, pais = ?, email = ?
                    WHERE id_viajero = ?");
                $stmt->execute([
                    $_POST['nombre'],
                    $_POST['apellido1'],
                    $_POST['apellido2'],
                    $_POST['direccion'],
                    $_POST['codigoPostal'],
                    $_POST['ciudad'],
                    $_POST['pais'],
                    $_POST['email'],
                    $id
                ]);
            } elseif ($tipo === 'admin') {
                $stmt = $db->prepare("UPDATE usuarios 
                    SET username = ?, email = ? 
                    WHERE id = ?");
                $stmt->execute([
                    $_POST['username'],
                    $_POST['email'],
                    $id
                ]);
            }

            header("Location: ?r=perfil/index");
            exit;
        }
    }
}
