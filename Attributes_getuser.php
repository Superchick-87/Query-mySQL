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
    
    $modif = [
    /**
    * ATTRIBUTES     ATTRIBUTES    ATTRIBUTES
    * ATTRIBUTES     ATTRIBUTES    ATTRIBUTES
    * ATTRIBUTES     ATTRIBUTES    ATTRIBUTES
    */
   
      "DROP PROCEDURE IF EXISTS CLEAR_TABLES",
        "CREATE PROCEDURE CLEAR_TABLES()
            BEGIN
                -- TRUNCATE TABLE ps_attribute;
                -- TRUNCATE TABLE ps_attribute_group;
                -- TRUNCATE TABLE ps_attribute_group_lang;
                -- TRUNCATE TABLE ps_attribute_group_shop;
                -- TRUNCATE TABLE ps_attribute_lang;
                -- TRUNCATE TABLE ps_attribute_shop;
                -- TRUNCATE TABLE ps_product_attribute;
                -- TRUNCATE TABLE ps_product_attribute_shop;
                TRUNCATE TABLE ps_prod_at_combi_t;
            END;",
        "CALL CLEAR_TABLES()",
        
       "INSERT INTO ps_prod_at_combi_t (id_product_attribute,id_productTemp,ref)
            SELECT id_product_attribute, id_product, reference FROM ps_product_attribute",
        
        "UPDATE ps_prod_at_combi_t AS psC
            JOIN knd1y_hikashop_variant AS hikV 
            ON psC.id_productTemp = hikV.variant_product_id 
            SET psC.characteristic_parent_id_temp = hikV.variant_characteristic_id WHERE hikV.ordering = 1",
        
        "UPDATE ps_prod_at_combi_t AS psC
            JOIN ps_attribute AS psA 
            ON psC.characteristic_parent_id_temp = psA.id_attribute_group 
            SET psC.id_attribute = psA.id_attribute WHERE psA.position=0",
     
 
   
   
    //     /**
    //      * TABLE ps_attribute
    //      */
    //     "ALTER TABLE ps_attribute CHANGE color color  VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL",
    //     "INSERT INTO ps_attribute (id_attribute,id_attribute_group,position)
    //         SELECT characteristic_id,characteristic_parent_id,characteristic_ordering FROM knd1y_hikashop_characteristic WHERE characteristic_parent_id > 0 ORDER BY characteristic_id ASC",
        
    //     /**
    //     * TABLE ps_attribute_group
    //     */
    //     "INSERT INTO ps_attribute_group (id_attribute_group,is_color_group,group_type,position)
    //         SELECT characteristic_id,'0','select',characteristic_ordering FROM knd1y_hikashop_characteristic WHERE characteristic_parent_id = 0 ORDER BY characteristic_id ASC",
        
    //     /**
    //     * TABLE ps_attribute_group_lang
    //     */
    //     "INSERT INTO ps_attribute_group_lang (id_attribute_group,id_lang,name,public_name)
    //         SELECT characteristic_id,'1',characteristic_value,characteristic_value FROM knd1y_hikashop_characteristic WHERE characteristic_parent_id = 0 ORDER BY characteristic_id ASC",
        
    //     /**
    //     * TABLE ps_attribute_group_shop
    //     */
    //     "INSERT INTO ps_attribute_group_shop (id_attribute_group,id_shop)
    //         SELECT id_attribute_group,'1' FROM ps_attribute_group_lang ORDER BY id_attribute_group ASC",
        
    //     /**
    //     * TABLE ps_attribute_lang
    //     */
    //     "INSERT INTO ps_attribute_lang (id_attribute,id_lang,name)
    //         SELECT characteristic_id,'1',characteristic_value FROM knd1y_hikashop_characteristic WHERE characteristic_parent_id > 0 ORDER BY characteristic_id ASC",

    //     /**
    //     * TABLE ps_attribute_shop
    //     */
    //     "INSERT INTO ps_attribute_shop (id_attribute,id_shop)
    //         SELECT id_attribute,'1' FROM ps_attribute_lang ORDER BY id_attribute ASC",
        
    //     /**
    //     * TABLE ps_product_attribute
    //     */

    //     "ALTER TABLE ps_product_attribute ADD COLUMN id_productTemp INT(10) NOT NULL",
    //     "ALTER TABLE ps_product_attribute ADD INDEX temp (id_productTemp)",
    //     "ALTER TABLE ps_product_attribute CHANGE reference reference VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL",
        
    //     "INSERT INTO ps_product_attribute (id_product,id_productTemp,reference)
    //         SELECT product_parent_id,product_id,product_code
    //         FROM knd1y_hikashop_product
    //         WHERE product_type = 'variant' AND product_published = 1 AND product_parent_id > 0",
    
    //     "UPDATE ps_product_attribute AS psA
    //         JOIN knd1y_hikashop_price AS hikP ON psA.id_productTemp = hikP.price_product_id 
    //         SET psA.price = hikP.price_value",
        
    //     "ALTER TABLE ps_product_attribute DROP COLUMN id_productTemp",

    //    /**
    //     * TABLE ps_product_attribute_shop
    //     */
        
    //     "ALTER TABLE ps_product_attribute_shop CHANGE id_shop id_shop INT(10) UNSIGNED NOT NULL DEFAULT 1",
    
    //     "INSERT INTO ps_product_attribute_shop (id_product,id_product_attribute,price)
    //         SELECT id_product,id_product_attribute,price FROM ps_product_attribute AS newA
    //         ON DUPLICATE KEY UPDATE id_product = newA.id_product",
        
    //     "ALTER TABLE ps_product_attribute_shop CHANGE id_shop id_shop INT(10) UNSIGNED NOT NULL",
        
    // //     #TEMP
    // //             // "UPDATE ps_product_attribute_shop AS psS
    // //             //     JOIN ps_product_attribute AS psP USING (id_product)
    // //             //     SET psS.price = psP.price,
    // //             //     psS.default_on = psP.default_on",


     
    
    ];

    $messages = [
        "<b>VIDANGE TABLES CATEGORIES (1) -> Fonction</b>",
        "<b>VIDANGE TABLES CATEGORIES (2) -> Exécution Fonction</b>",
        // ps_category_product
        "<b>ps_category_product -> DROP PRIMARY KEY sur toute la table</b>",
        "<b>ps_category_product -> ADD id + AI + PRIMARY</b>",
        "<b>ps_category_product -> CHANGE valeur par default col id_product</b>",
        "<b>ps_category_product -> CHANGE valeur par default col id_category</b>",
        "<b>ps_category_product -> INSERT datas (id) </b>",
        "<b>ps_category_product -> UPDATE datas</b>",
        "<b>ps_category_product -> DROP id</b>",
        "<b>ps_category_product -> ADD PRIMARY KEY (id_category & id_product)</b>",
        // ps_category_group
        "<b>ps_category_group -> DROP PRIMARY KEY sur toute la table</b>",
        "<b>ps_category_group -> ADD id + AI + PRIMARY</b>",
        "<b>ps_category_group -> CHANGE valeur par default col id_product</b>",
        "<b>ps_category_group -> CHANGE valeur par default col id_category</b>",
        "<b>ps_category_group -> INSERT datas (id) </b>",
        "<b>ps_category_group -> UPDATE datas</b>",
        "<b>ps_category_group -> DROP id</b>",
        "<b>ps_category_group -> ADD PRIMARY KEY (id_category & id_product)</b>"

    ];

    $i = 0;
    $n = 1;
    foreach ($modif as $query) {
        $sth = $dbco->prepare($query);
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        echo '<p>&#10004; </p>';
    };
    // echo '<p>&#10004; ' . $n++ . ')</p>';
    // echo '<p>&#10004; ' . $n++ . ') ' . $messages[$i++] . '</p>';
    
   
  
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
