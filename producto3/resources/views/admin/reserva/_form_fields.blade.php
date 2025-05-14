@extends('admin.layout')

<div class="row g-3">
    <!-- Hotel -->
    <div class="col-md-6">
        <label class="form-label">Hotel</label>
        <select name="id_hotel" class="form-select" required>
            <option value="">Selecciona un hotel</option>
            @foreach ($hoteles as $h)
                <option value="{{ $h->id_hotel }}"
                    @if (old('id_hotel', $reserva->id_hotel ?? '') == $h->id_hotel) selected @endif>
                    {{ $h->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Cliente -->
    <div class="col-md-6">
        <label class="form-label">Cliente (usuario)</label>
        <select name="id_cliente" class="form-select" required>
            <option value="">Selecciona un cliente</option>
            @foreach ($usuarios as $u)
                <option value="{{ $u->id }}"
                    @if (old('id_cliente', $reserva->id_cliente ?? '') == $u->id) selected @endif>
                    {{ $u->nombre }} {{ $u->apellido1 }} ({{ $u->email }})
                </option>
            @endforeach
        </select>
    </div>

    <!-- Tipo de reserva -->
    <div class="col-md-6">
        <label class="form-label">Tipo de reserva</label>
        <select name="id_tipo_reserva" class="form-select" required>
            <option value="">Selecciona...</option>
            @foreach ($tipos as $t)
                <option value="{{ $t->id_tipo_reserva }}"
                    @if (old('id_tipo_reserva', $reserva->id_tipo_reserva ?? '') == $t->id_tipo_reserva) selected @endif>
                    {{ $t->descripcion }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Destino -->
    <div class="col-md-6">
        <label class="form-label">Destino (zona)</label>
        <select name="id_destino" id="id_destino" class="form-select" required>
            <option value="">Selecciona...</option>
            @foreach ($destinos as $d)
                <option value="{{ $d->id_zona }}"
                    @if (old('id_destino', $reserva->id_destino ?? '') == $d->id_zona) selected @endif>
                    {{ $d->descripcion }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Fecha y hora entrada -->
    <div class="col-md-6">
        <label class="form-label">Fecha entrada</label>
        <input type="date" name="fecha_entrada" class="form-control"
               value="{{ old('fecha_entrada', $reserva->fecha_entrada ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Hora entrada</label>
        <input type="time" name="hora_entrada" class="form-control"
               value="{{ old('hora_entrada', $reserva->hora_entrada ?? '') }}" required>
    </div>

    <!-- Vuelo entrada -->
    <div class="col-md-6">
        <label class="form-label">Número de vuelo de entrada</label>
        <input type="text" name="numero_vuelo_entrada" class="form-control"
               value="{{ old('numero_vuelo_entrada', $reserva->numero_vuelo_entrada ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Origen vuelo de entrada</label>
        <input type="text" name="origen_vuelo_entrada" class="form-control"
               value="{{ old('origen_vuelo_entrada', $reserva->origen_vuelo_entrada ?? '') }}" required>
    </div>

    <!-- Vuelo salida -->
    <div class="col-md-6">
        <label class="form-label">Hora vuelo de salida</label>
        <input type="time" name="hora_vuelo_salida" class="form-control"
               value="{{ old('hora_vuelo_salida', $reserva->hora_vuelo_salida ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">Fecha vuelo de salida</label>
        <input type="date" name="fecha_vuelo_salida" class="form-control"
               value="{{ old('fecha_vuelo_salida', $reserva->fecha_vuelo_salida ?? '') }}">
    </div>

    <!-- Vehículo y viajeros -->
    <div class="col-md-6">
        <label class="form-label">Vehículo</label>
        <select name="id_vehiculo" class="form-select" required>
            <option value="">Selecciona...</option>
            @foreach ($vehiculos as $v)
                <option value="{{ $v->id_vehiculo }}"
                    @if (old('id_vehiculo', $reserva->id_vehiculo ?? '') == $v->id_vehiculo) selected @endif>
                    {{ $v->descripcion }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">Nº de viajeros</label>
        <input type="number" name="num_viajeros" class="form-control" min="1"
               value="{{ old('num_viajeros', $reserva->num_viajeros ?? '') }}" required>
    </div>
</div>
