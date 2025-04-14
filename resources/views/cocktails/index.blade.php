@extends('layouts.app')

@section('content')
    <div id="root"></div>
    <script>
        window.initialCocktails = @json($cocktails);
    </script>
@endsection
