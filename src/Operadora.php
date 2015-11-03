<?php

namespace Renatomaraujo2\Operadora;

use Renatomaraujo2\Operadora\Curl;
use PhpQuery\PhpQuery as phpQuery;

/**
 * Class Operadora
 *
 * @package Renatomaraujo2\Operadora
 */
class Operadora {

    /**
     * @param $numero
     * @return array
     * @throws \Exception
     */
    public function consulta($numero)
    {
        $numero = str_replace(['-', '(', ')', '*', ' '], '', $numero);

        $curl = new Curl;

        $data = ['numero' => $numero];

        $html = $curl->simple('https://www.qual-operadora.net/', $data);

        #dd($html);

        phpQuery::newDocumentHTML($html, $charset = 'utf-8');

        $pesquisa = [];

        foreach(phpQuery::pq('#modulo-consulta-operadora #consulta_num') as $pqDiv)
        {
            $dados = [];

            $dados['operadoraTipo'] = explode('-', str_replace([' ', ':'], '', trim(phpQuery::pq('table span.verde:first', $pqDiv)->text())));

            if (isset($dados['operadoraTipo'][0]))
            {
                $dados['operadora'] = $dados['operadoraTipo'][0];
            }

            if (isset($dados['operadoraTipo'][1]))
            {
                $dados['tipo'] = $dados['operadoraTipo'][1];

                unset($dados['operadoraTipo']);
            }

            $dados['portabilidade'] = preg_replace('/[áàãâä]/ui', 'a', str_replace([' ', ':'], '', trim(phpQuery::pq('table span.verde:last', $pqDiv)->text())));

            $dados['dataPortabilidade'] = preg_replace('/[áàãâä]/ui', 'a', str_replace([' ', ':'], '', trim(phpQuery::pq('h2 span.verde:last', $pqDiv)->text())));

            $dados['numero'] = trim(phpQuery::pq('input:[name="numero"]', $pqDiv)->val());

            $pesquisa = $dados;
        }

        return $pesquisa;
    }

}