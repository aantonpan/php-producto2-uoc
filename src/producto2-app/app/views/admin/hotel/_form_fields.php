<div class="mb-3">
  <label class="form-label">Nombre del hotel</label>
  <input type="text" name="nombre" class="form-control" value="<?= $hotel['nombre'] ?? '' ?>" required>
</div>

<div class="mb-3">
  <label class="form-label">Dirección</label>
  <input type="text" name="direccion" class="form-control" value="<?= $hotel['direccion'] ?? '' ?>" required>
</div>

<div class="mb-3">
  <label class="form-label">Zona</label>
  <select name="id_zona" class="form-select" required>
    <option value="">Selecciona una zona</option>
    <?php foreach ($zonas as $z): ?>
      <option value="<?= $z['id_zona'] ?>"
        <?= (isset($hotel['id_zona']) && $hotel['id_zona'] == $z['id_zona']) ? 'selected' : '' ?>>
        <?= htmlspecialchars($z['descripcion']) ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>

<div class="mb-3">
  <label class="form-label">Usuario</label>
  <input type="text" name="usuario" class="form-control" value="<?= $hotel['usuario'] ?? '' ?>" required>
</div>

<div class="mb-3">
  <label class="form-label">Contraseña</label>
  <input type="password" name="password" class="form-control" value="<?= $hotel['password'] ?? '' ?>" required>
</div>

<div class="mb-3">
  <label class="form-label">Comisión</label>
  <input type="number" name="Comision" step="0.01" class="form-control" value="<?= $hotel['Comision'] ?? '' ?>" required>
</div>
