<div class="container py-4">
    <h2 class="mb-4">Editar reserva: <?= $reserva['localizador'] ?></h2>

    <form method="POST">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Fecha de entrada</label>
                <input type="date" name="fecha_entrada" class="form-control" value="<?= $reserva['fecha_entrada'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Hora de entrada</label>
                <input type="time" name="hora_entrada" class="form-control" value="<?= $reserva['hora_entrada'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Número de vuelo</label>
                <input type="text" name="numero_vuelo_entrada" class="form-control" value="<?= $reserva['numero_vuelo_entrada'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Origen del vuelo</label>
                <input type="text" name="origen_vuelo_entrada" class="form-control" value="<?= $reserva['origen_vuelo_entrada'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Fecha de vuelo de salida</label>
                <input type="date" name="fecha_vuelo_salida" class="form-control" value="<?= $reserva['fecha_vuelo_salida'] ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Hora de vuelo de salida</label>
                <input type="time" name="hora_vuelo_salida" class="form-control" value="<?= $reserva['hora_vuelo_salida'] ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Destino</label>
                <select name="id_destino" class="form-control" required>
                    <?php foreach ($destinos as $d): ?>
                        <option value="<?= $d['id_zona'] ?>" <?= $d['id_zona'] == $reserva['id_destino'] ? 'selected' : '' ?>>
                            <?= $d['descripcion'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Vehículo</label>
                <select name="id_vehiculo" class="form-control" required>
                    <?php foreach ($vehiculos as $v): ?>
                        <option value="<?= $v['id_vehiculo'] ?>" <?= $v['id_vehiculo'] == $reserva['id_vehiculo'] ? 'selected' : '' ?>>
                            <?= $v['descripcion'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Número de viajeros</label>
                <input type="number" name="num_viajeros" class="form-control" value="<?= $reserva['num_viajeros'] ?>" required>
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </div>
    </form>

    <div class="mt-3 text-end">
        <a href="?r=reserva/index" class="btn btn-outline-secondary">Cancelar</a>
    </div>
</div>
