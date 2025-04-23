<!-- views/admin/hotel/_form_fields.php -->
<div class="row g-3">
  <!-- Nombre -->
  <div class="col-md-6">
    <label for="nombre" class="form-label">Nombre</label>
    <input
      type="text"
      id="nombre"
      name="nombre"
      class="form-control"
      required
      value="<?= htmlspecialchars($hotel['nombre'] ?? '') ?>">
  </div>

  <!-- Dirección -->
  <div class="col-md-6">
    <label for="direccion" class="form-label">Dirección</label>
    <input
      type="text"
      id="direccion"
      name="direccion"
      class="form-control"
      required
      value="<?= htmlspecialchars($hotel['direccion'] ?? '') ?>">
  </div>

  <!-- Zona -->
  <div class="col-md-6">
    <label for="id_zona" class="form-label">Zona</label>
    <select id="id_zona" name="id_zona" class="form-select" required>
      <option value="">Selecciona una zona</option>
      <?php foreach ($zonas as $z): ?>
        <option
          value="<?= $z['id_zona']; ?>"
          <?= (isset($hotel['id_zona']) && $hotel['id_zona'] == $z['id_zona']) ? 'selected' : ''; ?>>
          <?= htmlspecialchars($z['descripcion']); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Comisión -->
  <div class="col-md-6">
    <label for="Comision" class="form-label">Comisión (%)</label>
    <input
      type="number"
      id="Comision"
      name="Comision"
      class="form-control"
      min="0"
      value="<?= htmlspecialchars($hotel['Comision'] ?? '') ?>">
  </div>
</div>
