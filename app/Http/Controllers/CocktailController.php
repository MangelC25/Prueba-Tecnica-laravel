<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Cocktail;

const COCKTAIL_API_URL = 'https://www.thecocktaildb.com/api/json/v1/1/search.php?s=margarita';
// Controlador para manejar las peticiones relacionadas a los cócteles


class CocktailController extends Controller
{
    // Método para obtener los cócteles (consumiendo la API en el backend)
    public function index(Request $request)
    {
        // Realiza la petición a la API de TheCocktailDB
        
        $response = Http::get(COCKTAIL_API_URL);
        
        // Verifica si la respuesta es exitosa y extrae la data
        if ($response->successful()) {
            $cocktails = $response->json()['drinks'] ?? [];
            // Retorna la vista 'cocktails.index' inyectando la variable $cocktails
            return view('cocktails.index', compact('cocktails'));
        } else {
            // En caso de error, se le puede pasar un array vacío y un mensaje de error opcional
            $cocktails = [];
            return view('cocktails.index', compact('cocktails'))
                ->with('error', 'Error al consumir la API de TheCocktailDB');
        }
    }
    
    // Método para almacenar un cóctel (si se usa para guardar desde el frontend)
    public function store(Request $request)
    {
        // Valida los datos recibidos
        $data = $request->validate([
            'name' => 'required|string',
            'category' => 'nullable|string',
            'instructions' => 'nullable|string',
            'image' => 'nullable|string',
        ]);

        // Crea y guarda el registro en la base de datos
        $cocktail = Cocktail::create($data);

        return response()->json([
            'message' => 'Cóctel guardado con éxito',
            'cocktail' => $cocktail,
        ], 201);
    }

        // Muestra la lista de cócteles guardados
        public function manage()
        {
            $cocktails = Cocktail::all();
            return view('cocktails.manage', compact('cocktails'));
        }
}