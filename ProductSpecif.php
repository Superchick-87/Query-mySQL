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
   

    /**
    * Création d'une table temporaire 'knd1y_hikashop_product_temp'
    * avec tous les produits publiés, on élimine ensuite les colonnes
    * selon les catégories
    */
   
    "DROP TABLE knd1y_hikashop_product_temp",
    "CREATE TABLE knd1y_hikashop_product_temp LIKE knd1y_hikashop_product",
    "INSERT INTO knd1y_hikashop_product_temp SELECT * FROM knd1y_hikashop_product
    WHERE product_published = 1",
    "ALTER TABLE `knd1y_hikashop_product_temp` ADD `id_cat` INT(10) NULL DEFAULT NULL FIRST",
    "UPDATE knd1y_hikashop_product_temp  AS ps
    JOIN ps_category_product AS pc 
    ON pc.id_product = ps.product_id
    SET ps.id_cat = pc.id_category",
    /**
     * Catégories chenilles
    */ 
    // "ALTER TABLE `knd1y_hikashop_product_temp` 
    //    DROP product_parent_id,
    //     DROP product_name,
    //     DROP product_description,
    //     DROP product_quantity,
    //     DROP product_code,
    //     DROP product_published,
    //     DROP product_hit,
    //     DROP product_created,
    //     DROP product_sale_start,
    //     DROP product_sale_end,
    //     DROP product_delay_id,
    //     DROP product_tax_id,
    //     DROP product_type,
    //     DROP product_vendor_id,
    //     DROP product_manufacturer_id,
    //     DROP product_url,
    //     DROP product_weight,
    //     DROP product_keywords,
    //     DROP product_weight_unit,
    //     DROP product_modified,
    //     DROP product_meta_description,
    //     DROP product_dimension_unit,
    //     DROP product_width,
    //     DROP product_length,
    //     DROP product_height,
    //     DROP product_max_per_order,
    //     DROP product_access,
    //     DROP product_group_after_purchase,
    //     DROP product_min_per_order,
    //     DROP product_contact,
    //     DROP product_last_seen_date,
    //     DROP product_sales,
    //     DROP product_waitlist,
    //     DROP product_layout,
    //     DROP product_average_score,
    //     DROP product_total_vote,
    //     DROP product_page_title,
    //     DROP product_alias,
    //     DROP product_price_percentage,
    //     DROP product_msrp,
    //     DROP product_canonical,
    //     DROP product_display_quantity_field,
    //     DROP produit_delais,
    //     DROP product_port_offerte,
    //     DROP chenille_type,
    //     DROP chenille_model_aichi,
    //     DROP chenille_model_hitachi,
    //     DROP chenille_model_airmann,
    //     DROP chenille_model_asv,
    //     DROP chenille_model_atlas,
    //     DROP chenille_model_atlas_copco,
    //     DROP chenille_model_bobcat,
    //     DROP chenille_model_case,
    //     DROP chenille_model_cat,
    //     DROP chenille_model_chikusu,
    //     DROP chenille_model_chikusui,
    //     DROP chenille_model_cormidi,
    //     DROP chenille_model_daewoo,
    //     DROP chenille_model_euromarch,
    //     DROP chenille_model_gehl,
    //     DROP chenille_model_hanix,
    //     DROP chenille_model_honda,
    //     DROP chenille_model_hyundai,
    //     DROP chenille_model_ihi,
    //     DROP chenille_model_jcb,
    //     DROP chenille_model_john_deere,
    //     DROP chenille_model_kobelco,
    //     DROP chenille_model_komatsu,
    //     DROP chenille_model_kubota,
    //     DROP chenille_model_mistubishi,
    //     DROP chenille_model_neuson,
    //     DROP chenille_model_new_holland,
    //     DROP chenille_model_peljob,
    //     DROP chenille_model_schaeff,
    //     DROP chenille_model_sumitomo,
    //     DROP chenille_model_takeuchi,
    //     DROP chenille_model_terex,
    //     DROP chenille_model_volvo,
    //     DROP chenille_model_yanmar,
    //     DROP chenille_model_wacker_neuson,
    //     DROP chenille_model_ihi_imer,
    //     DROP chenille_model_axi,
    //     DROP chenille_model_alpina,
    //     DROP chenille_model_angel,
    //     DROP chenille_model_antec,
    //     DROP chenille_model_atm,
    //     DROP chenille_model_avanttec,
    //     DROP chenille_model_baraldi,
    //     DROP chenille_model_basket,
    //     DROP chenille_model_bastei,
    //     DROP chenille_model_belle,
    //     DROP chenille_model_benny,
    //     DROP chenille_model_bentrac,
    //     DROP chenille_model_beretta,
    //     DROP chenille_model_bertolin,
    //     DROP chenille_model_bonne_esperance,
    //     DROP chenille_model_boxer,
    //     DROP chenille_model_brokk,
    //     DROP chenille_model_camisa,
    //     DROP chenille_model_cams_libra,
    //     DROP chenille_model_canycom,
    //     DROP chenille_model_carmix,
    //     DROP chenille_model_carrier,
    //     DROP chenille_model_carter,
    //     DROP chenille_model_chieftan,
    //     DROP chenille_model_coltrax,
    //     DROP chenille_model_comeca,
    //     DROP chenille_model_comet,
    //     DROP chenille_model_ditchwitch,
    //     DROP chenille_model_dynapac,
    //     DROP chenille_model_ecomat,
    //     DROP chenille_model_eurocat,
    //     DROP chenille_model_eurocomach,
    //     DROP chenille_model_eurodig,
    //     DROP chenille_model_eurotom,
    //     DROP chenille_model_eurotrac,
    //     DROP chenille_model_foredil,
    //     DROP chenille_model_fraste,
    //     DROP chenille_model_grillo,
    //     DROP chenille_model_haulotte,
    //     DROP chenille_model_holmac,
    //     DROP chenille_model_husqvarna,
    //     DROP chenille_model_hydra,
    //     DROP chenille_model_hydro_rain,
    //     DROP chenille_model_imef,
    //     DROP chenille_model_iwafuji,
    //     DROP chenille_model_kato_imer,
    //     DROP chenille_model_leo,
    //     DROP chenille_model_maweco,
    //     DROP chenille_model_mecbo,
    //     DROP chenille_model_merlo,
    //     DROP chenille_model_messersi,
    //     DROP chenille_model_mustang,
    //     DROP chenille_model_nagano,
    //     DROP chenille_model_navago,
    //     DROP chenille_model_niko,
    //     DROP chenille_model_nissan,
    //     DROP chenille_model_octopus,
    //     DROP chenille_model_ormac,
    //     DROP chenille_model_pagani,
    //     DROP chenille_model_palazzani,
    //     DROP chenille_model_paus_her,
    //     DROP chenille_model_pazzagli,
    //     DROP chenille_model_rampicar,
    //     DROP chenille_model_rufener,
    //     DROP chenille_model_sato,
    //     DROP chenille_model_satvia,
    //     DROP chenille_model_scattrac,
    //     DROP chenille_model_silla,
    //     DROP chenille_model_smcsand,
    //     DROP chenille_model_soma,
    //     DROP chenille_model_tekna,
    //     DROP chenille_model_terex_schaeff,
    //     DROP chenille_model_thomas,
    //     DROP chenille_model_vermeer,
    //     DROP chenille_model_winbull,
    //     DROP chenille_model_ammann,
    //     DROP product_ean,
    //     DROP product_sort_price,
    //     DROP product_description_raw,
    //     DROP product_description_type,
    //     DROP product_option_method,
    //     DROP product_condition,
    //     DROP eco_taxes,
    //     DROP product_made_in,
    //     DROP model_agrifull,
    //     DROP model_badger,
    //     DROP model_bantam,
    //     DROP model_bauer,
    //     DROP model_benati,
    //     DROP model_benfra,
    //     DROP model_bryot,
    //     DROP modelbumarw,
    //     DROP model_bumarw,
    //     DROP model_carraro,
    //     DROP model_casagr,
    //     DROP model_cmicat,
    //     DROP model_cnh,
    //     DROP model_cosmoter,
    //     DROP model_cubex,
    //     DROP model_demag,
    //     DROP model_drott,
    //     DROP model_eder,
    //     DROP model_etec,
    //     DROP model_eurocoma,
    //     DROP model_ewk,
    //     DROP model_fai,
    //     DROP model_faun,
    //     DROP model_fermec,
    //     DROP model_fiat_hitachi,
    //     DROP model_fiat_kobelco,
    //     DROP model_fuchs,
    //     DROP model_fundex,
    //     DROP model_furukawa,
    //     DROP model_gardenv,
    //     DROP model_goldoni_lander,
    //     DROP model_gradall,
    //     DROP model_guria,
    //     DROP model_hammel,
    //     DROP model_hanomag,
    //     DROP model_harnsch,
    //     DROP model_heinw,
    //     DROP model_hoes,
    //     DROP model_hydromac,
    //     DROP model_hymac,
    //     DROP model_insley,
    //     DROP model_itma,
    //     DROP model_juntan,
    //     DROP model_klemann,
    //     DROP model_kranex,
    //     DROP model_laltesi,
    //     DROP model_lamborghini,
    //     DROP model_landini,
    //     DROP model_lannen,
    //     DROP model_libra,
    //     DROP model_liebherr,
    //     DROP model_macmoter,
    //     DROP model_mecalac,
    //     DROP model_menck,
    //     DROP model_mengele,
    //     DROP model_masseyferguson,
    //     DROP model_oek,
    //     DROP model_pmi,
    //     DROP model_powerscreen,
    //     DROP model_priest,
    //     DROP model_primetech,
    //     DROP model_pve,
    //     DROP model_reedrill,
    //     DROP model_richier,
    //     DROP model_rock,
    //     DROP model_same,
    //     DROP model_samsung,
    //     DROP model_sandvik,
    //     DROP model_sany,
    //     DROP model_schwing,
    //     DROP model_sennebog,
    //     DROP model_simit,
    //     DROP model_soilmec,
    //     DROP model_sunward,
    //     DROP model_tata,
    //     DROP model_terexpegson,
    //     DROP model_weserh,
    //     DROP model_wieger,
    //     DROP model_wirtgen,
    //     DROP model_ygry,
    //     DROP model_yuchai,
    //     DROP model_yumbo,
    //     DROP model_yutani,
    //     DROP model_zeppelin,
    //     DROP model_atlasterex,
    //     DROP model_kato,
    //     DROP product_eta,
    //     DROP chenille_model_ausa,
    //     DROP chenille_model_bellgroup,
    //     DROP chenille_model_manitou,
    //     DROP devis_form,
    //     DROP produit_occasion_heure,
    //     DROP produit_occasion_an",
    
    /**
    * Alimentation de la table 'ps_feature_value_lang'
    */
    "TRUNCATE TABLE ps_feature_value_lang",
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
    select product_id, 'chenille_maillons', chenille_maillons
    from knd1y_hikashop_product_temp
        where chenille_maillons > 0
            UNION ALL
    select product_id, 'chenille_width', chenille_width
    from knd1y_hikashop_product_temp
        where chenille_width > 0
                UNION ALL
    select product_id, 'chenille_pas', chenille_pas
    from knd1y_hikashop_product_temp
        where chenille_pas > 0
        UNION ALL
        select product_id, 'chenille_gamme', chenille_gamme
    from knd1y_hikashop_product_temp
        where chenille_gamme != ''

    ) d
    order by product_id",
    "ALTER TABLE `ps_feature_value_lang` CHANGE `id_feature_value` `id_feature_value` INT(10) UNSIGNED NOT NULL",
    "ALTER TABLE `ps_feature_value_lang` CHANGE `id_lang` `id_lang` INT(10) UNSIGNED NOT NULL",

    /**
    * FIN Alimentation de la table 'ps_feature_value_lang'
    */

    /**
    * Alimentation de la table 'id_feature_value'
    */

    "TRUNCATE TABLE ps_feature_value",
    "ALTER TABLE `ps_feature_value` CHANGE `id_feature` `id_feature` INT(10) UNSIGNED NULL DEFAULT '0'",
    "ALTER TABLE `ps_feature_value` CHANGE `custom` `custom` INT(10) UNSIGNED NULL DEFAULT '1'",
    "INSERT INTO ps_feature_value (id_feature_value)
      SELECT id_feature_value FROM ps_feature_value_lang",
    
    /**
    * FIN Alimentation de la table 'id_feature_value'
    */

    /**
    * Alimentation de la table 'ps_feature_value' - CAT 61
    *
    * MOD(t.id_feature_value, 4) = 1 -> sert à trier et récuper les id
    * ici le n° 4 est le nombre de trie de la catégorie 
    */

        "TRUNCATE TABLE ps_feature_value",
        "INSERT INTO ps_feature_value (id_feature)
        SELECT tt.filter_id
        FROM ps_feature_value_lang AS t
        JOIN  knd1y_hikashop_filter AS tt 
        WHERE tt.filter_category_id = '61' 
        AND tt.filter_published = '1'
        AND MOD(t.id_feature_value, 4) = 1",
     

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
        # étape 1 
            "TRUNCATE TABLE ps_feature_product",
            "ALTER TABLE `ps_feature_product` CHANGE `id_product` `id_product` INT(10) UNSIGNED NOT NULL DEFAULT '0'",
            "INSERT INTO ps_feature_product (id_feature,id_feature_value)
            SELECT id_feature,id_feature_value
            FROM ps_feature_value  AS newB 
            ON DUPLICATE KEY UPDATE id_feature = newB.id_feature ",
       
       # étape 2 
       "DROP TABLE temp",
       "CREATE TABLE temp (id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,prod INT(10),toto VARCHAR(255))",

        "INSERT INTO temp (prod,toto)
        select product_id, qty
            from
            (
            select product_id, 'abc' word, produit_etat qty
            from knd1y_hikashop_product_temp
            where produit_etat != NULL
                UNION ALL
            select product_id, 'chenille_maillons', chenille_maillons
            from knd1y_hikashop_product_temp
                where chenille_maillons > 0
                    UNION ALL
            select product_id, 'chenille_width', chenille_width
            from knd1y_hikashop_product_temp
                where chenille_width > 0
                        UNION ALL
            select product_id, 'chenille_pas', chenille_pas
            from knd1y_hikashop_product_temp
                where chenille_pas > 0
                UNION ALL
                select product_id, 'chenille_gamme', chenille_gamme
            from knd1y_hikashop_product_temp
                where chenille_gamme != ''

            ) d
            order by product_id",
        
        # étape 3 
            "UPDATE ps_feature_product AS pfp
            JOIN temp AS t ON pfp.id_feature_value = t.id
            SET pfp.id_product = t.prod",

            // "DROP TABLE temp"
    /**
    * FIN Alimentation de la table 'ps_feature_product'
    */
