<?php
// $_veh = el array $vehiculo con datos o vacío en create
?>
<div class="mb-3">
  <label class="form-label">Descripción del vehículo</label>
  <input
    type="text"
    name="descripcion"
    class="form-control"
    value="<?= htmlspecialchars($vehiculo['descripcion'] ?? '') ?>"
    required
  >
</div>

<div class="mb-3">
  <label class="form-label">Email del conductor</label>
  <input
    type="email"
    name="email_conductor"
    class="form-control"
    value="<?= htmlspecialchars($vehiculo['email_conductor'] ?? '') ?>"
    required
  >
</div>

<div class="mb-3">
  <label class="form-label">Contraseña</label>
  <input
    type="password"
    name="password"
    class="form-control"
    <?= isset($vehiculo) ? '' : 'required' ?>
  >
  <?php if (isset($vehiculo)): ?>
    <small class="text-muted">
      Déjalo en blanco para no cambiar la contraseña actual.
    </small>
  <?php endif; ?>
</div>

<?php if (isset($_SESSION['error_vehiculo'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error_vehiculo'] ?>
  </div>
  <?php unset($_SESSION['error_vehiculo']); ?>
<?php elseif (isset($_SESSION['success_vehiculo'])): ?>
  <div class="alert alert-success">
    <?= $_SESSION['success_vehiculo'] ?>
  </div>
  <?php unset($_SESSION['success_vehiculo']); ?>
<?php endif; ?>
