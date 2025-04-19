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
            <td><?= $p['id_precios'] ?></td>
            <td><?= htmlspecialchars($p['hotel']) ?></td>
            <td><?= htmlspecialchars($p['vehiculo']) ?></td>
            <td><?= number_format($p['Precio'], 2) ?> €</td>
            <td class="text-end">
              <a href="?r=precioadmin/edit&id=<?= $p['id_precios'] ?>" class="btn btn-sm btn-warning rounded-pill me-2">
              <i class="bi bi-pencil"></i> Editar
              <a href="?r=precioadmin/delete&id=<?= $p['id_precios'] ?>" class="btn btn-sm btn-danger rounded-pill" onclick="return confirm('¿Eliminar este usuario?')">
              <i class="bi bi-trash"></i> Borrar
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  </div>
</div>
