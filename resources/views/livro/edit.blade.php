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
                        <h4>Editar Livro</h4>
                    </div>
                </div>
            </div>

            @if(session('status'))
                <div class="alert alert-success mb-1 mt-1">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('livro.update', $livro->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Título:</strong>
                            <input type="text" name="titulo" value="{{ $livro->titulo }}" class="form-control"
                                   placeholder="Título">
                            @error('título')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Editora:</strong>
                            <input type="text" name="editora" value="{{ $livro->editora }}" class="form-control"
                                   placeholder="Editora">
                            @error('editora')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Edição:</strong>
                            <input type="text" name="edicao" value="{{ $livro->edicao }}" class="form-control"
                                   placeholder="Edição">
                            @error('edicao')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Ano de Publicação:</strong>
                            <input type="text" name="ano_publicacao" value="{{ $livro->ano_publicacao }}"
                                   class="form-control"
                                   placeholder="Ano de Publicação">
                            @error('ano_publicacao')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Assuntos:</strong>
                            <select name="assuntos[]" class="form-control" multiple aria-label="Assuntos">
                                @php
                                    $arAssuntos = $livro->assuntos->toArray();
                                @endphp
                                @foreach ($assuntos as $assunto)
                                    @php
                                        $count = count(array_filter($arAssuntos, function($key) use ($assunto) { return $key['assunto_id'] == $assunto->id; }));
                                    @endphp
                                    <option value="{{ $assunto->id }}"
                                            @if($count > 0) selected @endif >{{ $assunto->descricao }}</option>
                                @endforeach
                            </select>
                            @error('assuntos')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <strong>Autores:</strong>
                            <select name="autores[]" class="form-control" multiple aria-label="Autores">
                                @php
                                    $arAutores = $livro->autores->toArray();
                                @endphp
                                @foreach ($autores as $autor)
                                    @php
                                        $count = count(array_filter($arAutores, function($key) use ($autor) { return $key['autor_id'] == $autor->id; }));
                                    @endphp
                                    <option value="{{ $autor->id }}"
                                            @if($count > 0) selected="selected" @endif >{{ $autor->nome }}</option>
                                @endforeach
                            </select>
                            @error('autores')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 mt-2">
                        <a class="btn btn-dark" href="{{ route('livro.index') }}"> Cancelar</a>
                        <button type="submit" class="btn btn-primary ml-3">Atualizar</button>
                    </div>
                </div>

            </form>
@stop