/**
 * Pour remplir la table ...?
 */
    // SELECT * FROM `ps_category_product` AS ps
    // JOIN knd1y_hikashop_filter AS hkf
    // ON hkf.filter_category_id = ps.id_category
    // WHERE `id_category` = 61 AND filter_published = 1
    // ORDER BY `id_category` ASC  
    


/**
* FIN Alimentation de la table 'id_feature_value'
*/

/**
 * Pour remplir la table ps_feature_product
 */
// INSERT INTO ps_feature_product (id_feature, id_product, id_feature_value)
// SELECT fp.id_feature, p.id_product, fv.id_feature_value
// FROM ps_product p
// JOIN ps_feature_product fp ON p.id_product = fp.id_product
// JOIN ps_feature_value fv ON fp.id_feature_value = fv.id_feature_value;

    ];
    foreach ($modif as $query) {
        $sth = $dbco->prepare($query);
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        echo '<p>&#10004; </p>';
    };



// $toto = "SELECT filter_category_id,filter_name,filter_id FROM `knd1y_hikashop_filter`";
// $requeteidD1 = $dbco->prepare($toto);
// $requeteidD1->execute();
// $joueurD1 = $requeteidD1->fetchall();
// $i=0;
// $c=0;
// $b=0;
// $tutu = "SELECT*FROM `ps_feature_product` 
// WHERE id_product = 4";
   
