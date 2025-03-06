@extends('layouts.app')

@section('title', 'Agregar Ciudad')

@section('content')
    <div class="container">
        <h1 class="mb-4">Agregar Ciudad</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cities.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la Ciudad</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="country" class="form-label">País</label>
                <input type="text" name="country" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="currency_name" class="form-label">Moneda</label>
                <input type="text" name="currency_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="currency_symbol" class="form-label">Símbolo de Moneda</label>
                <input type="text" name="currency_symbol" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="currency_code" class="form-label">Código de Moneda</label>
                <input type="text" name="currency_code" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
        </form>
    </div>
@endsection
