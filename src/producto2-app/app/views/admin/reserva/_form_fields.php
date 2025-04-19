<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Cliente (usuario)</label>
    <select name="id_cliente" class="form-select" required>
      <option value="">Selecciona un cliente</option>
      <?php foreach ($usuarios as $u): ?>
        <option value="<?= $u['id'] ?>"
          <?= (isset($reserva['id_cliente']) && $reserva['id_cliente'] == $u['id']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($u['username']) ?> (<?= htmlspecialchars($u['email']) ?>)
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label">Tipo de reserva</label>
    <select name="id_tipo_reserva" class="form-select" required>
      <option value="">Selecciona...</option>
      <?php foreach ($tipos as $tipo): ?>
        <option value="<?= $tipo['id_tipo_reserva'] ?>"
          <?= (isset($reserva['id_tipo_reserva']) && $reserva['id_tipo_reserva'] == $tipo['id_tipo_reserva']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($tipo['descripcion']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label">Fecha entrada</label>
    <input type="date" name="fecha_entrada" class="form-control" value="<?= htmlspecialchars($reserva['fecha_entrada'] ?? '') ?>" required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Hora entrada</label>
    <input type="time" name="hora_entrada" class="form-control" value="<?= htmlspecialchars($reserva['hora_entrada'] ?? '') ?>" required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Número de vuelo</label>
    <input type="text" name="numero_vuelo_entrada" class="form-control" value="<?= htmlspecialchars($reserva['numero_vuelo_entrada'] ?? '') ?>" required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Origen vuelo</label>
    <input type="text" name="origen_vuelo_entrada" class="form-control" value="<?= htmlspecialchars($reserva['origen_vuelo_entrada'] ?? '') ?>" required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Fecha vuelo salida</label>
    <input type="date" name="fecha_vuelo_salida" class="form-control" value="<?= htmlspecialchars($reserva['fecha_vuelo_salida'] ?? '') ?>">
  </div>

  <div class="col-md-6">
    <label class="form-label">Hora vuelo salida</label>
    <input type="time" name="hora_vuelo_salida" class="form-control" value="<?= htmlspecialchars($reserva['hora_vuelo_salida'] ?? '') ?>">
  </div>

  <div class="col-md-6">
    <label class="form-label">Destino</label>
    <select name="id_destino" class="form-select" required>
      <option value="">Selecciona...</option>
      <?php foreach ($destinos as $dest): ?>
        <option value="<?= $dest['id_zona'] ?>"
          <?= (isset($reserva['id_destino']) && $reserva['id_destino'] == $dest['id_zona']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($dest['descripcion']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-md-6">
    <label class="form-label">Vehículo</label>
    <select name="id_vehiculo" class="form-select" required>
      <option value="">Selecciona...</option>
      <?php foreach ($vehiculos as $veh): ?>
        <option value="<?= $veh['id_vehiculo'] ?>"
          <?= (isset($reserva['id_vehiculo']) && $reserva['id_vehiculo'] == $veh['id_vehiculo']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($veh['descripcion']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <div class="col-md-3">
    <label class="form-label">Nº de viajeros</label>
    <input type="number" name="num_viajeros" class="form-control" value="<?= htmlspecialchars($reserva['num_viajeros'] ?? '') ?>" min="1" required>
  </div>
</div>
