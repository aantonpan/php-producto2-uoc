<?php
$error   = $_GET['error']   ?? null;
$success = $_GET['success'] ?? null;
?>
<div class="container py-4">
  <h2 class="mb-4 text-dark"><i class="bi bi-building"></i> Crear Hotel</h2>
  <form method="POST" action="?r=hoteladmin/store">
    <div class="card p-4 shadow-sm border-0">
      <?php
        $hotel = $hotel ?? [];
        include __DIR__ . '/_form_fields.php';
      ?>
      <div class="mt-4 text-end">
        <button type="submit" class="btn btn-success rounded-pill px-4">
          <i class="bi bi-check-circle"></i> Guardar
        </button>
        <a href="?r=hoteladmin/index" class="btn btn-outline-secondary rounded-pill px-4 ms-2">
          Cancelar
        </a>
      </div>
    </div>
  </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
  <?php if ($error === 'empty'): ?>
    Swal.fire({ icon:'error', title:'Campos vacíos', text:'Por favor, rellena todos los campos obligatorios.' });
  <?php elseif ($success === 'created'): ?>
    Swal.fire({ icon:'success', title:'Hotel creado', text:'El hotel se ha creado correctamente.' });
  <?php endif; ?>
});
</script>
