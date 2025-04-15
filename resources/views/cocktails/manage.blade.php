@extends('layouts.app')

@section('content')
    <!-- Contenedor para el componente React -->
    <div id="manage-root"></div>

    <!-- Inyección de la data inicial de cócteles (opcional si tu controlador la inyecta) -->
    <script>
        window.initialCocktails = @json($cocktails);
    </script>
@endsection