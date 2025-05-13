@extends('admin.layout')

<div class="mb-3">
    <label class="form-label">Descripción del vehículo</label>
    <input
        type="text"
        name="descripcion"
        class="form-control"
        value="{{ old('descripcion', $vehiculo->descripcion ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label class="form-label">Email del conductor</label>
    <input
        type="email"
        name="email_conductor"
        class="form-control"
        value="{{ old('email_conductor', $vehiculo->email_conductor ?? '') }}"
        required
    >
</div>

<div class="mb-3">
    <label class="form-label">Contraseña @if(isset($vehiculo)) <span class="text-muted">(Dejar en blanco para no cambiar)</span> @endif</label>
    <input
        type="password"
        name="password"
        class="form-control"
        @if (!isset($vehiculo)) required @endif
    >
</div>

@if (session('error_vehiculo'))
    <div class="alert alert-danger">
        {{ session('error_vehiculo') }}
    </div>
@elseif (session('success_vehiculo'))
    <div class="alert alert-success">
        {{ session('success_vehiculo') }}
    </div>
@endif
