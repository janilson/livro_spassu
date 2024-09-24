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
                        <h4>Novo Livro</h4>
                    </div>
                </div>
            </div>

            @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('livro.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Título:</strong>
                            <input type="text" name="titulo" class="form-control" placeholder="Título">
                            @error('titulo')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Editora:</strong>
                            <input type="text" name="editora" class="form-control" placeholder="Editora">
                            @error('editora')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Edição:</strong>
                            <input type="text" name="edicao" class="form-control" placeholder="Edição">
                            @error('edicao')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Ano de Publicação:</strong>
                            <input type="text" name="ano_publicacao" class="form-control"
                                   placeholder="Ano de Publicação">
                            @error('ano_publicacao')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Assuntos:</strong>
                            <select name="assuntos[]" class="form-control" multiple aria-label="Assuntos">
                                @foreach ($assuntos as $assunto)
                                    <option value="{{ $assunto->id }}">{{ $assunto->descricao }}</option>
                                @endforeach
                            </select>
                            @error('assuntos')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Autores:</strong>
                            <select name="autores[]" class="form-control" multiple aria-label="Autores">
                                @foreach ($autores as $autor)
                                    <option value="{{ $autor->id }}">{{ $autor->nome }}</option>
                                @endforeach
                            </select>
                            @error('autores')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 mt-2">
                        <a class="btn btn-dark" href="{{ route('livro.index') }}"> Cancelar</a>
                        <button type="submit" class="btn btn-primary ml-3">Cadastrar</button>
                    </div>
                </div>

            </form>
@stop
