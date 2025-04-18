
<h5 class="text-primary mb-3"><i class="bi bi-pencil-square me-2"></i> Editar reserva: <?= $reserva['localizador'] ?></h5>

<form method="POST" action="?r=reserva/update&id=<?= $reserva['id_reserva'] ?>&modal=1">
  <?php include __DIR__ . '/_form_fields.php'; ?>
  <div class="text-end mt-4">
    <button type="submit" class="btn btn-primary rounded-pill px-4">
      <i class="bi bi-save2 me-1"></i> Guardar Cambios
    </button>
  </div>
</form>
