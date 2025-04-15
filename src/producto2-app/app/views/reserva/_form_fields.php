<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="/css/style.css">

<div class="row g-3">
    <div class="col-md-6">
        <label>Fecha de entrada</label>
        <input type="date" name="fecha_entrada" class="form-control" value="<?= $reserva['fecha_entrada'] ?? '' ?>" required>
    </div>
    <div class="col-md-6">
        <label>Hora de entrada</label>
        <input type="time" name="hora_entrada" class="form-control" value="<?= $reserva['hora_entrada'] ?? '' ?>" required>
    </div>
    <div class="col-md-6">
        <label>Número de vuelo</label>
        <input type="text" name="numero_vuelo_entrada" class="form-control" value="<?= $reserva['numero_vuelo_entrada'] ?? '' ?>" required>
    </div>
    <div class="col-md-6">
        <label>Origen del vuelo</label>
        <input type="text" name="origen_vuelo_entrada" class="form-control" value="<?= $reserva['origen_vuelo_entrada'] ?? '' ?>" required>
    </div>
    <div class="col-md-6">
        <label>Tipo de reserva</label>
        <select name="id_tipo_reserva" class="form-select" required>
            <option value="">Selecciona...</option>
            <?php foreach ($tipos as $tipo): ?>
                <option value="<?= $tipo['id_tipo_reserva'] ?>"
                    <?= (isset($reserva['id_tipo_reserva']) && $reserva['id_tipo_reserva'] == $tipo['id_tipo_reserva']) ? 'selected' : '' ?>>
                    <?= $tipo['descripcion'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label>Destino</label>
        <select name="id_destino" class="form-select" required>
            <option value="">Selecciona...</option>
            <?php foreach ($destinos as $dest): ?>
                <option value="<?= $dest['id_zona'] ?>"
                    <?= (isset($reserva['id_destino']) && $reserva['id_destino'] == $dest['id_zona']) ? 'selected' : '' ?>>
                    <?= $dest['descripcion'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label>Fecha vuelo salida</label>
        <input type="date" name="fecha_vuelo_salida" class="form-control" value="<?= $reserva['fecha_vuelo_salida'] ?? '' ?>">
    </div>
    <div class="col-md-6">
        <label>Hora vuelo salida</label>
        <input type="time" name="hora_vuelo_salida" class="form-control" value="<?= $reserva['hora_vuelo_salida'] ?? '' ?>">
    </div>
    <div class="col-md-6">
        <label>Vehículo</label>
        <select name="id_vehiculo" class="form-select" required>
            <option value="">Selecciona...</option>
            <?php foreach ($vehiculos as $veh): ?>
                <option value="<?= $veh['id_vehiculo'] ?>"
                    <?= (isset($reserva['id_vehiculo']) && $reserva['id_vehiculo'] == $veh['id_vehiculo']) ? 'selected' : '' ?>>
                    <?= $veh['descripcion'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label>Número de viajeros</label>
        <input type="number" name="num_viajeros" class="form-control" value="<?= $reserva['num_viajeros'] ?? '' ?>" min="1" required>
    </div>
</div>
