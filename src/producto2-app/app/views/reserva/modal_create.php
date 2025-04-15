<h3 class="mb-3">Crear reserva</h3>
<form action="?r=reserva/store&modal=1" method="POST">
    <?php include __DIR__ . '/_form_fields.php'; ?>
    <div class="mt-3 d-flex justify-content-end gap-2">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" onclick="window.parent.location.href='?r=reserva/index'">Cancelar</button>
    </div>
</form>
