<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Vehículo</label>
    <select name="id_vehiculo" class="form-select" required>
      <?php foreach ($vehiculos as $v): ?>
        <option value="<?= $v['id_vehiculo'] ?>"
          <?= (isset($precio['id_vehiculo']) && $precio['id_vehiculo'] == $v['id_vehiculo']) ? 'selected' : '' ?>>
          <?= $v['descripcion'] ?>
        </option>
      <?php endforeach ?>
    </select>
  </div>
  <div class="col-md-6">
    <label class="form-label">Hotel</label>
    <select name="id_hotel" class="form-select" required>
      <?php foreach ($hoteles as $h): ?>
        <option value="<?= $h['id_hotel'] ?>"
          <?= (isset($precio['id_hotel']) && $precio['id_hotel'] == $h['id_hotel']) ? 'selected' : '' ?>>
          <?= $h['nombre'] ?>
        </option>
      <?php endforeach ?>
    </select>
  </div>
  <div class="col-12">
    <label class="form-label">Precio (€)</label>
    <input type="number" name="precio" class="form-control" step="0.01" value="<?= $precio['precio'] ?? '' ?>" required>
  </div>
</div>
