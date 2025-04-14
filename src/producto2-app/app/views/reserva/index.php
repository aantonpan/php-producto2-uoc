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
                    <th>Fecha Entrada</th>
                    <th>Hora Entrada</th>
                    <th>Nº Vuelo</th>
                    <th>Origen</th>
                    <th>Fecha Salida</th>
                    <th>Hora Salida</th>
                    <th>Destino</th>
                    <th>Viajeros</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $res): ?>
                    <?php
                        $fechaHora = new DateTime($res['fecha_entrada'] . ' ' . $res['hora_entrada']);
                        $ahora = new DateTime();
                        $diff = $ahora->diff($fechaHora);
                        $puedeEditar = $fechaHora > $ahora && $diff->days >= 2;
                    ?>
                    <tr>
                        <td><?= $res['localizador'] ?></td>
                        <td><?= $res['fecha_entrada'] ?></td>
                        <td><?= $res['hora_entrada'] ?></td>
                        <td><?= $res['numero_vuelo_entrada'] ?></td>
                        <td><?= $res['origen_vuelo_entrada'] ?></td>
                        <td><?= $res['fecha_vuelo_salida'] ?? '-' ?></td>
                        <td><?= $res['hora_vuelo_salida'] ?? '-' ?></td>
                        <td><?= $res['nombre_destino'] ?></td>
                        <td><?= $res['num_viajeros'] ?></td>
                        <td><?= isset($res['Precio']) ? $res['Precio'] . ' €' : 'N/D' ?></td>


                        <td>
                            <?php if ($puedeEditar): ?>
                                <a href="?r=reserva/edit&id=<?= $res['id_reserva'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="?r=reserva/delete&id=<?= $res['id_reserva'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres cancelar esta reserva?')">Borrar</a>
                            <?php else: ?>
                                <button class="btn btn-sm btn-secondary" disabled onclick="alert('No puedes modificar o cancelar reservas con menos de 48h de antelación.')">Editar</button>
                                <button class="btn btn-sm btn-secondary" disabled onclick="alert('No puedes modificar o cancelar reservas con menos de 48h de antelación.')">Borrar</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>
