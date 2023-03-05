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
    * CATEGORIES     CATEGORIES    CATEGORIES
    * CATEGORIES     CATEGORIES    CATEGORIES
    * CATEGORIES     CATEGORIES    CATEGORIES
    */

        /**
         * VIDANGE TABLES CATEGORIES
         */
        // "DROP PROCEDURE IF EXISTS CLEAR_TABLES",
        // "CREATE PROCEDURE CLEAR_TABLES()
        //     BEGIN
        //         TRUNCATE TABLE ps_category;
        //         TRUNCATE TABLE ps_category_lang;
        //         TRUNCATE TABLE ps_category_product;
        //         -- etc ...
        //     END;",
        // "CALL CLEAR_TABLES()"

        /**
        * TABLE ps_category
        */
        // #1 - INSERT temp colonne id
        //     "INSERT INTO ps_category (id_category) SELECT category_id FROM knd1y_hikashop_category",

        // #2 - UPDATE datas <- knd1y_hikashop_category
            // "UPDATE ps_category AS ps
            // JOIN knd1y_hikashop_category AS hik
            // ON ps.id_category = hik.category_id
            // SET ps.id_parent        = hik.category_parent_id,
            //     ps.id_shop_default  = '1',
            //     ps.level_depth      = hik.category_depth,
            //     ps.nleft            = hik.category_left,
            //     ps.nright           = hik.category_right,
            //     ps.active           = hik.category_published,
            //     ps.date_add         = CURDATE(),
            //     ps.date_upd         = CURDATE(),
            //     ps.position         = hik.category_ordering,
            //     ps.is_root_category = '0'", 

        /**
        * TABLE ps_category_lang
        */
        // // #1 - INSERT id_category
        //     "INSERT INTO ps_category_lang (id_category) SELECT category_id FROM knd1y_hikashop_category",

        // // #2 - UPDATE datas <- knd1y_hikashop_category
        //     "UPDATE ps_category_lang AS ps
        //     JOIN knd1y_hikashop_category AS hik
        //     ON ps.id_category = hik.category_id
        //     SET ps.id_shop          = '1',
        //         ps.id_lang          = '1',
        //         ps.name             = hik.category_name,
        //         ps.description      = hik.category_description,
        //         ps.link_rewrite     = hik.category_alias,
        //         ps.meta_title       = hik.category_page_title,
        //         ps.meta_keywords    = hik.category_keywords,
        //         ps.meta_description = hik.category_meta_description",

        /**
        * TABLE ps_category_product
        */
        // // #1 - SUPRESSION la clé primaire sur la table
        //     "ALTER TABLE ps_category_product DROP PRIMARY KEY",

        // // #2 - AJOUT colonne id + AI + PRIMARY
        //     "ALTER TABLE ps_category_product ADD id INT(255) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (id)",

        // // #3 - CHANGE valeur par default cols id_product + id_category
        //     " ALTER TABLE ps_category_product CHANGE id_product id_product INT(10) UNSIGNED NULL DEFAULT NULL",
        //     " ALTER TABLE ps_category_product CHANGE id_category id_category  INT(10) UNSIGNED NULL DEFAULT NULL",

        // // #4 - INSERT temp colonne id
        //     "INSERT INTO ps_category_product (id) SELECT product_category_id FROM knd1y_hikashop_product_category",

        // // #5 - UPDATE datas <- knd1y_hikashop_product_category
        //     "UPDATE ps_category_product AS ps
        //     JOIN knd1y_hikashop_product_category AS hik ON ps.id = hik.product_category_id
        //     SET ps.id_category  = hik.category_id,
        //         ps.id_product   = hik.product_id,
        //         ps.position    = hik.ordering",

        // // #6 - SUPRESSION colonne id
        //     "ALTER TABLE ps_category_product DROP COLUMN id",

        // // #7 - AJOUT la clé primaire sur id_category & id_product
        //     "ALTER TABLE ps_category_product ADD PRIMARY KEY (id_category,id_product)",

        // /**
        //  * TABLE ps_category_group
        //  */
        // // #1 - SUPRESSION la clé primaire sur la table
        //     "ALTER TABLE ps_category_group DROP PRIMARY KEY",
        //     "ALTER TABLE ps_category_group DROP INDEX id_category",
        //     "ALTER TABLE ps_category_group DROP INDEX id_group",

        // // #2 - AJOUT colonne id + AI + PRIMARY
        //     "ALTER TABLE ps_category_group ADD id INT(255) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (id)",

        // // #3 - CHANGE valeur par default cols id_product + id_category
        //     " ALTER TABLE ps_category_group CHANGE id_category id_category INT(10) UNSIGNED NULL DEFAULT NULL",
        //     " ALTER TABLE ps_category_group CHANGE 	id_group id_group INT(10) UNSIGNED NULL DEFAULT NULL",

        // // #4 - INSERT temp colonne id
        //     "INSERT INTO ps_category_group (id_category) SELECT id_category FROM ps_category",

        // // #5 - UPDATE datas <- 3 pour la visibilité de tous les visiteurs
        //     "UPDATE ps_category_group SET id_group = '3'",

        // // #6 - SUPRESSION colonne id
        //     "ALTER TABLE ps_category_group DROP COLUMN id",

        // // #7 - AJOUT INDEX & PRIMARY la clé primaire sur id_category & id_product
        //     "ALTER TABLE ps_category_group ADD INDEX id_category (id_category) USING BTREE",
        //     "ALTER TABLE ps_category_group ADD INDEX id_group (id_group) USING BTREE",
        //     "ALTER TABLE ps_category_group ADD PRIMARY KEY (id_category,id_group)"


    /**
     * PRODUCTS     PRODUCTS    PRODUCTS
     * PRODUCTS     PRODUCTS    PRODUCTS
     * PRODUCTS     PRODUCTS    PRODUCTS
     */

         
         /**
         * VIDANGE TABLES PRODUCTS
         */
        "DROP PROCEDURE IF EXISTS CLEAR_TABLES_PRODUCT",
        "CREATE PROCEDURE CLEAR_TABLES_PRODUCT()
            BEGIN
                TRUNCATE TABLE ps_product;
                TRUNCATE TABLE ps_product_lang;
                TRUNCATE TABLE ps_product_shop;
                TRUNCATE TABLE ps_layered_price_index;
            END;",
        "CALL CLEAR_TABLES_PRODUCT()",
        
        // /**
        //  * TABLE ps_product
        //  */
        // // #1 - ALTER TABLE id_product
        "ALTER TABLE ps_product CHANGE id_tax_rules_group id_tax_rules_group INT(11) UNSIGNED NOT NULL DEFAULT 1",
        "ALTER TABLE ps_product CHANGE active active TINYINT(1) UNSIGNED NOT NULL DEFAULT 1",
        "ALTER TABLE ps_product CHANGE reference reference VARCHAR(255) NULL",
        "ALTER TABLE ps_product CHANGE date_add date_add datetime NOT NULL DEFAULT '2023-03-02 18:22:03'",
        "ALTER TABLE ps_product CHANGE date_upd date_upd  datetime NOT NULL DEFAULT '2023-03-20 00:21:57'",
        "ALTER TABLE ps_product CHANGE price price decimal(20,6) NOT NULL DEFAULT '0.00000'",
        
        // #2 - INSERT id_product
        "INSERT INTO ps_product (id_product) SELECT product_id FROM knd1y_hikashop_product",

        // #3 - UPDATE ps_product
        "UPDATE ps_product AS ps
        JOIN knd1y_hikashop_product AS hik ON ps.id_product = hik.product_id
        JOIN knd1y_hikashop_price AS hikPrice ON ps.id_product = hikPrice.price_product_id
        SET ps.id_supplier          = '0',
            ps.id_manufacturer      = '0',
            ps.id_shop_default      = '1',
            ps.online_only          = '0',
            ps.on_sale              = '0',
            ps.show_condition       = '1',
            ps.quantity             = '10',
            ps.unity                = hik.product_weight_unit,
            ps.reference            = hik.product_code,
            ps.supplier_reference   = ps.reference,
            ps.width                = hik.product_width,
            ps.height               = hik.product_height,
            ps.weight               = hik.product_weight,
            ps.active               = hik.product_published,
            ps.product_type         = 'standard',
            ps.id_category_default  = '2',
            ps.price                = hikPrice.price_value",
            // ps.id_category_default  = hikCat.category_id",

    //    /**
    //      * TABLE ps_product_lang
    //      */

        // #1 - ALTER TABLE ps_product_lang
        "ALTER TABLE ps_product_lang CHANGE id_lang id_lang INT(10) NOT NULL DEFAULT '1'",
        "ALTER TABLE ps_product_lang CHANGE link_rewrite link_rewrite VARCHAR(255) NOT NULL DEFAULT ''",
        "ALTER TABLE ps_product_lang CHANGE name name VARCHAR(255) NOT NULL DEFAULT ''",
        "ALTER TABLE ps_product_lang CHANGE meta_title meta_title VARCHAR(255) NULL DEFAULT ''",
        "ALTER TABLE ps_product_lang CHANGE available_now available_now VARCHAR(255) NULL DEFAULT 'En stock'",
        "INSERT INTO ps_product_lang (id_product) SELECT id_product FROM ps_product",
        
        // #2 - UPDATE ps_product_lang
        "DROP FUNCTION IF EXISTS remove_accents",
        $remove_accents,
        "UPDATE ps_product_lang AS psLang
        JOIN ps_product AS ps USING (id_product)
        JOIN knd1y_hikashop_product AS hikK ON ps.id_product = hikK.product_id
        SET psLang.description          = hikK.product_description,
            psLang.description_short    = hikK.product_meta_description,
            psLang.link_rewrite         = LOWER(remove_accents(hikK.product_name)),
            psLang.meta_description     = hikK.product_meta_description,
            psLang.meta_keywords        = hikK.product_keywords,
            psLang.meta_title           = hikK.product_page_title,
            psLang.name                 = hikK.product_name",

        /**
         * TABLE ps_product_shop
         */
        // #1 - ALTER TABLE ps_product_shop
        "ALTER TABLE ps_product_shop CHANGE active active TINYINT(1) UNSIGNED NOT NULL DEFAULT 1",
        "ALTER TABLE ps_product_shop CHANGE id_tax_rules_group id_tax_rules_group INT(11) UNSIGNED NOT NULL DEFAULT 1",
        "ALTER TABLE ps_product_shop CHANGE id_shop id_shop INT(10) UNSIGNED NOT NULL DEFAULT 1",
        "ALTER TABLE ps_product_shop CHANGE cache_default_attribute cache_default_attribute INT(10) UNSIGNED NULL DEFAULT 0",
        "ALTER TABLE ps_product_shop CHANGE indexed indexed tinyint(1) UNSIGNED NOT NULL DEFAULT 1",
        "ALTER TABLE ps_product_shop CHANGE date_add date_add datetime NOT NULL DEFAULT '2023-03-02 18:22:03'",
        "ALTER TABLE ps_product_shop CHANGE date_upd date_upd datetime NOT NULL DEFAULT '2023-03-20 00:21:57'",
        
        // #2 - INSERT id_product
        "INSERT INTO ps_product_shop(id_product) SELECT product_id FROM knd1y_hikashop_product",

        // #3 - UPDATE ps_product_shop
        "UPDATE ps_product_shop AS psShop
            JOIN ps_product AS ps USING (id_product)
            SET psShop.price = ps.price,
            psShop.id_category_default  = '2'",

    /**
     * TABLE ps_layered_price_index
     */
        #1 - ALTER TABLE ps_layered_price_index
        "ALTER TABLE ps_layered_price_index DROP PRIMARY KEY",
        "ALTER TABLE ps_layered_price_index CHANGE id_currency id_currency INT(11) NOT NULL DEFAULT 1",
        "ALTER TABLE ps_layered_price_index CHANGE id_shop id_shop INT(10) UNSIGNED NOT NULL DEFAULT 1",
        "ALTER TABLE ps_layered_price_index CHANGE id_country id_country INT(11) NOT NULL DEFAULT 8",
        "ALTER TABLE ps_layered_price_index CHANGE price_min price_min decimal(20.6) NOT NULL DEFAULT 0",
        "ALTER TABLE ps_layered_price_index CHANGE price_max price_max decimal(20.6) NOT NULL DEFAULT 0",
        
        #2 - INSERT id_product
        "INSERT INTO ps_layered_price_index(id_product) SELECT product_id FROM knd1y_hikashop_product",
        
        #3 - UPDATE ps_product_shop
        "ALTER TABLE ps_layered_price_index ADD PRIMARY KEY (id_product,id_currency,id_shop,id_country)"
        


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

   


} catch (PDOException $e) {
    echo '<div class="erreur">&#10006;</br>Erreur de connexion
    </br>' . $e->getMessage() . '</div>';
}
