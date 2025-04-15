<h3 class="mb-3">Editar reserva: <?= $reserva['localizador'] ?></h3>
<form method="POST" action="?r=reserva/edit&id=<?= $reserva['id_reserva'] ?>&modal=1">
    <?php include __DIR__ . '/_form_fields.php'; ?>
    <div class="mt-3 d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <button type="button" class="btn btn-secondary" onclick="window.parent.location.href='?r=reserva/index'">Cancelar</button>
    </div>
</form>
