<!-- views/admin/reserva/index.php -->
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="d-flex align-items-center gap-2 mb-0 text-dark">
      <i class="bi bi-journal-check"></i> Reservas
    </h2>
    <a href="?r=reservaadmin/create" class="btn btn-success rounded-pill px-4">
      <i class="bi bi-plus-circle"></i> Nueva reserva
    </a>
  </div>

  <?php if (empty($reservas)): ?>
    <div class="alert alert-info shadow-sm">No hay reservas registradas.</div>
  <?php else: ?>
    <div class="table-responsive shadow-sm rounded">
      <table class="table table-hover align-middle">
        <thead class="table-light text-uppercase small text-muted">
          <tr>
            <th>Localizador</th>
            <th>Hotel</th>
            <th>Cliente</th>
            <th>Destino</th>
            <th>Vehículo</th>
            <th>Tipo</th>
            <th>Entrada</th>
            <th>Vuelo Entrada</th>
            <th>Salida</th>
            <th>Viajeros</th>
            <th class="text-end">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($reservas as $r): ?>
            <tr>
              <!-- Identificador -->
              <td><?= htmlspecialchars($r['localizador']) ?></td>
              <!-- Hotel -->
              <td><?= htmlspecialchars($r['nombre_hotel'] ?? '-') ?></td>
              <!-- Cliente: nombre + primer apellido -->
              <td><?= htmlspecialchars($r['nombre_usuario'] . ' ' . $r['apellido_usuario']) ?></td>
              <!-- Destino -->
              <td><?= htmlspecialchars($r['nombre_destino']) ?></td>
              <!-- Vehículo -->
              <td><?= htmlspecialchars($r['nombre_vehiculo']) ?></td>
              <!-- Tipo de reserva -->
              <td><?= htmlspecialchars($r['tipo_reserva']) ?></td>
              <!-- Fecha y hora de entrada -->
              <td>
                <?= htmlspecialchars($r['fecha_entrada']) ?>
                <?= htmlspecialchars($r['hora_entrada']) ?>
              </td>
              <!-- Número y origen de vuelo de entrada -->
              <td>
                <?= htmlspecialchars($r['numero_vuelo_entrada']) ?>
                / <?= htmlspecialchars($r['origen_vuelo_entrada']) ?>
              </td>
              <!-- Hora y fecha de salida -->
              <td>
                <?= htmlspecialchars($r['hora_vuelo_salida']) ?>
                / <?= htmlspecialchars($r['fecha_vuelo_salida']) ?>
              </td>
              <!-- Número de viajeros -->
              <td><?= htmlspecialchars($r['num_viajeros']) ?></td>
              <!-- Acciones, alineadas a la derecha -->
              <th class="text-end" style="width: 180px;">
                <a href="?r=reservaadmin/edit&id=<?= $r['id_reserva'] ?>"
                   class="btn btn-sm btn-warning rounded-pill me-2">
                  <i class="bi bi-pencil"></i> Editar
                </a>
                <a href="?r=reservaadmin/delete&id=<?= $r['id_reserva'] ?>"
                   class="btn btn-sm btn-danger rounded-pill">
                  <i class="bi bi-trash"></i> Borrar
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
