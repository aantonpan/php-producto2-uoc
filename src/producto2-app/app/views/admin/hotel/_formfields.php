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
  <select name="zona" class="form-select" required>
    <option value="">Selecciona una zona</option>
    <?php foreach ($zonas as $z): ?>
      <option value="<?= $z['id_zona'] ?>"
        <?= (isset($hotel['zona']) && $hotel['zona'] == $z['id_zona']) ? 'selected' : '' ?>>
        <?= htmlspecialchars($z['descripcion']) ?>
      </option>
    <?php endforeach; ?>
  </select>
</div>
