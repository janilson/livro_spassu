@extends('template')
@section('conteudo')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="text-decoration-underline">Teste Técnico - Spassu</h2>
                </div>
                <div class="pull-left mb-2">
                    <h4>Autores
                        <div class="float-lg-end mb-2">
                            <a class="btn btn-success" href="{{ route('autor.create') }}"> Novo</a>
                        </div>
                    </h4>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th width="180px">Ações</th>
            </tr>
            @foreach ($autores as $autor)
                <tr>
                    <td>{{ $autor->id }}</td>
                    <td>{{ $autor->nome }}</td>
                    <td>
                        <form action="{{ route('autor.destroy',$autor->id) }}" method="Post">

                            <a class="btn btn-primary" title="Editar" href="{{ route('autor.edit',$autor->id) }}"><i
                                    class="bi bi-pencil-square"></i></a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger remove-button" title="Excluir"><i class="bi bi-x-circle"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

    {!! $autores->links() !!}
@stop
