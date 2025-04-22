<!-- views/admin/reserva/create.php -->
<div class="container py-4">
  <h2 class="mb-4"><i class="bi bi-calendar-plus"></i> Crear Reserva</h2>
  <form method="POST" action="?r=reservaadmin/store">
    <div class="card p-4 shadow-sm border-0">
      <?php
        // Arranca con $reserva vacío y _form_fields.php despliega todos los campos
        $reserva = [];
        include __DIR__ . '/_form_fields.php';
      ?>
      <div class="mt-4 text-end">
        <button type="submit" class="btn btn-success rounded-pill px-4">
          <i class="bi bi-check-circle"></i> Guardar
        </button>
        <a href="?r=reservaadmin/index" class="btn btn-outline-secondary rounded-pill px-4 ms-2">
          Cancelar
        </a>
      </div>
    </div>
  </form>
</div>
