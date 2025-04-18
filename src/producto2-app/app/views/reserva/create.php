
<div class="container py-4">
  <h2 class="mb-4 d-flex align-items-center gap-2">
    <i class="bi bi-journal-plus"></i> Crear nueva reserva
  </h2>

  <form method="POST" action="?r=reserva/store">
    <?php include __DIR__ . '/_form_fields.php'; ?>
    <div class="mt-4 text-end">
      <button type="submit" class="btn btn-primary rounded-pill px-4">
        <i class="bi bi-check-circle me-1"></i> Guardar Reserva
      </button>
    </div>
  </form>
</div>
