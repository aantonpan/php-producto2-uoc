
<div class="container py-4">
  <h2 class="mb-4 d-flex align-items-center gap-2">
    <i class="bi bi-pencil-square"></i> Editar reserva: <?= $reserva['localizador'] ?>
  </h2>

  <form method="POST" action="?r=reserva/update&id=<?= $reserva['id_reserva'] ?>">
    <?php include __DIR__ . '/_form_fields.php'; ?>
    <div class="mt-4 text-end">
      <button type="submit" class="btn btn-primary rounded-pill px-4">
        <i class="bi bi-save2 me-1"></i> Guardar Cambios
      </button>
    </div>
  </form>
</div>
