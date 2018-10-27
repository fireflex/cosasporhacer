@extends('layouts.default')
@section('content')
<div class="row" style="margin-top: -50px;">
  <div class="col-lg-6">
    <div id="bienvenida">
      Bienvenido:  {{ Session::get('nombre') }}
    </div>
  </div>
  <div class="col-lg-6">
    <div id="logout">
      <a href="{{ url("/salir") }}" class="btn btn-md btn-danger" title="Salir">Salir</a>
    </div>
  </div>
</div>
<div class="row">
  <h3 class="text-center" style="margin-top: 0;">Mi lista de tareas</h3>
</div>
<div class="row" style="margin-bottom:30px;">
  <div class="col-md-4 col-lg-4 col-md-offset-8">
    <input type="text" name="filtro" placeholder="Buscar una tarea" id="filtro" class="form-control typeahead" data-provide="typeahead" autocomplete="off">
  </div>
</div>
<div class="jumbotron">
  <div class="row" style="margin-bottom: 20px;"> 
    <div class="col-md-10 col-lg-10 col-md-offset-2">
      <form  method="post" accept-charset="utf-8" id="crear-tarea" class="form-inline">
        <input type="text" name="tarea" class="form-control" placeholder="Agregar nueva tarea"  style="width: 500px;" required>
        <select name="categoria" id="categoria" class="form-control" required>
          <option value="">Selecciona una categoria</option>
          @foreach ($categorias as $categoria)
          <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
          @endforeach
        </select>
        <input type="submit" name="agregar" value="Agregar" class="btn btn-primary">
      </form>
    </div>
  </div>
  <div class="row"> 
    <div class="col-md-10 col-lg-11 col-md-offset-3">
      <ul id="lista-tareas">
       @foreach ($tareas as $tarea)
       
       <li @if ($tarea->realizada) == 1) style="text-decoration:line-through;" @endif>
        <input type="checkbox" name="tarea" value="{{$tarea->id}}" class="marcar-tarea" title="Marcar como realizado" @if ($tarea->realizada) == 1) checked @endif>
        {{ $tarea->tarea}} <span class="badge" style="background:{{$tarea->categoria->color}}">{{ $tarea->categoria->nombre}}</span>  <a href="#" id="{{$tarea->id}}" title="Eliminar tarea" class="btn btn-circulo btn-danger eliminar">X</a></li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@stop

