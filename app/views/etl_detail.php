<?php


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Com  patible" content="ie=edge">
    <title>ETL ERROR DETAILS</title>


</head>

<body>
<?php 

        if($data[0] == NULL){
            echo "no data";

        }elseif($data['erro'] == 1){
            echo "Foram encontradas <b>" . $data[0] . "</b> vendas não sucedidas por causa de <b>Problemas com Operador</b>";
        }elseif($data['erro'] == 2){
            echo "Foram encontradas <b>" . $data[0] . "</b> vendas não sucedidas por causa de <b>Problemas com Operador</b>";
        }elseif($data['erro'] == 3){
            echo "Foram encontradas <b>" . $data[0] . "</b> vendas não sucedidas por causa de <b>Problemas com Bandeira</b>";
        }elseif($data['erro'] == 4){
            echo "Foram encontradas <b>" . $data[0] . "</b> vendas não sucedidas por causa de <b>Problemas com a Loja</b>";

        }
 
        echo "<br><a href='../etl'>BACK < </a>"
    
?>
</body>
</script>


</html>