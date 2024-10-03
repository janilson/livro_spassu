<?php

namespace App\Helper;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Helper
{

    public static function gerarSenha($qtyCaraceters = 6)
    {
        $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');
        $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;
        $characters = $capitalLetters . $smallLetters . $numbers;
        $password = substr(str_shuffle($characters), 0, $qtyCaraceters);

        return $password;
    }

    public static function tratamentoDados($dados)
    {
        foreach ($dados as $key => $val) {
            switch ($key) {
                case 'nu_cpf':
                    $dados['nu_cpf'] = preg_replace("/[^0-9]/", "", $val);
                    break;
                case 'conj_nu_cpf':
                    $dados['conj_nu_cpf'] = preg_replace("/[^0-9]/", "", $val);
                    break;
                case 'nu_cnpj':
                    $dados['nu_cnpj'] = preg_replace("/[^0-9]/", "", $val);
                    break;
                case 'dt_nascimento':
                    $dados['dt_nascimento'] = Carbon::parse($val)->format('Y-m-d');
                    break;
                case 'conj_dt_nascimento':
                    $dados['conj_dt_nascimento'] = Carbon::parse($val)->format('Y-m-d');
                    break;
                case 'dt_fundacao':
                    $dados['dt_fundacao'] = Carbon::parse($val)->format('Y-m-d');
                    break;
                case 'conselho_regional':
                    if (isset($dados['conselho_regional']['id'])) {
                        $dados['conselho_regional_id'] = $dados['conselho_regional']['id'];
                        unset($dados['conselho_regional']);
                    }
                    break;
            }
        }
        return $dados;
    }

    public static function removerCaracteres($val)
    {
        return preg_replace("/[^0-9]/", "", $val);
    }

    public static function validarCpfCnpj($documento)
    {
        $document = new ValidaCpfCnpj($documento);
        return $document;
    }

    public static function tratamentoDadosContrato($dados)
    {
        foreach ($dados as $key => $val) {
            switch ($key) {
                //case 'cli_nu_cpf_cnpj':
                //    $dados['cli_nu_cpf_cnpj'] = preg_replace("/[^0-9]/", "", $val);
                //    break;
                //case 'cli_nu_cpf_conjugue':
                //    $dados['cli_nu_cpf_conjugue'] = preg_replace("/[^0-9]/", "", $val);
                //    break;
                case 'cor_nu_cpf':
                    $dados['cor_nu_cpf'] = preg_replace("/[^0-9]/", "", $val);
                    break;
                case 'nu_cnpj':
                    $dados['nu_cnpj'] = preg_replace("/[^0-9]/", "", $val);
                    break;
                //case 'cli_dt_nascimento':
                //        $dados['cli_dt_nascimento'] =  Carbon::parse($val)->format('Y-m-d');
                //    break;
                //case 'conj_dt_nascimento':
                //        $dados['conj_dt_nascimento'] =   Carbon::parse($val)->format('Y-m-d');
                //    break;
                case 'updated_at':
                    $dados['updated_at'] = Carbon::parse(Carbon::now())->format('Y-m-d H:i:s');
                    break;
                case 'tipo_contrato':
                    $dados['tipo_contrato'] = json_encode($dados['tipo_contrato']);
                    break;
                case 'cor_dt_nascimento':
                    $dados['cor_dt_nascimento'] = Carbon::parse($val)->format('Y-m-d');
                    break;
                //case 'cli_conj_dt_nascimento':
                //    $dados['cli_conj_dt_nascimento'] =  Carbon::parse($val)->format('Y-m-d');
                //    break;
                case 'socios':
                    $dados['js_cli_socios'] = $val != '[]' || is_null($val) || empty($val) ? '' : json_encode($val);
                    break;
                // case 'fator_reajuste':
                //     if(isset($dados['fator_reajuste']['id'])){
                //         $dados['fator_reajuste_id'] = $dados['fator_reajuste']['id'];
                //     }
                //     break;
                case 'dt_agendamento':
                    $dados['dt_agendamento'] = Carbon::parse($val)->format('Y-m-d H:i:s');
                    break;
                case 'dt_inicio_vingencia':
                    $dados['dt_inicio_vingencia'] = Carbon::parse($val)->format('Y-m-d');
                    break;
                case 'dt_saida_estagio':
                    $dados['dt_saida_estagio'] = Carbon::parse($val)->format('Y-m-d');
                    break;
            }
        }

        return $dados;
    }

