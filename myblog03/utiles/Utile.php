<?php
//Utile
class Utile
{
  //Test DB connection
  public static function readProcessEntity(
      $entityParams,
      $fc_entityFactory,
      $fc_preProcess,
      $fc_onProcess)
  {
      global $db;
      
      //invoke read on CategoryConnected Utile::getEntityConnected($entityFactory)->read(); //loop on result
      $result = $fc_entityFactory($db)->crud('read',$entityParams); //loop on result
      if ($result->rowCount() > 0) {          //$cat_arr = null;    $fc_preprocess($cat_arr);
          $cat_arr = $fc_preProcess();
          while ($row = $result->fetch(PDO::FETCH_ASSOC)) $fc_onProcess($row, $cat_arr);
          return $cat_arr;
      }
      return null;
  }
}
?>






