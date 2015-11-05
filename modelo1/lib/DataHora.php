<?php

class DataHora {

    public static function formataHora($data) {
        $data = "";
        if ($data <> "") {
            $sdata = explode(" ", $data);
            $sdata = $sdata[1];
        }
        return $sdata;
    }

    public static function formataDataExtenso($data, $tipo) {
        // tipo=1 data no formato= dd/mm/yyyy
        // tipo=2 data no formato= dd de mes_extenso
        // tipo >2 data no formato= dd de mes_extenso de ano
        $dt = "";

        if ($data <> "") {
            $sdata = explode(" ", $data);
            $sdata = $sdata[0];
            $sdt = explode("-", $sdata);
            $meses = explode(",", "Janeiro,Fevereiro,Março,Abril,Maio,Junho,Julho,Agosto,Setembro,Outubro,Novembro,Dezembro");

            if ($tipo == 1) {
                $dt = $sdt[2] . "/" . $sdt[1] . "/" . $sdt[0];
            } else if ($tipo == 2) {
                $dt = $sdt[2] . " de " . $meses[intval($sdt[1] - 1)];
            } else {
                $dt = $sdt[2] . " de " . $meses[intval($sdt[1] - 1)] . " de " . $sdt[0];
            }
        }
        return $dt;
    }

    public static function retornaDataAtualExtenso() {
        $dias = explode(",", "Domingo,Segunda-feira,Terça-feira,Quarta-feira,Quinta-Feira,Sexta-feira,Sçbado");
        $meses = explode(",", ",Janeiro,Fevereiro,Março,Abril,Maio,Junho,Julho,Agosto,Setembro,Outubro,Novembro,Dezembro");
        $d = date("w");
        $m = date("n");
        return $dias[$d] . ", " . date("d") . " de " . $meses[$m - 1] . " de " . date("Y");
    }

    public static function retornaDia($data) {
        $data = explode("/", $data);
        return $data[0];
    }

    /**
     * Retorna o mês com base no formato nacional
     * @param type $data
     * @return type
     */
    public static function retornaMes($data) {
        $data = explode("/", $data);
        return $data[1];
    }

    public static function retornaMesExtenso($data) {
        $meses = explode(",", ",Janeiro,Fevereiro,Março,Abril,Maio,Junho,Julho,Agosto,Setembro,Outubro,Novembro,Dezembro");
        $data = explode("/", $data);
        return $meses[(($data[1]) * 1)];
    }

    /**
     * Retorna o ano com base no formato nacional
     * @param type $data
     * @return type
     */
    public static function retornaAno($data) {
        $data = explode("/", $data);
        return $data[2];
    }

    /**
     * M&eacute;todo de formatação de data
     *
     * @param String $data
     * @param int $tipo
     * @return String
     */
    public static function FormataDataMysql($data, $tipo = 3, $separador = '/') {

        if (!empty($data)) {
            $dt = explode($separador, $data);

            if ($tipo == 1)
                $dta = $dt[2] . "-" . $dt[1] . "-" . $dt[0] . " " . date("H:i:s");
            elseif ($tipo == 2)
                $dta = $dt[2] . "-" . $dt[1] . "-" . $dt[0] . " 00:00:00";
            elseif ($tipo == 3)
                $dta = $dt[2] . "-" . $dt[1] . "-" . $dt[0];
            elseif ($tipo == 4)
                $dta = $dt[0] . "" . $dt[1] . "" . $dt[2];
            elseif ($tipo == 5) {
                if ($dt[0] < 10)
                    $dt[0] = substr($dt[0], 1);
                if ($dt[1] < 10)
                    $dt[1] = substr($dt[1], 1);
                $dta = $dt[0] . "-" . $dt[1] . "-" . $dt[2];
            }elseif ($tipo == 6)
                $dta = $dt[1];
        } else
            $dta = 'NULL';


        return $dta;
    }

    /**
     * M&eacute;todo de formatação de data
     *
     * @param String $data
     * @param int $tipo
     * @return String
     */
    public static function FormataDataMysql2($data, $tipo) {
        $dt = explode("/", $data);
        if ($tipo == 1) {
            $dta = $dt[2] . "/" . $dt[1] . "/" . $dt[0] . " " . date("H:i:s");
        } elseif ($tipo == 2) {
            $dta = $dt[2] . "/" . $dt[1] . "/" . $dt[0] . " 00:00:00";
        } elseif ($tipo == 3) {
            $dta = $dt[2] . "/" . $dt[1] . "/" . $dt[0];
        }
        return $dta;
    }

    /**
     * M&eacute;todo de formatação de data
     *
     * @param String $data
     * @param int $tipo
     * @return String
     */
    public static function FormataDataMysql3($data, $tipo) {
        $dt = explode("-", $data);
        if ($tipo == 1) {
            $dta = $dt[2] . "/" . $dt[1] . "/" . $dt[0] . " " . date("H:i:s");
        } elseif ($tipo == 2) {
            $dta = $dt[2] . "/" . $dt[1] . "/" . $dt[0] . " 00:00:00";
        } elseif ($tipo == 3) {
            $dta = $dt[2] . "/" . $dt[1] . "/" . $dt[0];
        }
        return $dta;
    }

