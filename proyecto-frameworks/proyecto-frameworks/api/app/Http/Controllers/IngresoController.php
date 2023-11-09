<?php

namespace App\Http\Controllers;

use App\Models\Ingreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function select()
    {
        try {
            $ingresos = Ingreso::all();
            if ($ingresos->count() > 0) {
                return response()->json([
                    'code' => 200,
                    'data' => $ingresos
                ], 200);
            } else {
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay ingreso registrados'
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
                'categoria' => 'required',
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
                $ingreso = Ingreso::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Ingreso guardado'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }


    public function find($id)
    {
        try {
            // Se busca el ingreso
            $ingreso = Ingreso::find($id);
            if ($ingreso) {
                // Si el ingreso  existe se retornan sus datos
                $datos1 = Ingreso::select('ingreso.id', 'ingreso.categoria', 'ingreso.cantidad', 'ingreso.fecha')
                    ->where('ingreso.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos1[0]
                ], 200);
            } else {
                // Si el ingreso  no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Ingreso no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

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
                // Si se cumple la validación se busca el ingreso
                $ingreso = Ingreso::find($id);
                if ($ingreso) {
                    // Si el ingreso existe se actualiza
                    $ingreso->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Ingreso  actualizado'
                    ], 200);
                } else {
                    // Si el ingreso no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Ingreso no encontrado'
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
            // Se busca el dato del ingreso
            $ingreso = Ingreso::find($id);
            if ($ingreso) {
                // Si el ingreso existe se elimina
                $ingreso->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Ingreso eliminado'
                ], 200);
            } else {
                // Si el ingreso no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Ingreso no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
