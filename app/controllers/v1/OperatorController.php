<?php

namespace Controllers\V1;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class OperatorController
{

  /** 
   * @api {GET} /ws-operators/v1/status Operators - Status da API
   * @apiVersion 0.0.1
   * @apiDescription Verifica a disponibilidade da API
   * @apiGroup Recursos Abertos
   * 
   * @apiSuccess {String} status Resultado da disponibilidade do servidor.
   * 
   * @apiSuccessExample [JSON] Success-Response
   * {
   *   'status': 'Serviço disponível WS1'
   * }
   *  
  */

  /**
   * @api {POST} /ws-operators/v1/pay/:operadora Operators - Executa o pagamento via cartão de crédito
   * @apiVersion 0.0.1
   * @apiDescription Envia a solicitação para pagamento via cartão de crédito a operadora de cartão.
   * @apiGroup Recursos Autenticados
   * 
   * @apiParam {String} operadora Parâmetro da url que corresponde a operadora de cartão desejado. Deve ser uma das opções a seguir: op-01, op-02 ou op-03.
   * @apiParam {String} numero_cartao Número do cartão de crédito.
   * @apiParam {String} nome_cliente Nome do titular do cartão de crédito.
   * @apiParam {String} bandeira Nome da bandeira segundo opções a seguir: mister (cod.: 1111), vista (cod.: 2222) ou daciolo (cod.: 3333).
   * @apiParam {Number} cod_seguranca Código de três dígitos.
   * @apiParam {Number} valor_em_centavos Valor em centavos da compra.
   * @apiParam {Number} parcelas Quantidade de parcelas para o pagamento.
   * @apiParam {String} cod_loja Código único da loja e-commerce. Será usado para que a operadora de cartão verifique se a loja é sua cliente. Deve ser uma das opções a seguir: loja-01, loja-02 ou loja-03.
   * 
   * @apiParamExample [JSON] Exemplo Corpo da Requisição
   * {
   *   "numero_cartao": "1111.2222.3333.4444",
   *   "nome_cliente": "USUARIO DA SILVA",
   *   "bandeira": "mister",
   *   "cod_seguranca": 111,
   *   "valor_em_centavos": 500,
   *   "parcelas": 12,
   *   "cod_loja": "loja-xx"
   * }
   * 
   * @apiSuccess {String} resposta Resultado da transação.
   * @apiSuccess {String} nome_cliente Nome do titular do cartão de crédito.
   * @apiSuccess {Number} valor_em_centavos Valor em centavos da compra.
   * @apiSuccess {Number} parcelas Quantidade de parcelas em que o pagamento foi feito.
   * 
   * @apiSuccessExample [JSON] Exemplo-Resposta-Sucesso
   * {
   *   "resposta": "sucesso",
   *   "nome_cliente": "USUARIO DE SOUSA",
   *   "valor_em_centavos": 500,
   *   "parcelas": 12
   * }
   * 
   * @apiError (400) {String} resposta Resultado da transação.
   * @apiError (400) {String} detalhes Detalhes do erro
   * @apiError (400) {String} operadora Operadora que foi buscado.
   * @apiError (400) {String} cod-loja Loja de onde partiu a compra.
   * @apiError (400) {String} bandeira Bandeira requisitada.
   * @apiError (400) {String} parcelas_solicitadas Quantidade de parcelas solicitadas.
   * @apiError (400) {String} limite_parcelas Limite de parcelas da bandeira.
   * 
   * @apiErrorExample [JSON] Resposta-Erro-Operadora-Inexistente
   * {
   *   "resposta": "falha",
   *   "detalhes": "Operadora não existe",
   *   "operadora": "op-xx"
   * }
   * @apiErrorExample [JSON] Resposta-Erro-Loja-Negada
   * {
   *   "resposta": "falha",
   *   "detalhes": "Loja não autorizada",
   *   "operadora": "op-xx",
   *   "cod-loja": "loja-xx"
   * }
   * @apiErrorExample [JSON] Resposta-Erro-Bandeira-Negada
   * {
   *   "resposta": "falha",
   *   "detalhes": "Bandeira não autorizada",
   *   "operadora": "op-xx",
   *   "bandeira": "mister"
   * }
   * @apiErrorExample [JSON] Resposta-Erro-Parcelas-Não-Aceitas
   * {
   *   "resposta": "falha",
   *   "detalhes": "Limite de parcelas ultrapassado",
   *   "bandeira": "mister"
   *   "parcelas_solicitadas": 00,
   *   "limite_parcelas": 00
   * }
   *  
  */
    public static function getStatus(Request $req, Response $res, array $args)
    {
        $dados = [
            "status" => "Serviço disponível WS1"
        ];
        return $res->withStatus(200)->withJson($dados);
    }
    public static function pay(Request $rq, Response $rs, array $args)
    {


        $vdata= [

            unserialize(RULES)
        ];


         
        $data[0] = $rq->getParsedBody();
        if (!array_key_exists($args['operator'], $vdata[0])) {

            //var_dump($vdata[0][$args['operator']]['bandeiras_autorizadas']);

            $dados = [
                //$rq->getParsedBody(),
                "resultado" => "Falha",
                "detalhes" => "Operador Inexistente",
                "bandeira" => $data[0]['bandeira'],
                "parcelas_solicitadas" =>  $data[0]['parcelas']
                //"limite_parcelas" => $c->limite_parcelas


            ];
            return $rs->withStatus(401)->withJson($dados);
        } elseif (!array_key_exists($data[0]['bandeira'], $vdata[0][$args['operator']]['bandeiras_autorizadas'])) { 
            //var_dump($data[0]['bandeira']);
            //var_dump($vdata[0][$args['operator']]['bandeiras_autorizadas']);
            //var_dump($vdata[0][$args['operator']]['bandeiras_autorizadas']);
            //$my_url = "http://localhost/ws-brands/v1/installment-limits/" . $data[0]['bandeira'] . "/" . $data[0]['parcelas'];

            //var_dump($vdata[0][$args['operator']]['bandeiras_autorizadas']);


            $dados = [
                //$rq->getParsedBody(),
                "resultado" => "Falha",
                "detalhes" => "Bandeira Nao Autorizada para este operador",
                "bandeira" => $data[0]['bandeira'],
                "parcelas_solicitadas" =>  $data[0]['parcelas'],
                


            ];
            return $rs->withStatus(401)->withJson($dados);

        } elseif (!array_key_exists($data[0]['cod_loja'], $vdata[0][$args['operator']]['lojas_autorizadas'])) {
            $dados = [
                //$rq->getParsedBody(),
                "resultado" => "Falha",
                "detalhes" => "Loja não autorizada.",
                "bandeira" => $data[0]['bandeira'],
                "parcelas_solicitadas" =>  $data[0]['parcelas'],
              


            ];
            return $rs->withStatus(401)->withJson($dados);

        } else {
                //var_dump($vdata[0][$args['operator']]['bandeiras_autorizadas']);
                //echo "vai pedir brands";
      
                $url="http://localhost/ws-brands/v1/installments-limit/".$data[0]['bandeira'];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,$url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data[0]));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result=curl_exec($ch);
                $c = json_decode($result);
                $json_errors = array(
                    JSON_ERROR_NONE => 'No_errors',
                    JSON_ERROR_DEPTH => 'Yes, The maximum stack depth has been exceeded',
                    JSON_ERROR_CTRL_CHAR => 'Yes, Control character error, possibly incorrectly encoded',
                    JSON_ERROR_SYNTAX => 'Yes,_Syntax error',
                );
                
