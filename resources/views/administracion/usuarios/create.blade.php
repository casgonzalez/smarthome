@extends('layouts.layout_01')

@section('title','Home')

@section('style_css')

@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12">
                @if(Session::has('status_warning'))
                    <div class="alert alert-warning">
                        <strong>{{Session::get('status_warning')}}</strong>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">
                        <span class="text-uppercase font-weight-bold">Registra nuevo usuario</span>
                    </div>
                    <div class="card-body">
                        <form class="" action="{{asset('administracion/usuarios')}}" method="post">
                            @csrf
                            @include('administracion.usuarios.form',['profile'=>false])
                            <button type="submit" name="button" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus-circle"></i>
                                Guardar
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('script_js')

@stop
