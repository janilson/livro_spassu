@extends('template')
@section('conteudo')
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2 class="text-decoration-underline">Teste Técnico - Spassu</h2>
                </div>
                <div class="pull-left mb-2">
                    <h4>Livros
                        <div class="float-lg-end mb-2">
                            <a class="btn btn-success" href="{{ route('livro.create') }}"> Novo</a>
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

        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Editora</th>
                <th>Edição</th>
                <th>Valor (R$)</th>
                <th>Ano Publi.</th>
                <th width="180px">Ações</th>
            </tr>
            @foreach ($livros as $livro)
                <tr>
                    <td>{{ $livro->id }}</td>
                    <td>{{ $livro->titulo }}</td>
                    <td>{{ $livro->editora }}</td>
                    <td>{{ $livro->edicao }}</td>
                    <td>{{ $livro->valor }}</td>
                    <td>{{ $livro->ano_publicacao }}</td>
                    <td>
                        <form action="{{ route('livro.destroy',$livro->id) }}" method="Post">

                            <a class="btn btn-primary" title="Editar" href="{{ route('livro.edit',$livro->id) }}"><i
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

    {!! $livros->links() !!}
@stop
