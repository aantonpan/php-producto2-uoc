<?php
// views/admin/vehiculo/edit.php
// $vehiculo debe venir cargado por el controller
?>
<div class="container py-4">
  <h2 class="mb-4 d-flex align-items-center gap-2 text-dark">
    <i class="bi bi-pencil-square"></i> Editar Vehículo
  </h2>

  <form method="POST" action="?r=vehiculoadmin/update&id=<?= $vehiculo['id_vehiculo'] ?>">
    <div class="card p-4 shadow-sm border-0">
      <?php include __DIR__ . '/_form_fields.php'; ?>
      <div class="mt-4 text-end">
        <button type="submit" class="btn btn-success rounded-pill px-4">
          <i class="bi bi-check-circle"></i> Guardar cambios
        </button>
        <a href="?r=vehiculoadmin/index"
           class="btn btn-outline-secondary rounded-pill px-4 ms-2">
          Cancelar
        </a>
      </div>
    </div>
  </form>
</div>
