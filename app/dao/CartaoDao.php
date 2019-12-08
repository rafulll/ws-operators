<?php

namespace Dao;

use Dao\Dao;
use PDOException;

final class CartaoDao extends Dao
{

    public function insert($obj)
    {
        throw new Exception("Não precisa implementar");
    }
    public function read(int $idObj)
    {
        throw new Exception("Não precisa implementar");
    }
    public function readAll()
    {
        throw new Exception("Não precisa implementar");
    }
    public function update($obj)
    {
        throw new Exception("Não precisa implementar");
    }
    public function delete(int $idObj)
    {
        throw new Exception("Não precisa implementar");
    }

  public function elt_add_fail_detail($data){
try{
    var_dump($data);
    $sql_error_details = "INSERT INTO `etl_fails` (`ID`, `cod_erro`, `result`, `detail`, `brand`, `portion`) VALUES (null, :cod,:result ,:detail ,:brand , :portion);";
    $stm_error_details = $this->pdo->prepare($sql_error_details);
    $stm_error_details->bindParam(":cod",$data['cod_erro']);
    $stm_error_details->bindParam(":result",$data['resultado']);
    $stm_error_details->bindParam(":detail",$data['detalhes']);
    $stm_error_details->bindParam(":brand",$data['bandeira']);
    $stm_error_details->bindParam(":portion",strval($data['parcelas_solicitadas']));
    $stm_error_details->execute();
}catch(PDOException $e){
    echo $e->getMessage();
}
  }
  public function etl_get_errors($error){
     try{ 
      $SQL = "SELECT * FROM etl_fails WHERE cod_erro = ?";
      $stm = $this->pdo->prepare($SQL);
      $stm->bindValue(1,$error);
      $stm->execute();
      $result = $stm->rowCount();
    if($result == 0){
    return null;
    }
    }catch(PDOException $e){
      echo  $e->getMessage();
    }
    return $result;
  }
}
