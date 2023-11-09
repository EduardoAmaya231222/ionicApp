<?php

namespace App\Http\Controllers;

use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function select()
    {
        try {
            $gastos = Gasto::all();
            if ($gastos->count() > 0) {
                return response()->json([
                    'code' => 200,
                    'data' => $gastos
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay gastos registrados'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'categoria_id' => 'required',
                'cantidad' => 'required',
                'tipo' => 'required',
                'fecha' => 'required'

            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se inserta el cliente
                $gasto = Gasto::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Gasto guardado'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    public function find($id)
    {
        try {
            // Se busca el gasto
            $gasto = Gasto::find($id);
            if ($gasto) {
                // Si el gasto  existe se retornan sus datos
                $datos = Gasto::select('gasto.id', 'gasto.categoria', 'gasto.cantidad', 'gasto.fecha')
                    ->where('gasto.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ], 200);
            } else {
                // Si el gasto  no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Gasto no encontrado'
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
                // Si se cumple la validación se busca el gasto
                $gasto = Gasto::find($id);
                if ($gasto) {
                    // Si el gasto existe se actualiza
                    $gasto->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Gasto  actualizado'
                    ], 200);
                } else {
                    // SSi el gasto no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Gasto no encontrado'
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
            // Se busca el dato de gasto
            $gasto = Gasto::find($id);
            if ($gasto) {
                // Si el gasto existe se elimina
                $gasto->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Gasto eliminado'
                ], 200);
            } else {
                // Si el gasto no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Gasto no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
