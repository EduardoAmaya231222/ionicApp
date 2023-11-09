<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function select()
    {
        try {
            $categorias = Categoria::all();
            if ($categorias->count() > 0) {
                return response()->json([
                    'code' => 200,
                    'data' => $categorias
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay categorias registradas'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    public function store(Request $request)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'categoria' => 'required',

            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se inserta la categoria
                $categoria = Categoria::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Categoria guardada'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function find($id)
    {
        try {
            // Se busca la categoria
            $categoria = Categoria::find($id);
            if ($categoria) {
                // Si la categoria  existe se retornan sus datos
                $datos = Categoria::select('categoria.id', 'categoria.categoria',)
                    ->where('categoria.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ], 200);
            } else {
                // Si la categoria  no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Categoria no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'categoria' => 'required',

            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se busca la categoria
                $categoria = Categoria::find($id);
                if ($categoria) {
                    // Si la categoria existe se actualiza
                    $categoria->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Categoria  actualizada'
                    ], 200);
                } else {
                    // Si la categoria no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Categoria no encontrada'
                    ], 404);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            // Se busca la categoria
            $categoria = Categoria::find($id);
            if ($categoria) {
                // Si la categoria existe se elimina
                $categoria->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Categoria eliminada'
                ], 200);
            } else {
                // Si la categoria no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Categoria no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
