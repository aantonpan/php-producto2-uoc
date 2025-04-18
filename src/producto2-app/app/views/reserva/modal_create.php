
<h5 class="text-primary mb-3"><i class="bi bi-journal-plus me-2"></i> Crear reserva</h5>

<form method="POST" action="?r=reserva/store&modal=1">
  <?php include __DIR__ . '/_form_fields.php'; ?>
  <div class="text-end mt-4">
    <button type="submit" class="btn btn-primary rounded-pill px-4">
      <i class="bi bi-check-circle me-1"></i> Guardar
    </button>
  </div>
</form>
