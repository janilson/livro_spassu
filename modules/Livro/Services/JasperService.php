<?php

namespace Livro\Services;

use Illuminate\Support\Facades\Response;
use PHPJasper\PHPJasper;

define('source_path', 'app/report/source/MyReports/src');
define('compiled_path', 'app/report/compiled');
define('output_path', 'app/report/output');

class JasperService
{
    public function __construct(protected readonly PHPJasper $phpJasper)
    {
    }

    private $reports = ["expense" => "expense"];

    public function readFiles($path)
    {
        $files = [];
        foreach (new \DirectoryIterator($path) as $file) {
            if ($file->isFile()) {
                $files[$file->getFilename()] = $path . "/" . $file->getFilename();
            }
        }
        return $files;
    }

    public function updateReports($file = "")
    {
        $path = resource_path(source_path);
        if ($file != "") {
            $file .= ".jrxml";
            $file = $path . "/" . $file;
            if (file_exists($file)) {
                $this->compile($file);
                return "Build Successfully!";
            } else {
                return "Sorry! no Report file Found in " . $path;
            }
        } else {
            $reports = $this->readFiles($path);
            foreach ($reports as $key => $report) {
                $this->compile($report);
            }
            return "All Reports Build Successfully!";
        }
    }

    public function compile($input)
    {
        $output = resource_path(compiled_path);
        $this->phpJasper->compile($input, $output)->execute();
    }

    public function dir_check($path)
    {
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        return $path;
    }

    public function pdf($path, $filename)
    {
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    public function xlsx($path, $filename)
    {
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    public function csv($path, $filename)
    {
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    }

    public function html($path, $filename)
    {
        $content = file_get_contents($path);
        return view("report.jasper.preview")
            ->with('preview', $content)
            ->with('filter', str_replace('.html', '', $filename));
    }

    public function jasper($input, $output, $options, $template, $ext)
    {
        ini_set('max_execution_time', -1);

        $resp = $this->phpJasper->process(
            $input,
            $output,
            $options
        )->execute();

        $filename = $template . '.' . $ext;
        if ($resp == []) {
            switch ($ext) {
                case "pdf":
                    return $this->pdf($output . '/' . $filename, $filename);
                    break;
                case "xlsx":
                    return $this->xlsx($output . '/' . $filename, $filename);
                    break;
                case "csv":
                    return $this->csv($output . '/' . $filename, $filename);
                    break;
                case "html":
                    return $this->html($output . '/' . $filename, $filename);
                    break;

            }
        }
    }

    public function report($report, $ext = "pdf")
    {
        $src = resource_path(source_path);
        $reports = $this->readFiles($src);

        if (!isset($reports[$report . ".jrxml"])) {
            abort(404, 'Unauthorized action.');
            return false;
        }
        // dd($reports,$template);
//        $user = auth()->user();
//        $user_id = $user->id;
        // $business_id = $user->business_id;

        $input = resource_path(compiled_path) . '/' . $report . '.jasper';

        $output = $this->dir_check(resource_path(output_path) . "/user_");
        $options = [
            'locale' => 'pt_BR',
            'db_connection' => [
                'driver' => env('DB_CONNECTION'),
                'username' => env('DB_USERNAME'),
                'host' => env('DB_HOST'),
                'database' => env('DB_DATABASE'),
                'port' => env('DB_PORT')
            ]
        ];

        if (env('DB_PASSWORD') != null || env('DB_PASSWORD') != "") {
            $options["db_connection"]["password"] = env('DB_PASSWORD');
        }

        try {
            return $this->{$report}($input, $output, $options, $report, $ext);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function autores($input, $output, $options, $template, $ext)
    {

        $options["params"] = [
            // "business_id" => $user->business_id,
            // "start_date" => $daterange["start_date"],
            // "end_date" => $daterange["end_date"]
        ];
        $options["format"] = [$ext];
        // dd($options);
        return $this->jasper($input, $output, $options, $template, $ext);
    }
}