                echo 'Json_errors: __ ', $json_errors[json_last_error()], PHP_EOL, PHP_EOL;
                //var_dump($c);
                        return $rs->withStatus(200)->withJson($c);
                              

                    }
                
               
        // $url="http://localhost/ws-brands/v1/pay";
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL,$url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data[0]));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $result=curl_exec($ch);
        // $c = json_decode($result);
        // //var_dump($c);
        // //echo $result;
        
        // $json_errors = array(
        //     JSON_ERROR_NONE => 'No_errors',
        //     JSON_ERROR_DEPTH => 'Yes, The maximum stack depth has been exceeded',
        //     JSON_ERROR_CTRL_CHAR => 'Yes, Control character error, possibly incorrectly encoded',
        //     JSON_ERROR_SYNTAX => 'Yes,_Syntax error',
        // );
        
        //echo 'Json_errors: __ ', $json_errors[json_last_error()], PHP_EOL, PHP_EOL;
        
                return $rs->withStatus(200)->withJson($c);
                
            
        }
   
     
       
    }




/**
 * @api {POST} /pay/{operator} Verificar Operador
 *
 * @apiVersion 1.0.0
 *
 * @apiDescription Verifica o Operador para Pagamento
 * @apiGroup Recursos Autenticados
 *
 * @apiParam {String} operator Parâmetro da url que corresponde a operadora de cartão desejado. Deve ser uma das opções a seguir: op-01, op-02 ou op-03..
 * @apiParam {String} numero_cartao Número do cartão de crédito.
 * @apiParam {String} nome_cliente Nome do Titular do cartão de crédito.
 * @apiParam {String} bandeira Nome da bandeira segundo opções a seguir: mister (cod.: 1111), vista (cod.:2222) ou daciolo (cod.: 3333).
 * @apiParam {Number} cod_seguraca Código de três dígitos.
 * @apiParam {number} valor_em_centavos Valor em centavos da compra
 * @apiParam {String} parcelas Quantidade de parcelas da compra.
 * @apiParam {String} cod_loja Código único da loja e-commerce. Será usado para que a operadora de cartão verifique se a loja é sua cliente. Deve ser uma das opções a seguir: loja-01, loja-02 ou loja-03.

 * @apiParamExample {json} Request-Example:
 * {
 *     "numero_cartao": "1111.2222.3333.4444",
 *     "nome_cliente": "USUARIO DA SILVA",
 *     "bandeira": "mister",
 *     "cod_seguranca": 111,
 *     "valor_em_centavos": 500,
 *     "parcelas": 12,
 *     "cod_loja": "loja-xx"
 * }
 * 
 * @apiSuccess (200) {String} resposta Resultado da transação.
 * @apiSuccess (200) {String} nome_cliente Nome do titular do cartao.
 * @apiSuccess (200) {Number} valor_em_centavos Valor em Centavos da Compra
 * @apiSuccess (200) {Number} parcelas Quantidade de Parcelas em que o pagamento foi feito.

 * @apiSuccessExample {json} Success-Response:
 *     
 *     {
 *       "resposta": "sucesso",
 *       "nome_cliente": "USUARIO DE SOUSA",
 *       "valor_em_centavos":"500",
 *       "parcelas":"12"
 *    }
 *
 * @apiError (401) {String} resposta Resultado da transação.
 * @apiError (200) {String} nome_cliente Nome do titular do cartao.
 * @apiError (200) {Number} valor_em_centavos Valor em Centavos da Compra
 * @apiError (200) {Number} parcelas Quantidade de Parcelas em que o pagamento foi feito.

 * @apiErrorExample {json} Error-Response:
 *     
 *     {
 *       "resposta": "sucesso",
 *       "nome_cliente": "USUARIO DE SOUSA",
 *       "valor_em_centavos":"500",
 *       "parcelas":"12"
 *    }






 */
