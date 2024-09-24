@extends('template')
@section('conteudo')
    <div class="container mt-2">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <div class="pull-left">
                        <h2 class="text-decoration-underline">Teste Técnico - Spassu</h2>
                    </div>
                    <div class="pull-left mb-2">
                        <h4>Editar Assunto</h4>
                    </div>
                </div>
            </div>

            @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('assunto.update', $assunto->id) }}" method="PUT" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Descrição:</strong>
                            <input type="text" name="descricao" value="{{ $assunto->descricao }}" class="form-control"
                                   placeholder="Descrição">
                            @error('descricao')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 mt-2">
                        <a class="btn btn-dark" href="{{ route('assunto.index') }}"> Cancelar</a>
                        <button type="submit" class="btn btn-primary ml-3">Atualizar</button>
                    </div>
                </div>

            </form>
@stop
