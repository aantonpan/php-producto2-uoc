<!-- views/admin/reserva/_form_fields.php -->
<div class="row g-3">
  <!-- Hotel -->
  <div class="col-md-6">
    <label class="form-label">Hotel</label>
    <select name="id_hotel" class="form-select" required>
      <option value="">Selecciona un hotel</option>
      <?php foreach ($hoteles as $h): ?>
        <option value="<?= $h['id_hotel'] ?>"
          <?= (isset($reserva['id_hotel']) && $reserva['id_hotel'] == $h['id_hotel']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($h['nombre']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Cliente -->
  <div class="col-md-6">
    <label class="form-label">Cliente (usuario)</label>
    <select name="id_cliente" class="form-select" required>
      <option value="">Selecciona un cliente</option>
      <?php foreach ($usuarios as $u): ?>
        <option value="<?= $u['id']; ?>"
          <?= (isset($reserva['id_cliente']) && $reserva['id_cliente'] == $u['id']) ? 'selected' : '' ?>>
          <?= htmlspecialchars("{$u['nombre']} {$u['apellido1']} ({$u['email']})"); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>


  <!-- Tipo de reserva -->
  <div class="col-md-6">
    <label class="form-label">Tipo de reserva</label>
    <select name="id_tipo_reserva" class="form-select" required>
      <option value="">Selecciona...</option>
      <?php foreach ($tipos as $t): ?>
        <option value="<?= $t['id_tipo_reserva'] ?>"
          <?= (isset($reserva['id_tipo_reserva']) && $reserva['id_tipo_reserva'] == $t['id_tipo_reserva']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($t['descripcion']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

    <!-- Destino (zona) -->
    <div class="col-md-6">
    <label class="form-label">Destino (zona)</label>
    <select name="id_destino" id="id_destino" class="form-select" required>
      <option value="">Selecciona...</option>
      <?php foreach ($destinos as $d): ?>
        <option 
          value="<?= $d['id_zona']; ?>"
          <?= (isset($reserva['id_destino']) && $reserva['id_destino'] == $d['id_zona']) ? 'selected' : ''; ?>>
          <?= htmlspecialchars($d['descripcion']); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>


  <!-- Fecha y hora entrada -->
  <div class="col-md-6">
    <label class="form-label">Fecha entrada</label>
    <input type="date" name="fecha_entrada" class="form-control"
      value="<?= htmlspecialchars($reserva['fecha_entrada'] ?? '') ?>" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Hora entrada</label>
    <input type="time" name="hora_entrada" class="form-control"
      value="<?= htmlspecialchars($reserva['hora_entrada'] ?? '') ?>" required>
  </div>

  <!-- Vuelo de entrada -->
  <div class="col-md-6">
    <label class="form-label">Número de vuelo de entrada</label>
    <input type="text" name="numero_vuelo_entrada" class="form-control"
      value="<?= htmlspecialchars($reserva['numero_vuelo_entrada'] ?? '') ?>" required>
  </div>
  <div class="col-md-6">
    <label class="form-label">Origen vuelo de entrada</label>
    <input type="text" name="origen_vuelo_entrada" class="form-control"
      value="<?= htmlspecialchars($reserva['origen_vuelo_entrada'] ?? '') ?>" required>
  </div>

  <!-- Vuelo de salida -->
  <div class="col-md-6">
    <label class="form-label">Hora vuelo de salida</label>
    <input type="time" name="hora_vuelo_salida" class="form-control"
      value="<?= htmlspecialchars($reserva['hora_vuelo_salida'] ?? '') ?>">
  </div>
  <div class="col-md-6">
    <label class="form-label">Fecha vuelo de salida</label>
    <input type="date" name="fecha_vuelo_salida" class="form-control"
      value="<?= htmlspecialchars($reserva['fecha_vuelo_salida'] ?? '') ?>">
  </div>

  <!-- Vehículo y viajeros -->
  <div class="col-md-6">
    <label class="form-label">Vehículo</label>
    <select name="id_vehiculo" class="form-select" required>
      <option value="">Selecciona...</option>
      <?php foreach ($vehiculos as $v): ?>
        <option value="<?= $v['id_vehiculo'] ?>"
          <?= (isset($reserva['id_vehiculo']) && $reserva['id_vehiculo'] == $v['id_vehiculo']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($v['descripcion']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="col-md-3">
    <label class="form-label">Nº de viajeros</label>
    <input type="number" name="num_viajeros" class="form-control" min="1"
      value="<?= htmlspecialchars($reserva['num_viajeros'] ?? '') ?>" required>
  </div>
</div>
