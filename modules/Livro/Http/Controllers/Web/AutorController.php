<?php

namespace Livro\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Livro\Http\Requests\AutorRequest;
use Livro\Models\Autor;
use Livro\Services\Interfaces\IAutorService;

class AutorController extends Controller
{
    public function __construct(protected IAutorService $autorService)
    {
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['autores'] = $this->autorService->autores($request->all());

        return view('autor.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('autor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Livro\Http\Requests\AutorRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AutorRequest $request)
    {
        $autor = $this->autorService->cadastrar($request->except(['_token']));

        return redirect()->route('autor.index')
            ->with('success', 'Autor cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param \Livro\Models\Autor $autor
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Autor $autor)
    {
        return view('autor.show', compact('autor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Livro\Models\Autor $autor
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $autor = $this->autorService->autor($id);

        return view('autor.edit', compact('autor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Livro\Http\Requests\AutorRequest $request
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AutorRequest $request, int $id)
    {
        $this->autorService->editar($id, $request->all());

        return redirect()->route('autor.index')
            ->with('success', 'Autor atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $type = 'success';
        $msg = 'Autor removido com sucesso.';

        try {
            $this->autorService->deletar($id);
        } catch (\Exception $exception) {
            $type = 'error';
            $msg = $exception->getMessage();
        }

        return redirect()->route('autor.index')
            ->with($type, $msg);
    }
}
