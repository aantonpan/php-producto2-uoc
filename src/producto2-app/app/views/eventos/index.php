<h2>Hola desde index() de EventoController</h2>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($eventos as $evento): ?>
            <tr>
                <td><?= $evento['id_reserva'] ?></td>
                <td><?= $evento['fecha'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