    public static function getDiaSemana($data, $separador = '/', $tipo = 1) {

        if ($tipo == 1) {
            $arrayData = explode('/', $data);

            $dia = $arrayData[0];
            $mes = $arrayData[1];
            $ano = $arrayData[2];
        } elseif ($tipo == 2) {

            $arrayData = explode('-', $data);

            $ano = $arrayData[0];
            $mes = $arrayData[1];
            $dia = $arrayData[2];
        }

        $dia = date("w", mktime(0, 0, 0, $mes, $dia, $ano));
        switch ($dia) {
            case"0":
                $dia = "Domingo";
                break;
            case"1":
                $dia = "Segunda-Feira";
                break;
            case"2":
                $dia = "Terça-Feira";
                break;
            case"3":
                $dia = "Quarta-Feira";
                break;
            case"4":
                $dia = "Quinta-Feira";
                break;
            case"5":
                $dia = "Sexta-Feira";
                break;
            case"6":
                $dia = "Sábado";
                break;
        }

        return $dia;
    }

    public static function getVisualisaDataSql($data, $separador = '-', $tipo = 1) {
        if (empty($data))
            return false;

        $dt = explode($separador, $data);
        if ($tipo == 1) {
            return substr($dt[2], 0, 2) . "/" . $dt[1] . "/" . $dt[0];
        } elseif ($tipo == 2) {
            return substr($dt[2], 0, 2) . "/" . $dt[1] . "/" . $dt[0] . ' ' . substr($dt[2], 2, 12);
        }
    }

    public static function getArrayMeses() {
        $array = array(
            1 => "Janeiro",
            2 => "Fevereiro",
            3 => "Março",
            4 => "Abril",
            5 => "Maio",
            6 => "Junho",
            7 => "Julho",
            8 => "Agosto",
            9 => "Setembro",
            10 => "Outubro",
            11 => "Novembro",
            12 => "Dezembro"
        );

        return $array;
    }

    public static function _getArrayMeses() {
        $array = [
            ['id' => 1, 'nome' => "Janeiro"],
            ['id' => 2, 'nome' => "Fevereiro"],
            ['id' => 3, 'nome' => "Março"],
            ['id' => 4, 'nome' => "Abril"],
            ['id' => 5, 'nome' => "Maio"],
            ['id' => 6, 'nome' => "Junho"],
            ['id' => 7, 'nome' => "Julho"],
            ['id' => 8, 'nome' => "Agosto"],
            ['id' => 9, 'nome' => "Setembro"],
            ['id' => 10, 'nome' => "Outubro"],
            ['id' => 11, 'nome' => "Novembro"],
            ['id' => 12, 'nome' => "Dezembro"],
        ];

        return $array;
    }

    /**
     * Retorna um inteiro, com o valor de dias entre as duas datas
     * @param <string> $inicio - formato: aaaa-mm-dd
     * @param <type> $fim - formato: aaaa-mm-dd
     * @return <int> 
     */
    public static function dataNumeroDias($inicio, $fim) {

        $di = explode("-", $inicio);
        $df = explode("-", $fim);

        $dinicio = mktime(date('H'), date('i'), date('s'), $di[1], $di[2], $di[0]);
        $dfim = mktime(date('H'), date('i'), date('s'), $df[1], $df[2], $df[0]);
        $dias = abs((($dinicio - $dfim) / (60 * 60 * 24)));

        return $dias;
    }

    public static function addDiasData($dias) {
        return date('Y-m-d', strtotime("+" . $dias . " days", strtotime(date('Y-m-d'))));
    }

    public static function removeDiasData($dias) {
        return date('Y-m-d', strtotime("-" . $dias . " days", strtotime(date('Y-m-d'))));
    }

    /**
     * 
     * @param type $semana
     *       case 0: $semana = "Domingo";
     *       case 1: $semana = "Segunda Feira";
     *       case 2: $semana = "Terça Feira";
     *       case 3: $semana = "Quarta Feira";
     *       case 4: $semana = "Quinta Feira";
     *       case 5: $semana = "Sexta Feira";
     *       case 6: $semana = "Sábado";
     */
    public static function dia_semana($dia_semana) {
        switch ($dia_semana) {

            case 0: $dia_semana = "Domingo";
                break;
            case 1: $dia_semana = "Segunda Feira";
                break;
            case 2: $dia_semana = "Terça Feira";
                break;
            case 3: $dia_semana = "Quarta Feira";
                break;
            case 4: $dia_semana = "Quinta Feira";
                break;
            case 5: $dia_semana = "Sexta Feira";
                break;
            case 6: $dia_semana = "Sábado";
                break;
        }
        return $dia_semana;
    }

}

?>