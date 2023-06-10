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
    // /**
    // * FILTERS    FILTERS    FILTERS
    // * FILTERS    FILTERS    FILTERS
    // * FILTERS    FILTERS    FILTERS
    // */
   
    //   "DROP PROCEDURE IF EXISTS CLEAR_TABLES",
    //     "CREATE PROCEDURE CLEAR_TABLES()
    //         BEGIN
    //             TRUNCATE TABLE ps_feature;
    //             TRUNCATE TABLE ps_feature_lang;
    //             TRUNCATE TABLE ps_feature_shop;
    //             TRUNCATE TABLE ps_layered_filter;
    //         END;",
    //     "CALL CLEAR_TABLES()",
        
    //    "INSERT INTO ps_feature (id_feature,position)
    //         SELECT filter_id, filter_ordering FROM knd1y_hikashop_filter",
        
    //     "INSERT INTO ps_feature_lang (id_feature,id_lang,name)
    //         SELECT filter_id, filter_published, filter_name FROM knd1y_hikashop_filter",
        
    //     "INSERT INTO ps_feature_shop (id_feature,id_shop)
    //         SELECT filter_id, 1 FROM knd1y_hikashop_filter",

    //     "ALTER TABLE `ps_layered_filter` CHANGE `n_categories` `n_categories` VARCHAR(255) NOT NULL",
    //     "INSERT INTO ps_layered_filter (name,filters,n_categories,date_add)
    //         SELECT 'Chenilles', filter_options, filter_category_id, CURRENT_TIMESTAMP FROM knd1y_hikashop_filter",
    //     // "ALTER TABLE `ps_layered_filter` CHANGE `n_categories` `n_categories` INT(10) NOT NULL",
   

    
    // /**
    // * Alimentation de la table 'ps_feature_value_lang'
    // */
 
    "ALTER TABLE `ps_feature_value_lang` CHANGE `id_feature_value` `id_feature_value` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT",
    "ALTER TABLE `ps_feature_value_lang` CHANGE `id_lang` `id_lang` INT(10) UNSIGNED NOT NULL DEFAULT '1'",
    "INSERT INTO ps_feature_value_lang (value)
    select qty
    from
    (
    select product_id, 'abc' word, produit_etat qty
    from knd1y_hikashop_product_temp
    where produit_etat != NULL
        UNION ALL
    select product_id, 'pvibrante_poids', pvibrante_poids
    from knd1y_hikashop_product_temp
        where pvibrante_poids != ''
            UNION ALL
    select product_id, 'motorisationplaquevibrante', motorisationplaquevibrante
    from knd1y_hikashop_product_temp
        where motorisationplaquevibrante != ''
    ) d
    order by product_id",
    "ALTER TABLE `ps_feature_value_lang` CHANGE `id_feature_value` `id_feature_value` INT(10) UNSIGNED NOT NULL",
    "ALTER TABLE `ps_feature_value_lang` CHANGE `id_lang` `id_lang` INT(10) UNSIGNED NOT NULL",

    // /**
    // * FIN Alimentation de la table 'ps_feature_value_lang'
    // */

    //  /**
    // * Alimentation de la table 'id_feature_value'
    // */

//     // "TRUNCATE TABLE ps_feature_value",
//     "ALTER TABLE `ps_feature_value` CHANGE `id_feature` `id_feature` INT(10) UNSIGNED NULL DEFAULT '0'",
//     "ALTER TABLE `ps_feature_value` CHANGE `custom` `custom` INT(10) UNSIGNED NULL DEFAULT '1'",
//     "INSERT INTO ps_feature_value (id_feature_value)
//       SELECT id_feature_value FROM ps_feature_value_lang",
    
//     // /**
//     // * FIN Alimentation de la table 'id_feature_value'
//     // */

