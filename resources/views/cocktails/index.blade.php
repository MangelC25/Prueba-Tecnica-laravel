@extends('layouts.app')

@section('content')
    <div id="react-root"></div>
    <script>
        window.initialCocktails = @json($cocktails);
    </script>
@endsection
