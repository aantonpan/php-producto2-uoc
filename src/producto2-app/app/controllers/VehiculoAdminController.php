<?php
class VehiculoAdminController
{
    public function index()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $vehiculos = $db
          ->query("SELECT * FROM transfer_vehiculo ORDER BY id_vehiculo DESC")
          ->fetchAll(PDO::FETCH_ASSOC);

        $contenido = __DIR__ . '/../views/admin/vehiculo/index.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function create()
    {
        // Muestra el formulario en blanco
        $contenido = __DIR__ . '/../views/admin/vehiculo/create.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ?r=vehiculoadmin/index");
            exit;
        }

        require_once __DIR__ . '/../core/db.php';
        global $db;

        // Recogemos datos
        $descripcion      = trim($_POST['descripcion']);
        $email_conductor  = trim($_POST['email_conductor']);
        $password_plain   = $_POST['password'];

        // Validación mínima
        if (empty($descripcion) || empty($email_conductor) || empty($password_plain)) {
            $_SESSION['error_vehiculo'] = "Todos los campos son obligatorios.";
            header("Location: ?r=vehiculoadmin/create");
            exit;
        }

        // Hash de la contraseña
        $hashed = password_hash($password_plain, PASSWORD_DEFAULT);

        // Insert a BD
        $stmt = $db->prepare("
            INSERT INTO transfer_vehiculo
              (descripcion, email_conductor, password)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([
            $descripcion,
            $email_conductor,
            $hashed
        ]);

        $_SESSION['success_vehiculo'] = "Vehículo creado correctamente.";
        header("Location: ?r=vehiculoadmin/index");
        exit;
    }

    public function edit()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: ?r=vehiculoadmin/index");
            exit;
        }

        $stmt = $db->prepare("SELECT * FROM transfer_vehiculo WHERE id_vehiculo = ?");
        $stmt->execute([$id]);
        $vehiculo = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$vehiculo) {
            header("Location: ?r=vehiculoadmin/index");
            exit;
        }

        $contenido = __DIR__ . '/../views/admin/vehiculo/edit.php';
        include __DIR__ . '/../views/admin/layout.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ?r=vehiculoadmin/index");
            exit;
        }

        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id               = $_GET['id'] ?? null;
        $descripcion      = trim($_POST['descripcion']);
        $email_conductor  = trim($_POST['email_conductor']);
        $password_plain   = $_POST['password'];

        if (!$id || empty($descripcion) || empty($email_conductor)) {
            $_SESSION['error_vehiculo'] = "Descripción y correo son obligatorios.";
            header("Location: ?r=vehiculoadmin/edit&id={$id}");
            exit;
        }

        // Si han puesto contraseña nueva, la actualizamos, si no, sólo campos texto
        if (!empty($password_plain)) {
            $hashed = password_hash($password_plain, PASSWORD_DEFAULT);
            $sql = "
                UPDATE transfer_vehiculo
                SET descripcion = ?, email_conductor = ?, password = ?
                WHERE id_vehiculo = ?
            ";
            $params = [$descripcion, $email_conductor, $hashed, $id];
        } else {
            $sql = "
                UPDATE transfer_vehiculo
                SET descripcion = ?, email_conductor = ?
                WHERE id_vehiculo = ?
            ";
            $params = [$descripcion, $email_conductor, $id];
        }

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        $_SESSION['success_vehiculo'] = "Vehículo actualizado correctamente.";
        header("Location: ?r=vehiculoadmin/index");
        exit;
    }

    public function delete()
    {
        require_once __DIR__ . '/../core/db.php';
        global $db;

        $id = $_GET['id'] ?? null;
        if ($id) {
            $stmt = $db->prepare("DELETE FROM transfer_vehiculo WHERE id_vehiculo = ?");
            $stmt->execute([$id]);
            $_SESSION['success_vehiculo'] = "Vehículo eliminado.";
        }

        header("Location: ?r=vehiculoadmin/index");
        exit;
    }
}
