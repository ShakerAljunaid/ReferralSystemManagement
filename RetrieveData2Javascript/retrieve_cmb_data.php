<?php 
 
require_once('dbconfig.php');
 //--------------------------------------------------Retrieve Jobs Data---------------------------//
  			       $sql =  "SELECT ID,Title, List_type_id as Type_id,Parent_id FROM manylist; ";
		
              echo '<script> var jsManyLists='.json_encode($pdo->query($sql)->fetchAll()).';console.log(jsManyLists);</script>'; 
            
              $sql =  "SELECT ID,Name FROM externalagency; ";
		
              echo '<script> var jsexternalagency='.json_encode($pdo->query($sql)->fetchAll()).';</script>'; 
         
  
  

  
  ?>