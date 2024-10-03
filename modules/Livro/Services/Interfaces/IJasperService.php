<?php

namespace Livro\Services\Interfaces;

interface IJasperService
{
    public function readFiles($path);

    public function updateReports($file = "");

    public function compile($input);

    public function dirCheck($path);

    public function pdf($path, $filename);

    public function xlsx($path, $filename);

    public function csv($path, $filename);

    public function html($path, $filename);

    public function jasper($input, $output, $options, $template, $ext);

    public function report($report, $ext = "pdf");
}
