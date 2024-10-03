@extends('template')
@section('conteudo')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="text-decoration-underline">Teste Técnico - Spassu</h2>
                </div>
                <div class="pull-left mb-2">
                    <h4>Assuntos
                        <div class="float-lg-end mb-2">
                            <a class="btn btn-success" href="{{ route('assunto.create') }}"> Novo</a>
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
                <th>Descrição</th>
                <th width="180px">Ações</th>
            </tr>
            @foreach ($assuntos as $assunto)
                <tr>
                    <td>{{ $assunto->id }}</td>
                    <td>{{ $assunto->descricao }}</td>
                    <td>
                        <form action="{{ route('assunto.destroy',$assunto->id) }}" method="Post">

                            <a class="btn btn-primary" title="Editar" href="{{ route('assunto.edit',$assunto->id) }}"><i
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

    {!! $assuntos->links() !!}
@stop
