<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Formulario de Reserva</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <!-- Tu CSS personalizado -->
  <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-white">
  <form method="POST" action="?r=reserva/store&modal=1">
    <div class="card border-0 shadow-sm rounded-4 p-4">
      <?php include __DIR__ . '/_form_fields.php'; ?>

      <div class="mt-4 text-end">
        <button type="submit" class="btn btn-primary rounded-pill px-4">
          <i class="bi bi-check-circle"></i> Guardar reserva
        </button>
        <a href="#" onclick="parent.postMessage('closeModal', '*')" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
      </div>
    </div>
  </form>
</div>
</body>
</html>
<?php if (isset($_SESSION['error_reserva'])): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '<?= $_SESSION['error_reserva'] ?>',
    confirmButtonColor: '#8e44ad'
});
</script>
<?php unset($_SESSION['error_reserva']); endif; ?>

<?php if (isset($_SESSION['success_reserva'])): ?>
<script>
Swal.fire({
    icon: 'success',
    title: '¡Hecho!',
    text: '<?= $_SESSION['success_reserva'] ?>',
    confirmButtonColor: '#8e44ad',
    timer: 2000,
    showConfirmButton: false
}).then(() => {
    window.parent.postMessage('closeModal', '*');
});
</script>
<?php unset($_SESSION['success_reserva']); endif; ?>

