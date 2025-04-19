  <div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="d-flex align-items-center gap-2 mb-0 text-dark">
      <i class="bi bi-building"></i> Hoteles</h2>
    </h2>
    <a href="?r=reservaadmin/create" class="btn btn-success rounded-pill px-4">
    <i class="bi bi-plus-circle"></i> Nuevo hotel
    </a>
  </div>

  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Dirección</th>
        <th>Zona</th>
        <th>Usuario</th>
        <th>Comisión (%)</th>
        <th class="text-end">Acciones</th>
      </tr>
      </thead>
      <tbody>
        <?php foreach ($hoteles as $h): ?>
          <tr>
          <td><?= $h['id_hotel'] ?></td>
          <td><?= htmlspecialchars($h['nombre']) ?></td>
          <td><?= htmlspecialchars($h['direccion']) ?></td>
          <td><?= htmlspecialchars($h['nombre_zona']) ?></td>
          <td><?= htmlspecialchars($h['usuario']) ?></td>
          <td><?= number_format($h['Comision'], 2) ?></td>
          <td class="text-end">
              <a href="?r=hoteladmin/edit&id=<?= $h['id_hotel'] ?>" class="btn btn-sm btn-warning rounded-pill me-2">
              <i class="bi bi-pencil"></i> Editar
              <a href="?r=hoteladmin/delete&id=<?= $h['id_hotel'] ?>" class="btn btn-sm btn-danger rounded-pill" onclick="return confirm('¿Eliminar este usuario?')">
              <i class="bi bi-trash"></i> Borrar
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
