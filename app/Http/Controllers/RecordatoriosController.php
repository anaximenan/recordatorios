<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recordatorio;
use Illuminate\Support\Facades\DB;


class RecordatoriosController extends Controller
{
    public function index()
    {

        $recordatorios = Recordatorio::where('receptores', 'like', '%softtek.com')->get();
        $id = $recordatorios[0]['id'];
        return view('recordatorios', ['recordatorios' => $recordatorios, 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        try{
            // Encuentra el recordatorio por su ID
            $recordatorio = Recordatorio::findOrFail($id);


            // Actualiza los atributos del recordatorio
            $recordatorio->fecha = $request->fecha;
            $recordatorio->descripcion = $request->descripcion;
            $recordatorio->recordatorio = $request->recordatorio;
            $recordatorio->receptores = $request->receptores;
            $recordatorio->fecha_recordar = $request->fecha_recordar;
            $recordatorio->estatus = $request->estatus;

            // Guarda los cambios en la base de datos
            $recordatorio->save();

            // Retorna una respuesta JSON indicando que la actualización fue exitosa
            return response()->json(['success' => true, 'message' => 'Registro actualizado exitosamente']);
        }catch(\Exception $e){
            return response()->json(['data'=>$e->getMessage()],422);
        }
    }

    public function store(Request $request)
    {
        try {
            // Crear un nuevo objeto Recordatorio con los datos recibidos del formulario
            $recordatorio = new Recordatorio();
            $recordatorio->fecha = $request->input('fecha_new');
            $recordatorio->descripcion = $request->input('descripcion_new');
            $recordatorio->recordatorio = $request->input('recordatorio_new');
            $recordatorio->receptores = $request->input('receptores_new');
            $recordatorio->fecha_recordar = $request->input('fecha_recordar_new');
            $recordatorio->estatus = $request->input('estatus_new');

            // Guardar el nuevo recordatorio en la base de datos
            $recordatorio->save();

            // Redireccionar a la vista de recordatorios con un mensaje de éxito
            return redirect()->route('recordatorios.list')->with('success', 'El recordatorio se ha creado correctamente.');
        } catch (\Exception $e) {
            // Si ocurre un error, redireccionar a la vista anterior con un mensaje de error
            return back()->withInput()->with('error', 'Ha ocurrido un error al crear el recordatorio: ' . $e->getMessage());
        }
    }

}
