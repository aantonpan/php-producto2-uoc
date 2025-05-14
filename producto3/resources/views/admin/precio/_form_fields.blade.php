@extends('admin.layout')

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Vehículo</label>
        <select name="id_vehiculo" class="form-select" required>
            @foreach ($vehiculos as $v)
                <option value="{{ $v->id_vehiculo }}"
                    @if (old('id_vehiculo', $precio->id_vehiculo ?? '') == $v->id_vehiculo) selected @endif>
                    {{ $v->descripcion }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Hotel</label>
        <select name="id_hotel" class="form-select" required>
            @foreach ($hoteles as $h)
                <option value="{{ $h->id_hotel }}"
                    @if (old('id_hotel', $precio->id_hotel ?? '') == $h->id_hotel) selected @endif>
                    {{ $h->nombre }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-12">
        <label class="form-label">Precio (€)</label>
        <input type="number" name="precio" class="form-control" step="0.01"
               value="{{ old('precio', $precio->precio ?? '') }}" required>
    </div>
</div>
