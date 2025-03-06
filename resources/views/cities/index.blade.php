@extends('layouts.app')

@section('title', 'Lista de Ciudades')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0 text-center">Ciudades Disponibles</h2>
            </div>
            <div class="card-body">
                <a href="{{ route('cities.create') }}" class="btn btn-success mb-3"> Agregar Ciudad</a>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($cities->isEmpty())
                    <div class="alert alert-warning text-center" role="alert">
                        <strong>No hay ciudades registradas.</strong>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>País</th>
                                    <th>Moneda</th>
                                    <th>Símbolo</th>
                                    <th>Código</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cities as $index => $city)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $city->country }}</td>
                                        <td>{{ $city->currency_name }}</td>
                                        <td>{{ $city->currency_symbol }}</td>
                                        <td>{{ $city->currency_code }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
