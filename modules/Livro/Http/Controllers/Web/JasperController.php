<?php

namespace Livro\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Livro\Services\JasperService;

class JasperController extends Controller
{
    public function __construct(protected readonly JasperService $jasperService)
    {
    }

    public function report(string $name, ?string $ext = 'pdf')
    {
        return $this->jasperService->report($name, $ext);
    }
}
