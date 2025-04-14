<div class="container py-4">
    <h2 class="mb-4">Modificar reserva</h2>

    <form method="POST">
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Fecha de entrada</label>
                    <input type="date" name="fecha_entrada" class="form-control" value="<?= $reserva['fecha_entrada'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Hora de entrada</label>
                    <input type="time" name="hora_entrada" class="form-control" value="<?= $reserva['hora_entrada'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Número de vuelo</label>
                    <input type="text" name="numero_vuelo_entrada" class="form-control" value="<?= $reserva['numero_vuelo_entrada'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Origen del vuelo</label>
                    <input type="text" name="origen_vuelo_entrada" class="form-control" value="<?= $reserva['origen_vuelo_entrada'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha vuelo salida</label>
                    <input type="date" name="fecha_vuelo_salida" class="form-control" value="<?= $reserva['fecha_vuelo_salida'] ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hora vuelo salida</label>
                    <input type="time" name="hora_vuelo_salida" class="form-control" value="<?= $reserva['hora_vuelo_salida'] ?>" required>
                </div>


                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>
            </div>
        </div>
    </form>
</div>
