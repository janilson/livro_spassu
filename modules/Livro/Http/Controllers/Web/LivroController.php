<?php

namespace Livro\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Livro\Http\Requests\LivroRequest;
use Livro\Models\Livro;
use Livro\Services\Interfaces\IAssuntoService;
use Livro\Services\Interfaces\IAutorService;
use Livro\Services\Interfaces\ILivroService;

class LivroController extends Controller
{
    protected array $all = ['all' => 1];

    public function __construct(
        protected IAssuntoService $assuntoService,
        protected IAutorService $autorService,
        protected ILivroService $livroService,
    ) {
    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['livros'] = $this->livroService->livros($request->all());

        return view('livro.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assuntos = $this->assuntoService->assuntos($this->all);
        $autores = $this->autorService->autores($this->all);

        return view('livro.create', compact('assuntos', 'autores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Livro\Http\Requests\LivroRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LivroRequest $request)
    {
        $livro = $this->livroService->cadastrar($request->except(['_token']));

        return redirect()->route('livro.index')
            ->with('success', 'Livro cadastrado com sucesso.');
    }

    /**
     * Display the specified resource.
     *
     * @param \Livro\Models\Livro $livro
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Livro $livro)
    {
        return view('livro.show', compact('livro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Livro\Models\Livro $livro
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $livro = $this->livroService->livro($id);
        $assuntos = $this->assuntoService->assuntos($this->all);
        $autores = $this->autorService->autores($this->all);

        return view('livro.edit', compact('livro', ['assuntos', 'autores']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Livro\Http\Requests\LivroRequest $request
     *
     * @param \Livro\Models\Livro $livro
     *
     * @return \Illuminate\Http\Response
     */
    public function update(LivroRequest $request, $id)
    {
        $livro = $this->livroService->editar($id, $request->all());

        return redirect()->route('livro.index')
            ->with('success', 'Livro atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Livro\Models\Livro $livro
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro $livro)
    {
        $livro->delete();

        return redirect()->route('livro.index')
            ->with('success', 'Livro removido com sucesso.');
    }
}