    public static function tratamentoDadosClienteContrato($dados)
    {
        foreach ($dados as $key => $val) {
            switch ($key) {
                case 'cli_nu_cpf_cnpj':
                    $dados['cli_nu_cpf_cnpj'] = preg_replace("/[^0-9]/", "", $val);
                    break;
                case 'cli_nu_cpf_conjugue':
                    $dados['cli_nu_cpf_conjugue'] = preg_replace("/[^0-9]/", "", $val);
                    break;
                case 'cli_dt_nascimento':
                    $dados['cli_dt_nascimento'] = empty($val) || is_null($val) ? null : Carbon::parse($val)->format(
                        'Y-m-d'
                    );
                    break;
                case 'updated_at':
                    $dados['updated_at'] = Carbon::parse(Carbon::now())->format('Y-m-d H:i:s');
                    break;
                case 'cli_conj_dt_nascimento':
                    $dados['cli_conj_dt_nascimento'] = empty($val) || is_null($val) ? null : Carbon::parse(
                        $val
                    )->format('Y-m-d');
                    break;
                case 'js_cli_socios':
                    $dados['js_cli_socios'] = $val;
                    break;
                case 'dt_nascimento':
                    $dados['dt_nascimento'] = empty($val) || is_null($val) ? null : Carbon::parse($val)->format(
                        'Y-m-d'
                    );
                    break;
                case 'trash_at':
                    $dados['trash_at'] = empty($val) || is_null($val) ? null : Carbon::parse($val)->format('Y-m-d');
                    break;
            }
        }

        return $dados;
    }

    public static function checkChaveArray($chave)
    {
        if (isset($chave)) {
            return $chave;
        } else {
            return '';
        }
    }

    public static function md5DataAtual($val)
    {
        $dt = Carbon::now()->format('Ymd') . $val;

        return md5($dt);
    }

    public static function retornaParteData($data, $parte)
    {
        $retorno = "";
        if ($parte == 'm') {
            $mes = Carbon::parse($data)->format('m');
            switch ($mes) {
                case 1:
                    $retorno = "Janeiro";
                    break;
                case 2:
                    $retorno = "Fevereiro";
                    break;
                case 3:
                    $retorno = "Março";
                    break;
                case 4:
                    $retorno = "Abril";
                    break;
                case 5:
                    $retorno = "Maio";
                    break;
                case 6:
                    $retorno = "Junho";
                    break;
                case 7:
                    $retorno = "Julho";
                    break;
                case 8:
                    $retorno = "Agosto";
                    break;
                case 9:
                    $retorno = "Setembro";
                    break;
                case 10:
                    $retorno = "Outubro";
                    break;
                case 11:
                    $retorno = "Novembro";
                    break;
                case 12:
                    $retorno = "Dezembro";
                    break;
            }
        }

        return $retorno;
    }

    public static function formataCnpjCpf($value)
    {
        $CPF_LENGTH = 11;
        $cnpj_cpf = preg_replace("/\D/", '', $value);

        if (strlen($cnpj_cpf) === $CPF_LENGTH) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        }

