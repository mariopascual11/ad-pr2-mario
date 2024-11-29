<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;


class CsvController extends Controller
{
   public function index(): JsonResponse
   {
       $files = Storage::files(); // Obtiene todos los archivos en storage/app.
       $csvFiles = array_filter($files, fn($file) => pathinfo($file, PATHINFO_EXTENSION) === 'csv');


       return response()->json([
           'mensaje' => 'Listado de ficheros',
           'contenido' => array_values($csvFiles), // Devuelve solo archivos CSV.
       ], 200);
   }


   public function store(Request $request): JsonResponse
   {
       $filename = $request->input('filename');
       $content = $request->input('content');


       if (!$filename || !$content) {
           return response()->json(['mensaje' => 'Faltan parámetros'], 422);
       }


       if (Storage::exists($filename)) {
           return response()->json(['mensaje' => 'El fichero ya existe'], 409);
       }


       Storage::put($filename, $content);


       return response()->json(['mensaje' => 'Guardado con éxito'], 200);
   }

   public function show(string $id)
{
    // Verificar si el archivo existe en el almacenamiento
    if (!Storage::exists($id)) {
        return response()->json(['mensaje' => 'Fichero no encontrado'], 404);
    }

    // Obtener el contenido del archivo
    $content = Storage::get($id);

    // Dividir el contenido en líneas
    $lines = explode("\n", trim($content));
    
    if (count($lines) < 2) {
        return response()->json([
            'mensaje' => 'El fichero no contiene datos válidos',
            'contenido' => [],
        ]);
    }

    // Procesar el encabezado y los datos del CSV
    $headers = str_getcsv(array_shift($lines));
    $data = array_map(fn($line) => array_combine($headers, str_getcsv($line)), $lines);

    // Responder con el contenido del archivo CSV
    return response()->json([
        'mensaje' => 'Fichero leído con éxito',
        'contenido' => $data,
    ]);
}


public function update(Request $request, string $id)
{
   $path = "app/{$id}";


   if (!Storage::exists($path)) {
       return response()->json(['mensaje' => 'Fichero no encontrado'], 404);
   }


   $content = $request->input('content');


   if (!$content || !is_string($content)) {
       return response()->json(['mensaje' => 'Contenido inválido'], 422);
   }


   Storage::put($path, $content);


   return response()->json(['mensaje' => 'Fichero actualizado exitosamente']);
}




public function destroy(string $id)
{
   $path = "app/{$id}";


   if (!Storage::exists($path)) {
       return response()->json(['mensaje' => 'Fichero no encontrado'], 404);
   }


   Storage::delete($path);


   return response()->json(['mensaje' => 'Fichero eliminado exitosamente']);
}


}