// $requete = $dbco->prepare($tutu);
// $requete->execute();
// $xx = $requete->fetchall();
  
    // SELECT*FROM `knd1y_hikashop_product` AS hk 
    // JOIN ps_category_product AS ps 
    // JOIN knd1y_hikashop_filter AS hkf
    // WHERE product_published >0 AND hk.`product_id` = ps.id_product AND hkf.filter_category_id = ps.id_category  
    // ORDER BY hk.`product_id` ASC

// echo count($joueurD1).'</br>';
// for ($i=0; $i < count($joueurD1); $i++) { 
//     $yy = array($joueurD1[$i][2]);
//         if ($joueurD1[$i][0] == '61') {
//             echo $joueurD1[$i][2].' | '.$joueurD1[$i][1].' | '.$joueurD1[$i][0].'</br>';
//             $reww = $dbco->prepare(
//                     "INSERT INTO `ps_feature_product` (`id_feature`, `id_product`, `id_feature_value`)
//                         VALUES ('".$joueurD1[$i][2]."', '4', '17')");
//                 $reww->execute();
//                 $ff = $reww->fetchall();
//             }
// }

} catch (PDOException $e) {
    echo '<div class="erreur">&#10006;</br>Erreur de connexion
    </br>' . $e->getMessage() . '</div>';
}