        return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
    }

    public static function formataDataDMY($data)
    {
        if ($data != null && !empty($data)) {
            $data = Carbon::parse($data)->format('d') . '-' . Carbon::parse($data)->format('m') . '-' . Carbon::parse(
                    $data
                )->format('Y');
        }
        return $data;
    }

    public static function formataDataYMD($data)
    {
        if ($data != null && !empty($data)) {
            $data = Carbon::parse($data)->format('Y') . '-' . Carbon::parse($data)->format('m') . '-' . Carbon::parse(
                    $data
                )->format('d');
        }
        return $data;
    }

    public static function removerAcentos($string)
    {
        return preg_replace(
            array(
                "/(á|à|ã|â|ä)/",
                "/(Á|À|Ã|Â|Ä)/",
                "/(é|è|ê|ë)/",
                "/(É|È|Ê|Ë)/",
                "/(í|ì|î|ï)/",
                "/(Í|Ì|Î|Ï)/",
                "/(ó|ò|õ|ô|ö)/",
                "/(Ó|Ò|Õ|Ô|Ö)/",
                "/(ú|ù|û|ü)/",
                "/(Ú|Ù|Û|Ü)/",
                "/(ñ)/",
                "/(Ñ)/",
                "/(ç)/",
                "/(Ç)/"
            ),
            explode(" ", "a A e E i I o O u U n N c C"),
            $string
        );
    }

    public static function gerarCodigo($qtyCaraceters = 6)
    {
        $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
        $numbers .= 1234567890;
        $nuCodigo = substr(str_shuffle($numbers), 0, $qtyCaraceters);

        return $nuCodigo;
    }

    public static function formataDataHoraPadrao($data)
    {
        $dataR = $data;
        if ($data != null && !empty($data) && strlen($data) >= 10) {
            $datap = explode("-", $data);
            if (strlen($datap[0]) > 2) {
                $dataR = substr($datap[2], 0, 2) . '-' . $datap[1] . '-' . $datap[0];
            } else {
                $dataR = $datap[0] . '-' . $datap[1] . '-' . substr($datap[2], 0, 4);
            }

            if (strlen($data) > 10) {
                $dataR .= substr($data, 10);
            }
        }
        return $dataR;
    }

    public static function tratamentoMoeda($p_valor)
    {
        if (!is_null($p_valor) && !empty($p_valor)) {
            $p_valor = str_replace(",", ".", str_replace(".", "", $p_valor));
            $p_valor = number_format((float)$p_valor, 2, '.', '');
        } else {
            $p_valor = 0;
        }
        return $p_valor;
    }

    public static function gerarQrdBase64($mensagem)
    {
        $nmfile = md5(Str::uuid() . time());

        QRcode::png($mensagem, config('api.app_local_storage') . '/contrato/qrcode/' . $nmfile . '.png');

        $qrcode = base64_encode(Storage::disk('local')->get('contrato/qrcode/' . $nmfile . '.png'));

        Storage::disk('local')->delete('contrato/qrcode/' . $nmfile . '.png');

        return $qrcode;
    }

    public static function formataTelefone($telefone)
    {
        if (is_null($telefone) || empty($telefone)) {
            return '';
        } else {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 3, 4) . '-' . substr($telefone, 5);
        }
    }

    public static function formataIptu($iptu)
    {
        if (is_null($iptu) || empty($iptu)) {
            return '';
        } else {
            // Formato esperado: #.##.###.####.###.#
            return substr($iptu, 0, 1) . '.' .
                substr($iptu, 1, 2) . '.' .
                substr($iptu, 3, 3) . '.' .
                substr($iptu, 6, 4) . '.' .
                substr($iptu, 10, 3) . '.' .
                substr($iptu, 13, 1);
        }
    }

    public static function exibirTextoFolhadeRosto($modeloContrato, $hashBlock)
    {
        $menssagem = '';
        if ($modeloContrato == ModeloContratoEnum::CONTRATO_DE_AUTORIZACAO->value
            || $modeloContrato == ModeloContratoEnum::CONTRATO_DE_COMPRA_E_VENDA->value
            || $modeloContrato == ModeloContratoEnum::CONTRATO_DE_ALUGUEL->value
            || $modeloContrato == ModeloContratoEnum::CONTRATO_DE_FIANCA_LOCATICIA->value
            || $modeloContrato == ModeloContratoEnum::CPII->value
            || $modeloContrato == ModeloContratoEnum::DOCUMENTO_DE_INTERESSE_NEGOCIAL->value
        ) {
            $menssagem = 'Este documento está assegurado pela tecnologia Blockchain - HASH:' . $hashBlock;
        }

        if ($modeloContrato == ModeloContratoEnum::DOCUMENTO_DE_VISITA_PRESENCIAL->value
            || $modeloContrato == ModeloContratoEnum::DOCUMENTO_DE_INTERESSE_GERAL->value
            || $modeloContrato == ModeloContratoEnum::PTAM->value
            || $modeloContrato == ModeloContratoEnum::RTEC->value
            || $modeloContrato == ModeloContratoEnum::LAUDO_DE_VISTORIA_DE_ENTREGA->value
            || $modeloContrato == ModeloContratoEnum::LAUDO_DE_VISTORIA_DE_RECEBIMENTO->value
            || $modeloContrato == ModeloContratoEnum::CONTRATO_DE_ESTAGIO->value
            || $modeloContrato == ModeloContratoEnum::OUTROS->value
        ) {
            $menssagem = 'Este documento está assegurado pela tecnologia CF LEDGER - HASH:' . $hashBlock;
        }
        return $menssagem;
    }

    public static function getClienteTipoContrato($clientes, int $tipo_cliente_contrato)
    {
        foreach ($clientes as $cliente) {
            if ($cliente->tipo_cliente_contrato_id == $tipo_cliente_contrato) {
                return $cliente->cli_no_cliente;
            }
        }

        return '';
    }

    public static function formatarMonetario(string $valor): float
    {
        return (float)str_replace(",", ".", str_replace(".", "", trim(str_replace("R$", "", $valor))));
    }

    public static function formatarDataBanco(string $data): string
    {
        return implode("-", array_reverse(explode('/', $data)));
    }

    public static function formatarValorBR(float $valor, bool $real = true): string
    {
        $fmt = new \NumberFormatter('pt_BR', \NumberFormatter::CURRENCY);
        $valorReal = $fmt->formatCurrency($valor, "BRL");

        return $real ? $valorReal : trim(str_replace('\u00a0', "", str_replace("R$", "", $valorReal)));
    }

    public static function validarPdf(UploadedFile $pdfFile, int $maxSizeFile = 8000000, int|float $version = 1.7): void
    {
        $extensao = $pdfFile->getClientOriginalExtension();

        if (!$pdfFile->isValid()) {
            throw new AnexoNaoEncontradoException('Arquivo inválido! Anexe apenas arquivos no formato PDF!');
        }

        if ($extensao !== 'pdf') {
            throw new AnexoErrorsException('Extensão do arquivo inválida! Anexe apenas arquivos no formato PDF!');
        }

        if ($pdfFile->getSize() > $maxSizeFile) {
            throw new AnexoErrorsException(
                'Arquivo maior que o permitido. Favor anexar arquivos pdf com tamanho máximo de 2MB!'
            );
        }

        $fOpen = @fopen($pdfFile->getPathname(), "rb");

        if (!$fOpen) {
            throw new AnexoErrorsException("Não foi possível abrir o arquivo PDF.");
        }

        $header = fread($fOpen, 8);
        fclose($fOpen);

        $versionPdf = substr($header, 5, 3);

        if (!is_numeric($versionPdf)) {
            throw new AnexoErrorsException("Não foi possível determinar a versão do PDF.");
        }

        $versionPdf = floatval($versionPdf);

        if (floatval($versionPdf) < $version) {
            $version = number_format($version, 1);
            $versionPdf = number_format($versionPdf, 1);
            throw new AnexoErrorsException(
                "Arquivo PDF está na versão '{$versionPdf}'. Precisa está no mínino na versão {$version}!"
            );
        }
    }
}

