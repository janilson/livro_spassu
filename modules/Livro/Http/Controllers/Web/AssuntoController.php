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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assunto.create');
    }

    /**
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
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $assunto = $this->assuntoService->assunto($id);

        return view('assunto.show', compact('assunto'));
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $assunto = $this->assuntoService->assunto($id);

        return view('assunto.edit', compact('assunto'));
    }

    /**
     * @param \Livro\Http\Requests\AssuntoRequest $request
     * @param int $id
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
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $type = 'success';
        $msg = 'Assunto removido com sucesso.';

        try {
            $this->assuntoService->deletar($id);
        } catch (\Exception $exception) {
            $type = 'error';
            $msg = $exception->getMessage();
        }

        return redirect()->route('assunto.index')
            ->with($type, $msg);
    }
}
