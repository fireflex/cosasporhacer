<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Tarea;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TareaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!session('logueado')) {
         return redirect()->action('UsuarioController@index');
     }

     $categorias = Categoria::all();
     $tareas = Tarea::all();
     return \View::make("tareas.lista")->with(['categorias'=>$categorias, "tareas" => $tareas]);
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tarea = $request->input('tarea');
        $categoria_id = $request->input('categoria');

        $tareaModel = new Tarea;
        $tareaModel->tarea = $tarea;
        $tareaModel->categoria_id = $categoria_id;
        $tareaModel->usuario_id = session('usuarioId');

        if($tareaModel->save()){
            $tareaId = $tareaModel->id;
            $tarea = Tarea::find($tareaId);
            $categoria= $tarea->categoria->nombre;
            $color = $tarea->categoria->color;
            $template = "";
            $template .= "<li>
            <input type='checkbox' name='tarea' class='marcar-leido' title='Marcar como realizado'>
            $tarea->tarea <span class='badge' style='background:$color'>$categoria</span> 
            <a href='#' title='Eliminar tarea' class='btn btn-circulo btn-danger'>X</a>
            </li>";
            

            return response()->json(['type'=> 'success', 'message' => 'Has agregado una tarea', 'datos' => $template]);
        }

        return response()->json(['type'=> 'error', 'message' => 'Ha ocurrido un error']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function status(Request $request)
    {
       $tareaId = $request->input('valor');
       $marcado = (boolean)$request->input('marcado');

       $tareaModel = Tarea::find($tareaId);
       $tareaModel->realizada = 0;
       if($marcado){
        $tareaModel->realizada = 1;
    } 
    $tareaModel->save();
    return response()->json(['type'=> 'success', 'message' => 'Tarea marcada como Realizada']);

}


public function search(Request $request)
{
    $cadena = $request->input('cadena');
    $tareas = DB::table('tareas')
    ->join('categorias', 'categorias.id', '=', 'tareas.categoria_id')
    ->where('tarea', 'like', '%'.$cadena)
    ->get();
    $arr = [];
    foreach ($tareas as $tarea) {
        $arr[] = $tarea->tarea.' - '.$tarea->nombre;
    }
    return response()->json([$arr]);
}

public function destroy(Request $request)
{
    $tareaId = $request->input('id');
    $tareaModel = Tarea::find($tareaId);
    if($tareaModel->delete()){
     return response()->json(['type'=> 'success', 'message' => 'Tarea Borrada']); 
 }

}

}
