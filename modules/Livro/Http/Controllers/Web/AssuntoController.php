<?php

namespace Livro\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Livro\Http\Requests\AssuntoRequest;
use Livro\Models\Assunto;
use Livro\Services\Interfaces\IAssuntoService;

class AssuntoController extends Controller
{
    public function __construct(protected IAssuntoService $assuntoService)
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
        $data['assuntos'] = $this->assuntoService->assuntos($request->all());

        return view('assunto.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assunto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Livro\Http\Requests\AssuntoRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(AssuntoRequest $request)
    {
        $assunto = $this->assuntoService->cadastrar($request->except(['_token']));

        return redirect()->route('assunto.index')
            ->with('success', 'Assunto cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param \Livro\Models\Assunto $assunto
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Assunto $assunto)
    {
        return view('assunto.show', compact('assunto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Livro\Models\Assunto $assunto
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $assunto = $this->assuntoService->assunto($id);

        return view('assunto.edit', compact('assunto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Livro\Http\Requests\AssuntoRequest $request
     *
     * @param \Livro\Models\Assunto $assunto
     *
     * @return \Illuminate\Http\Response
     */
    public function update(AssuntoRequest $request, $id)
    {
        $assunto = $this->assuntoService->editar($id, $request->all());

        return redirect()->route('assunto.index')
            ->with('success', 'Assunto atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Livro\Models\Assunto $assunto
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assunto $assunto)
    {
        $assunto->delete();

        return redirect()->route('assunto.index')
            ->with('success', 'Assunto removido com sucesso.');
    }
}
