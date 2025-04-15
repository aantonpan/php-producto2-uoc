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

        $usuario = $_SESSION['usuario'] ?? null;

        if (!$usuario) {
            echo "Usuario no autenticado.";
            return;
        }

        $email = $usuario['email'];
        $tipo = $usuario['tipo'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $tipo === 'particular') {
            $campos = [
                'nombre', 'apellido1', 'apellido2', 'direccion',
                'codigoPostal', 'ciudad', 'pais'
            ];

            $valores = [];
            foreach ($campos as $campo) {
                $valores[$campo] = $_POST[$campo] ?? null;
            }

            $stmt = $db->prepare("UPDATE transfer_viajeros SET 
                nombre = ?, apellido1 = ?, apellido2 = ?, direccion = ?, 
                codigoPostal = ?, ciudad = ?, pais = ?
                WHERE email = ?");

            $stmt->execute([
                $valores['nombre'], $valores['apellido1'], $valores['apellido2'],
                $valores['direccion'], $valores['codigoPostal'], $valores['ciudad'],
                $valores['pais'], $email
            ]);

            header("Location: ?r=perfil/index");
            exit;
        }

        header("Location: ?r=perfil/index");
    }
}
