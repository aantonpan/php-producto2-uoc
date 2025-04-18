<div class="container py-4">
  <h2 class="mb-4 d-flex align-items-center gap-2"><i class="bi bi-pencil-square"></i> Editar Hotel</h2>

  <form method="POST" action="?r=hoteladmin/update&id=<?= $hotel['id_hotel'] ?>">
    <div class="card p-4 shadow-sm border-0">
      <?php include __DIR__ . '/_form_fields.php'; ?>
      <div class="mt-4 text-end">
        <button type="submit" class="btn btn-primary rounded-pill px-4">
          <i class="bi bi-check-circle"></i> Guardar cambios
        </button>
        <a href="?r=hoteladmin/index" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
      </div>
    </div>
  </form>
</div>
