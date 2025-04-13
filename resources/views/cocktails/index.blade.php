
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba Técnica laravel</title>
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/main.jsx'])
</head>
<body>
    <div id="react-root"></div>
    <script>
        window.initialCocktails = @json($cocktails);
    </script>
</body>
</html>


