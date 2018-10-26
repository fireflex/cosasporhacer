@extends('layouts.default')
@section('content')
<div class="col-md-5 col-lg-5 col-md-offset-3">
<form id="login">
            <div class="form-group">
              <label for="usuario">Usuario:</label>
              <input type="text" class="form-control" id="usuario" required>
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" required>
            </div>
            <input type="submit" name="ingresar" value="Ingresar" class="btn btn-success">
          </form>
</div>
@stop

