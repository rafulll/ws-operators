<?php


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body> 

<form action="/pay/op-01" method="POST">

    <input type="text" placeholder="Cartao" name="cd"><br>
    <input type="text" placeholder="Cliente" name="ct"><br>
    <input type="text" placeholder="Bandeira" name="bd"><br>
    <input type="text" placeholder="Codigo Seguranca" name="cs"><br>
    <input type="text" placeholder="Valor em Centavos" name="vc"><br>
    <input type="text" placeholder="Parcelas" name="pc"><br>
    <input type="text" placeholder="Codigo da Loja" name="cl"><br>
    <input type="button" value="Pagar">



    
</form>
 
</body>
<script type="text/javascript">

card = document.getElementById('card4').textContent;

</script>
</html>