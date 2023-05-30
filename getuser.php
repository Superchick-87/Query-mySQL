<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.8/d3.min.js" type="text/JavaScript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.9.1/d3.min.js"></script>

<?php
$servname = 'localhost';
$dbname = 'trconseil2023';
$user = 'root';
$pass = 'root';
include(dirname(__FILE__) . '/includes/sql_replace.php');
include(dirname(__FILE__) . '/includes/proper_case.php');

try {
    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//     /**
//      * 
//      * 
//      * EN COURS OK
//      * 
//      * 
//      */
// /**
//  * table avec index ik
//  */
//     $foncsqlD1 = "SELECT*
//              FROM knd1y_hikashop_characteristic
//              WHERE knd1y_hikashop_characteristic.characteristic_parent_id = '60'";

//     $requeteidD1 = $dbco->prepare($foncsqlD1);
//     $requeteidD1->execute();
//     $joueurD1 = $requeteidD1->fetchall();
//     // echo count($joueurD1).'<br>';
//     // echo "<pre>";
//     // print_r($joueurD1);
//     // echo "</pre>";
// /**
//  * fin table avec index ik
//  */
// /**
//  * table cible ps
//  */
//     $toto = "SELECT*
//         FROM ps_prod_at_combi_t
//         WHERE ps_prod_at_combi_t.characteristic_parent_id_temp = 60
//         AND ps_prod_at_combi_t.id_productTemp = 65995";

//     $reque =$dbco->prepare($toto);
//     $reque->execute();
//     $jou = $reque->fetchAll();
//     // echo "<pre>";
//     // print_r($jou);
//     // echo "</pre>";
   
//     /**
//      * fin table cible ps
//      */
    
//     $tabIndex = array();
//     $g=0;
    
    
//     $tabCible = array();
//     $m=0;
//     $zC=0;
//     $gC=0;
//     $zpC=0;
   
//   $toto =array();
//     foreach ($jou as $keyC => $valueC) {
//         $tabCible = array($keyC => $valueC);
//         // echo '</br></br>'.count($tabCible).'</br>';
//         echo $tabCible[$zC++]['id_product_attribute'].'</br>';
//         $z=0; 
//         foreach ($joueurD1 as $key => $value) { 
//             $tabIndex = array($key => $value);
//             // if ($tabIndex[$z++]['characteristic_parent_id'] == 60) {
//                 # code...
//                 echo $tabIndex[$z++]['characteristic_id'].'</br>';
//             // }    # code...
           
//         }

//     }

        /**
     * 
     * 
     * EN COURS
     * 
     * 
     */

        // $v=0;
        // $ccc = array();
        // $ddd = array();
        //     for ($n = 0; $n < count($jou); $n++) { 
        //         // $ccc = array($joueurD1[$v++]['characteristic_id']);
        //         $ccc = array($joueurD1[0]['characteristic_id']);
        //         print_r($ccc);
        //         // foreach ($ccc as $rv) {
        //         //     echo $rv.'<br>';
        //         //     // for ($n = 0; $n < count($jou); $n++) { 
        //         //         $requeteidD1x = $dbco->prepare("UPDATE ps_prod_at_combi_t AS psC
        //         //                         JOIN knd1y_hikashop_characteristic AS k 
        //         //                         ON psC.characteristic_parent_id_temp = k.characteristic_parent_id 
        //         //                         SET psC.id_attribute = $rv
        //         //                         WHERE k.characteristic_parent_id = psC.characteristic_parent_id_temp 
        //         //                         AND psC.id_productTemp = '65995'");
        //         // }
        //         //     // }
        //         // $requeteidD1x->execute();
        //         // $joueurD1x = $requeteidD1x->fetchAll(PDO::FETCH_ASSOC);
           
        //     }

} catch (PDOException $e) {
    echo '<div class="erreur">&#10006;</br>Erreur de connexion
    </br>' . $e->getMessage() . '</div>';
}
