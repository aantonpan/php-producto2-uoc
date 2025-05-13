@extends('admin.layout')

<div class="mb-3">
    <label class="form-label">Nombre o descripción de la zona</label>
    <input type="text" name="descripcion" class="form-control"
           value="{{ old('descripcion', $zona->descripcion ?? '') }}" required>
</div>
