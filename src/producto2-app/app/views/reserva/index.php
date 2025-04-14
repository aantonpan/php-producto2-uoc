<div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Mis reservas</h2>
        <a href="?r=reserva/create" class="btn btn-primary">Nueva reserva</a>
    </div>

    <?php if (empty($reservas)): ?>
        <div class="alert alert-info">No tienes reservas.</div>
    <?php else: ?>
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Localizador</th>
                    <th>Fecha entrada</th>
                    <th>Hora</th>
                    <th>Vuelo</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $res): ?>
                    <tr>
                        <td><?= $res['localizador'] ?></td>
                        <td><?= $res['fecha_entrada'] ?></td>
                        <td><?= $res['hora_entrada'] ?></td>
                        <td><?= $res['numero_vuelo_entrada'] ?></td>
                        <td><?= $res['origen_vuelo_entrada'] ?></td>
                        <td><?= $res['id_destino'] ?></td>
                        <td>
                            <a href="?r=reserva/edit&id=<?= $res['id_reserva'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="?r=reserva/delete&id=<?= $res['id_reserva'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres cancelar esta reserva?')">Cancelar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>
