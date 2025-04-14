<div class="container py-4">
    <h2 class="mb-4">Crear nueva reserva</h2>

    <form method="POST" action="?r=reserva/store">
        <div class="card mb-4">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Fecha de entrada</label>
                    <input type="date" name="fecha_entrada" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hora de entrada</label>
                    <input type="time" name="hora_entrada" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Número de vuelo</label>
                    <input type="text" name="numero_vuelo_entrada" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Origen del vuelo</label>
                    <input type="text" name="origen_vuelo_entrada" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo de reserva</label>
                    <select name="id_tipo_reserva" class="form-select" required>
                        <option value="">Selecciona...</option>
                        <?php foreach ($tipo_reserva as $tipo_reserva): ?>
                            <option value="<?= $tipo_reserva['id_tipo_reserva'] ?>"><?= htmlspecialchars($tipo_reserva['descripcion']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Destino</label>
                    <select name="id_destino" class="form-select" required>
                        <option value="">Selecciona...</option>
                        <?php foreach ($destinos as $destino): ?>
                            <option value="<?= $destino['id_zona'] ?>"><?= htmlspecialchars($destino['descripcion']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha vuelo salida</label>
                    <input type="date" name="fecha_vuelo_salida" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hora vuelo salida</label>
                    <input type="time" name="hora_vuelo_salida" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Número de viajeros</label>
                    <input type="number" name="num_viajeros" class="form-control" min="1" required>
                </div>
                <<div class="mb-3">
                    <label class="form-label">Vehículo</label>
                    <select name="id_vehiculo" class="form-select" required>
                        <option value="">Selecciona...</option>
                        <?php foreach ($vehiculos as $vehiculo): ?>
                            <option value="<?= $vehiculo['id_vehiculo'] ?>"><?= htmlspecialchars($vehiculo['descripcion']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Guardar reserva</button>
                </div>
            </div>
        </div>
    </form>
</div>
