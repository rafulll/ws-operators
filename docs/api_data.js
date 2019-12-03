define({ "api": [
  {
    "type": "GET",
    "url": "/ws-operators/v1/status",
    "title": "Operators - Status da API",
    "version": "0.0.1",
    "description": "<p>Verifica a disponibilidade da API</p>",
    "group": "Recursos_Abertos",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "status",
            "description": "<p>Resultado da disponibilidade do servidor.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "[JSON] Success-Response",
          "content": "{\n  'status': 'Serviço disponível WS1'\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/controllers/v1/OperatorController.php",
    "groupTitle": "Recursos_Abertos",
    "name": "GetWsOperatorsV1Status"
  },
  {
    "type": "POST",
    "url": "/pay/{operator}",
    "title": "Verificar Operador",
    "version": "1.0.0",
    "description": "<p>Verifica o Operador para Pagamento</p>",
    "group": "Recursos_Autenticados",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "operator",
            "description": "<p>Parâmetro da url que corresponde a operadora de cartão desejado. Deve ser uma das opções a seguir: op-01, op-02 ou op-03..</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "numero_cartao",
            "description": "<p>Número do cartão de crédito.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nome_cliente",
            "description": "<p>Nome do Titular do cartão de crédito.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "bandeira",
            "description": "<p>Nome da bandeira segundo opções a seguir: mister (cod.: 1111), vista (cod.:2222) ou daciolo (cod.: 3333).</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "cod_seguraca",
            "description": "<p>Código de três dígitos.</p>"
          },
          {
            "group": "Parameter",
            "type": "number",
            "optional": false,
            "field": "valor_em_centavos",
            "description": "<p>Valor em centavos da compra</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "parcelas",
            "description": "<p>Quantidade de parcelas da compra.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cod_loja",
            "description": "<p>Código único da loja e-commerce. Será usado para que a operadora de cartão verifique se a loja é sua cliente. Deve ser uma das opções a seguir: loja-01, loja-02 ou loja-03.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"numero_cartao\": \"1111.2222.3333.4444\",\n    \"nome_cliente\": \"USUARIO DA SILVA\",\n    \"bandeira\": \"mister\",\n    \"cod_seguranca\": 111,\n    \"valor_em_centavos\": 500,\n    \"parcelas\": 12,\n    \"cod_loja\": \"loja-xx\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "resposta",
            "description": "<p>Resultado da transação.</p>"
          },
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "nome_cliente",
            "description": "<p>Nome do titular do cartao.</p>"
          },
          {
            "group": "200",
            "type": "Number",
            "optional": false,
            "field": "valor_em_centavos",
            "description": "<p>Valor em Centavos da Compra</p>"
          },
          {
            "group": "200",
            "type": "Number",
            "optional": false,
            "field": "parcelas",
            "description": "<p>Quantidade de Parcelas em que o pagamento foi feito.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": " \n {\n   \"resposta\": \"sucesso\",\n   \"nome_cliente\": \"USUARIO DE SOUSA\",\n   \"valor_em_centavos\":\"500\",\n   \"parcelas\":\"12\"\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "200": [
          {
            "group": "200",
            "type": "String",
            "optional": false,
            "field": "nome_cliente",
            "description": "<p>Nome do titular do cartao.</p>"
          },
          {
            "group": "200",
            "type": "Number",
            "optional": false,
            "field": "valor_em_centavos",
            "description": "<p>Valor em Centavos da Compra</p>"
          },
          {
            "group": "200",
            "type": "Number",
            "optional": false,
            "field": "parcelas",
            "description": "<p>Quantidade de Parcelas em que o pagamento foi feito.</p>"
          }
        ],
        "401": [
          {
            "group": "401",
            "type": "String",
            "optional": false,
            "field": "resposta",
            "description": "<p>Resultado da transação.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Error-Response:",
          "content": " \n {\n   \"resposta\": \"sucesso\",\n   \"nome_cliente\": \"USUARIO DE SOUSA\",\n   \"valor_em_centavos\":\"500\",\n   \"parcelas\":\"12\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/controllers/v1/OperatorController.php",
    "groupTitle": "Recursos_Autenticados",
    "name": "PostPayOperator"
  },
  {
    "type": "POST",
    "url": "/ws-operators/v1/pay/:operadora",
    "title": "Operators - Executa o pagamento via cartão de crédito",
    "version": "0.0.1",
    "description": "<p>Envia a solicitação para pagamento via cartão de crédito a operadora de cartão.</p>",
    "group": "Recursos_Autenticados",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "operadora",
            "description": "<p>Parâmetro da url que corresponde a operadora de cartão desejado. Deve ser uma das opções a seguir: op-01, op-02 ou op-03.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "numero_cartao",
            "description": "<p>Número do cartão de crédito.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "nome_cliente",
            "description": "<p>Nome do titular do cartão de crédito.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "bandeira",
            "description": "<p>Nome da bandeira segundo opções a seguir: mister (cod.: 1111), vista (cod.: 2222) ou daciolo (cod.: 3333).</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "cod_seguranca",
            "description": "<p>Código de três dígitos.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "valor_em_centavos",
            "description": "<p>Valor em centavos da compra.</p>"
          },
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "parcelas",
            "description": "<p>Quantidade de parcelas para o pagamento.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "cod_loja",
            "description": "<p>Código único da loja e-commerce. Será usado para que a operadora de cartão verifique se a loja é sua cliente. Deve ser uma das opções a seguir: loja-01, loja-02 ou loja-03.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "[JSON] Exemplo Corpo da Requisição",
          "content": "{\n  \"numero_cartao\": \"1111.2222.3333.4444\",\n  \"nome_cliente\": \"USUARIO DA SILVA\",\n  \"bandeira\": \"mister\",\n  \"cod_seguranca\": 111,\n  \"valor_em_centavos\": 500,\n  \"parcelas\": 12,\n  \"cod_loja\": \"loja-xx\"\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "resposta",
            "description": "<p>Resultado da transação.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "nome_cliente",
            "description": "<p>Nome do titular do cartão de crédito.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "valor_em_centavos",
            "description": "<p>Valor em centavos da compra.</p>"
          },
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "parcelas",
            "description": "<p>Quantidade de parcelas em que o pagamento foi feito.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "[JSON] Exemplo-Resposta-Sucesso",
          "content": "{\n  \"resposta\": \"sucesso\",\n  \"nome_cliente\": \"USUARIO DE SOUSA\",\n  \"valor_em_centavos\": 500,\n  \"parcelas\": 12\n}",
          "type": "json"
        }
      ]
    },
    "error": {
      "fields": {
        "400": [
          {
            "group": "400",
            "type": "String",
            "optional": false,
            "field": "resposta",
            "description": "<p>Resultado da transação.</p>"
          },
          {
            "group": "400",
            "type": "String",
            "optional": false,
            "field": "detalhes",
            "description": "<p>Detalhes do erro</p>"
          },
          {
            "group": "400",
            "type": "String",
            "optional": false,
            "field": "operadora",
            "description": "<p>Operadora que foi buscado.</p>"
          },
          {
            "group": "400",
            "type": "String",
            "optional": false,
            "field": "cod-loja",
            "description": "<p>Loja de onde partiu a compra.</p>"
          },
          {
            "group": "400",
            "type": "String",
            "optional": false,
            "field": "bandeira",
            "description": "<p>Bandeira requisitada.</p>"
          },
          {
            "group": "400",
            "type": "String",
            "optional": false,
            "field": "parcelas_solicitadas",
            "description": "<p>Quantidade de parcelas solicitadas.</p>"
          },
          {
            "group": "400",
            "type": "String",
            "optional": false,
            "field": "limite_parcelas",
            "description": "<p>Limite de parcelas da bandeira.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "[JSON] Resposta-Erro-Operadora-Inexistente",
          "content": "{\n  \"resposta\": \"falha\",\n  \"detalhes\": \"Operadora não existe\",\n  \"operadora\": \"op-xx\"\n}",
          "type": "json"
        },
        {
          "title": "[JSON] Resposta-Erro-Loja-Negada",
          "content": "{\n  \"resposta\": \"falha\",\n  \"detalhes\": \"Loja não autorizada\",\n  \"operadora\": \"op-xx\",\n  \"cod-loja\": \"loja-xx\"\n}",
          "type": "json"
        },
        {
          "title": "[JSON] Resposta-Erro-Bandeira-Negada",
          "content": "{\n  \"resposta\": \"falha\",\n  \"detalhes\": \"Bandeira não autorizada\",\n  \"operadora\": \"op-xx\",\n  \"bandeira\": \"mister\"\n}",
          "type": "json"
        },
        {
          "title": "[JSON] Resposta-Erro-Parcelas-Não-Aceitas",
          "content": "{\n  \"resposta\": \"falha\",\n  \"detalhes\": \"Limite de parcelas ultrapassado\",\n  \"bandeira\": \"mister\"\n  \"parcelas_solicitadas\": 00,\n  \"limite_parcelas\": 00\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/controllers/v1/OperatorController.php",
    "groupTitle": "Recursos_Autenticados",
    "name": "PostWsOperatorsV1PayOperadora"
  }
] });
