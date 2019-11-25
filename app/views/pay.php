<?php
echo $data['name'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Com  patible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://unpkg.com/imask"></script>

</head>

<body>
    <div id="app">
        <ul>
            <il @click='sum_items(1000)'>Produto 1 R$ 10,00 - Clique para adicionar ao carrinho</il><br>
            <il @click='sum_items(2000)'>Produto 2 R$ 20,00 - Clique para adicionar ao carrinho</il><br>
            <il @click='sum_items(3000)'>Produto 3 R$ 30,00 - Clique para adicionar ao carrinho</il><br>
            <il @click='sum_items(4000)'>Produto 4 R$ 40,00 - Clique para adicionar ao carrinho</il><br>
            <il @click='sum_items(5000)'>Produto 5 R$ 50,00 - Clique para adicionar ao carrinho</il><br>
        </ul>
        <form action="/ws-operators/v1/pay/op-01" method="POST">

            <input id="card" pattern="\d{4}.\d{4}.\d{4}.\d{4}" type="text" placeholder="0000.0000.0000.0000" maxlength="19" name="numero_cartao" value=""> <img id='card_img' src="" alt=""> Por favor insira o numero do cartao com pontos dividindo os intervalos de 4 digitos.<br>
            <input type="text" @focus="verify_card()" placeholder="Nome do Cliente" name="nome_cliente"><br>
            <input type="text" id='bandeira' placeholder="Bandeira" name="bandeira"><br>
            <input type="text" placeholder="CVV" name="cod_seguranca"><br>
            <select name="parcelas">
                <option selected disabled value="">Numero de parcelas </option>

                <option value="1">1x</option>
                <option value="2">2x</option>
                <option value="3">3x</option>
                <option value="4">4x</option>
                <option value="5">5x</option>
                <option value="6">6x</option>
                <option value="7">7x</option>
                <option value="8">8x</option>
                <option value="9">9x</option>
                <option value="10">10x</option>
                <option value="11">11x</option>
                <option value="12">12x</option>
            </select><br>
            <input type="text" placeholder="Codigo da Loja" hidden  name="cod_loja" value="loja-03"><br>
            <h3>Valor Total R$ {{valor_em_rs}},00<input style="width: 80px" id="valor_compra" type="hidden" placeholder="Valor" name="valor_em_centavos" value=""></h3><br>

            <input type="submit" value="Pagar">




        </form>


    </div>

</body>
<script type="text/javascript">
    var element = document.getElementById('card')
    var maskOptions = {
        mask: '0000.0000.0000.0000'
    };
    var mask = IMask(element, maskOptions);

    var app = new Vue({

        el: '#app',
        data: {
            const_cards: {
                mister: {cod:'1111',text: 'mister'},
                vista: {cod:'2222',text:'vista'},
                daciolo: {cod:'3333',text:'daciolo'}
            },
            status: 0,
            valor_compra: 0,
            valor_em_rs: 0,
            valor_parc: 0

        },
        created: function() {

        },
        methods: {
            sum_items: function(event) {
                this.valor_compra += event
                var compra = document.getElementById('valor_compra')




                compra.setAttribute("value", this.valor_compra)
                this.valor_em_rs = this.valor_compra / 100
            },
            verify_card: function() {
                setTimeout(function() {

                    var okcard = document.getElementById('card').value.split(".", 4)
                    var bandeira = document.getElementById('bandeira')
                    var img_src = document.getElementById('card_img')
                    if (okcard[3] == app.const_cards.daciolo.cod) {
                        bandeira.setAttribute("value", app.const_cards.daciolo.text)
                        img_src.setAttribute("src", "https://cdn.dribbble.com/users/83140/screenshots/728577/deux.png")
                        img_src.setAttribute("width", "40px")
                    } else if (okcard[3] == app.const_cards.vista.cod) {
                        bandeira.setAttribute("value", app.const_cards.vista.text)
                        img_src.setAttribute("src", "https://www.vistagroup.co.nz/content/images/interface/logo/vista-group.png")
                        img_src.setAttribute("width", "40px")
                    } else if (okcard[3] == app.const_cards.mister.cod) {
                        bandeira.setAttribute("value", app.const_cards.msiter.text)
                        img_src.setAttribute("src", "https://www.vistagroup.co.nz/content/images/interface/logo/vista-group.png")
                        img_src.setAttribute("width", "40px")
                    } else {}




                }, 1000);

            }
        },
        mounted: function() {

            // console.log(this.const_cards.daciolo)
            // console.log(okcard[3])




        }

    })
</script>


</html>