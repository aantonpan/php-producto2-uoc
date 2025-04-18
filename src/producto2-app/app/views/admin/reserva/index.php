<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="d-flex align-items-center gap-2 mb-0">
      <i class="bi bi-journal-check"></i> Todas las Reservas
    </h2>
  </div>

  <?php if (empty($reservas)): ?>
    <div class="alert alert-info shadow-sm">No hay reservas registradas.</div>
  <?php else: ?>
    <div class="table-responsive shadow-sm rounded">
      <table class="table table-hover align-middle">
        <thead class="table-light text-uppercase small text-muted">
          <tr>
            <th>Localizador</th>
            <th>Entrada</th>
            <th>Hora</th>
            <th>Vuelo</th>
            <th>Origen</th>
            <th>Destino</th>
            <th>Salida</th>
            <th>Viajeros</th>
            <th>Vehículo</th>
            <th>Tipo</th>
            <th>Usuario</th>
            <th>Email</th>
            <th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($reservas as $r): ?>
            <tr>
              <td><?= htmlspecialchars($r['localizador']) ?></td>
              <td><?= htmlspecialchars($r['fecha_entrada']) ?></td>
              <td><?= htmlspecialchars($r['hora_entrada']) ?></td>
              <td><?= htmlspecialchars($r['numero_vuelo_entrada']) ?></td>
              <td><?= htmlspecialchars($r['origen_vuelo_entrada']) ?></td>
              <td><?= htmlspecialchars($r['nombre_destino']) ?></td>
              <td><?= $r['fecha_vuelo_salida'] ? htmlspecialchars($r['fecha_vuelo_salida']) : '-' ?></td>
              <td><?= htmlspecialchars($r['num_viajeros']) ?></td>
              <td><?= htmlspecialchars($r['nombre_vehiculo']) ?></td>
              <td><?= htmlspecialchars($r['tipo_reserva']) ?></td>
              <td><?= htmlspecialchars($r['nombre_usuario'] ?? '') ?></td>
              <td><?= htmlspecialchars($r['email'] ?? '') ?></td>
              <td class="text-end">
                <a href="?r=reservaadmin/edit&id=<?= $r['id_reserva'] ?>" class="btn btn-sm btn-warning rounded-pill me-2">
                  <i class="bi bi-pencil"></i> Editar
                </a>
                <a href="?r=reservaadmin/delete&id=<?= $r['id_reserva'] ?>" class="btn btn-sm btn-danger rounded-pill">
                  <i class="bi bi-trash"></i> Borrar
                </a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  <?php endif ?>
</div>
