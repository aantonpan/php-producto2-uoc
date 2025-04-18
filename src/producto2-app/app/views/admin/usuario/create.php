<div class="container py-4">
  <h2 class="mb-4"><i class="bi bi-person-plus"></i> Crear Usuario</h2>

  <form method="POST" action="?r=usuarioadmin/store">
    <div class="card p-4 shadow-sm border-0">
      <?php $usuario = []; include __DIR__ . '/_form_fields.php'; ?>
      <div class="mt-4 text-end">
        <button type="submit" class="btn btn-primary rounded-pill px-4">
          <i class="bi bi-check-circle"></i> Guardar
        </button>
        <a href="?r=usuarioadmin/index" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
      </div>
    </div>
  </form>
</div>
