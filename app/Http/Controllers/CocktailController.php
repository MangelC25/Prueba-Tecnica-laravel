<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Cocktail;

const COCKTAIL_API_URL = 'https://www.thecocktaildb.com/api/json/v1/1/random.php';
// Controlador para manejar las peticiones relacionadas a los cócteles


class CocktailController extends Controller
{
     // Método para obtener al menos 6 cócteles únicos
     public function index(Request $request)
     {
         // Realizamos 6 peticiones de forma concurrente
         $responses = Http::pool(function ($pool) {
             return [
                 $pool->get(COCKTAIL_API_URL),
                 $pool->get(COCKTAIL_API_URL),
                 $pool->get(COCKTAIL_API_URL),
                 $pool->get(COCKTAIL_API_URL),
                 $pool->get(COCKTAIL_API_URL),
                 $pool->get(COCKTAIL_API_URL),
             ];
         });
 
         // Extraemos el primer cóctel de cada respuesta
         $cocktails = collect($responses)
             ->map(function($response) {
                 return $response->json()['drinks'][0] ?? null;
             })
             ->filter() // Elimina nulos
             ->unique('idDrink') // Filtra duplicados basándose en el campo 'idDrink'
             ->values();
 
         // Si obtenemos menos de 6 cócteles únicos, seguimos pidiendo hasta alcanzar los 6
         while ($cocktails->count() < 6) {
             $response = Http::get(COCKTAIL_API_URL);
             $drink = $response->json()['drinks'][0] ?? null;
             if ($drink && !$cocktails->contains('idDrink', $drink['idDrink'])) {
                 $cocktails->push($drink);
             }
         }
 
         return view('cocktails.index', compact('cocktails'));
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


        public function categories()
        {
            // Realiza la petición a la API para obtener la lista de categorías
            $response = Http::get('https://www.thecocktaildb.com/api/json/v1/1/list.php?c=list');
    
            // Extrae la información, la API devuelve un array en 'drinks'
            $categories = $response->json()['drinks'] ?? [];
    
        }
}