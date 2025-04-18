<div class="container py-4">
  <h2 class="mb-4"><i class="bi bi-cash-coin"></i> Precios por hotel y vehículo</h2>
  <a href="?r=precioadmin/create" class="btn btn-primary mb-3">+ Nuevo precio</a>

  <div class="table-responsive">
    <table class="table table-hover">
      <thead class="table-light">
        <tr><th>ID</th><th>Hotel</th><th>Vehículo</th><th>Precio (€)</th><th></th></tr>
      </thead>
      <tbody>
        <?php foreach ($precios as $p): ?>
          <tr>
            <td><?= $p['id_precio'] ?></td>
            <td><?= htmlspecialchars($p['hotel']) ?></td>
            <td><?= htmlspecialchars($p['vehiculo']) ?></td>
            <td><?= number_format($p['precio'], 2) ?> €</td>
            <td class="text-end">
              <a href="?r=precioadmin/edit&id=<?= $p['id_precio'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="?r=precioadmin/delete&id=<?= $p['id_precio'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Borrar</a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
