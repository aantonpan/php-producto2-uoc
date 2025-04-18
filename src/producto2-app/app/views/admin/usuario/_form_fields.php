<div class="row g-3">
  <div class="col-md-6">
    <label class="form-label">Nombre de usuario</label>
    <input type="text" name="username" class="form-control"
           value="<?= htmlspecialchars($usuario['username'] ?? '') ?>" required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control"
           value="<?= htmlspecialchars($usuario['email'] ?? '') ?>" required>
  </div>

  <div class="col-md-6">
    <label class="form-label">Contraseña <?= isset($usuario) ? '(Dejar en blanco para no cambiar)' : '' ?></label>
    <input type="password" name="password" class="form-control">
  </div>

  <div class="col-md-6">
    <label class="form-label">Tipo de usuario</label>
    <select name="tipo" class="form-select" required>
      <option value="">Selecciona...</option>
      <?php foreach (['admin', 'particular', 'hotel', 'vehiculo'] as $tipo): ?>
        <option value="<?= $tipo ?>" 
          <?= (isset($usuario['tipo']) && $usuario['tipo'] === $tipo) ? 'selected' : '' ?>>
          <?= ucfirst($tipo) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>
</div>
