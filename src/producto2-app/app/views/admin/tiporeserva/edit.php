<div class="container py-4">
  <h2 class="mb-4"><i class="bi bi-pencil-square"></i> Editar Tipo de Reserva</h2>

  <form method="POST" action="?r=tiporeservaadmin/update&id=<?= $tipo['id_tipo_reserva'] ?>">
    <div class="card p-4 shadow-sm border-0">
      <div class="mb-3">
        <label class="form-label">Descripción</label>
        <input type="text" name="descripcion" class="form-control" value="<?= htmlspecialchars($tipo['descripcion']) ?>" required>
      </div>
      <div class="text-end">
        <button type="submit" class="btn btn-success rounded-pill px-4">Guardar cambios</button>
        <a href="?r=tiporeservaadmin/index" class="btn btn-outline-secondary rounded-pill px-4 ms-2">Cancelar</a>
      </div>
    </div>
  </form>
</div>