//     /**
//     * Alimentation de la table 'ps_feature_value' - CAT 61
//     *
//     * MOD(t.id_feature_value, 4) = 1 -> sert à trier et récuper les id
//     * ici le n° 4 est le nombre de trie de la catégorie 
//     */
//    "INSERT INTO ps_feature_value (id_feature)
//         SELECT tt.filter_id
//         FROM ps_feature_value_lang AS t
//         JOIN  knd1y_hikashop_filter AS tt 
//         WHERE tt.filter_category_id = '73' 
//         AND tt.filter_published = '1'
//         AND MOD(t.id_feature_value, 96) = 1",

    /**
    * FIN Alimentation de la table 'ps_feature_value'
    */



    /**
    * Alimentation de la table 'ps_feature_product'
    * x étapes :
    * # 1 : on vide 'ps_feature_product' 
    *       et on injecte id_feature id_feature_value
    *       de ps_feature_value
    * # 2 : on crée une table temporaire 'temp' avec un index unique ('id','prod')
    *       et on inject 'product_id' issu de la table 'temp'
    *       'knd1y_hikashop_product_temp' qu'on transpose en sélectionnant
    *       les champs nécessaire à la catégorie
    * # 3 : on UPDATE 'ps_feature_product' avec la table 'temp' ('prod')
    *       en faisant matcher les id.
    *       Suppression de la table temp
    */
        // # étape 1 
        //     "TRUNCATE TABLE ps_feature_product",
        //     "ALTER TABLE `ps_feature_product` CHANGE `id_product` `id_product` INT(10) UNSIGNED NOT NULL DEFAULT '0'",
        //     "INSERT INTO ps_feature_product (id_feature,id_feature_value)
        //     SELECT id_feature,id_feature_value
        //     FROM ps_feature_value  AS newB 
        //     ON DUPLICATE KEY UPDATE id_feature = newB.id_feature ",
       
    //    # étape 2 
    // //    "DROP TABLE temp",
    //    "TRUNCATE TABLE temp",
    // //    "CREATE TABLE temp (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,prod INT(10))",
    //  //   "INSERT INTO temp (prod) select id_feature from ps_feature_value",
    //     "INSERT INTO temp (prod)
    //     select product_id
    // from
    // (
    //     select product_id, 'abc' word, produit_etat qty
    //         from knd1y_hikashop_product_temp
    //         where produit_etat != NULL
    //             UNION ALL
    //         select product_id, 'chenille_maillons', chenille_maillons
    //         from knd1y_hikashop_product_temp
    //             where chenille_maillons > 0
    //                 UNION ALL
    //         select product_id, 'chenille_width', chenille_width
    //         from knd1y_hikashop_product_temp
    //             where chenille_width > 0
    //                     UNION ALL
    //         select product_id, 'chenille_pas', chenille_pas
    //         from knd1y_hikashop_product_temp
    //             where chenille_pas > 0
    //             UNION ALL
    //             select product_id, 'chenille_gamme', chenille_gamme
    //         from knd1y_hikashop_product_temp
    //             where chenille_gamme != ''
    //             UNION ALL
    // select product_id, 'abc' word, produit_etat qty
    // from knd1y_hikashop_product_temp
    // where produit_etat != NULL
    //     UNION ALL
    // select product_id, 'pvibrante_poids', pvibrante_poids
    // from knd1y_hikashop_product_temp
    //     where pvibrante_poids != ''
    //         UNION ALL
    // select product_id, 'motorisationplaquevibrante', motorisationplaquevibrante
    // from knd1y_hikashop_product_temp
    //     where motorisationplaquevibrante != ''
    // ) d
    // order by product_id",
        
        // # étape 3 
        //     "UPDATE ps_feature_product AS pfp
        //     JOIN temp AS t ON pfp.id_feature_value = t.id
        //     SET pfp.id_product = t.prod",

    //         // "DROP TABLE temp"
    /**
    * FIN Alimentation de la table 'ps_feature_product'
    */

    ];
    foreach ($modif as $query) {
        $sth = $dbco->prepare($query);
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        echo '<p>&#10004; </p>';
    };



} catch (PDOException $e) {
    echo '<div class="erreur">&#10006;</br>Erreur de connexion
    </br>' . $e->getMessage() . '</div>';
}
