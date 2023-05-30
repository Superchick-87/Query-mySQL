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
    // * ATTRIBUTES     ATTRIBUTES    ATTRIBUTES
    // * ATTRIBUTES     ATTRIBUTES    ATTRIBUTES
    // * ATTRIBUTES     ATTRIBUTES    ATTRIBUTES
    // */
   
    //   "DROP PROCEDURE IF EXISTS CLEAR_TABLES",
    //     "CREATE PROCEDURE CLEAR_TABLES()
    //         BEGIN
    //             TRUNCATE TABLE ps_product_attribute;
    //             TRUNCATE TABLE ps_product_attribute_shop;
    //             TRUNCATE TABLE ps_attribute;
    //             TRUNCATE TABLE ps_attribute_lang;
    //             -- TRUNCATE TABLE ps_layered_product_attribute;
    //         END;",
    //     "CALL CLEAR_TABLES()",
       
    //     /**
    //     * TABLE ps_product_attribute
    //     */
    //     "ALTER TABLE ps_product_attribute ADD COLUMN id_productTemp INT(10) NOT NULL",
    //     "ALTER TABLE ps_product_attribute ADD INDEX temp (id_productTemp)",
    //     "ALTER TABLE ps_product_attribute CHANGE reference reference VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL",
        
    //     "INSERT INTO ps_product_attribute (id_product,id_productTemp,reference)
    //         SELECT product_parent_id,product_id,product_code
    //         FROM knd1y_hikashop_product
    //         WHERE product_type = 'variant'",
    
    //     "UPDATE ps_product_attribute AS psA
    //         JOIN knd1y_hikashop_price AS hikP ON psA.id_productTemp = hikP.price_product_id 
    //         SET psA.price = hikP.price_value",
        
   
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


    //     /**
    //     * TABLE ps_attribute
    //     */
    //     "ALTER TABLE ps_attribute ADD COLUMN id_productTemp INT(10) NOT NULL",
    //     "ALTER TABLE ps_attribute CHANGE id_attribute_group id_attribute_group INT(11) UNSIGNED NOT NULL DEFAULT 1",
    //     "ALTER TABLE ps_attribute CHANGE color color  VARCHAR(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL",
    //     "ALTER TABLE ps_attribute CHANGE position position INT(11) NULL DEFAULT NULL",
        
    //     "INSERT INTO ps_attribute (id_productTemp)
    //         SELECT id_product_attribute FROM ps_product_attribute",
        
    //     "ALTER TABLE ps_attribute CHANGE id_attribute_group id_attribute_group INT(11) UNSIGNED NOT NULL",
    //     "ALTER TABLE ps_attribute DROP COLUMN id_productTemp",
        
    //     /**
    //     * TABLE ps_attribute_lang
    //     */
    //     "ALTER TABLE ps_attribute_lang ADD COLUMN id_attributeTemp INT(10) NOT NULL",
    //     "ALTER TABLE ps_attribute_lang ADD INDEX temp (id_attributeTemp)",

    //     "ALTER TABLE ps_attribute_lang CHANGE id_lang id_lang INT(11) NOT NULL DEFAULT 1",
    //     "ALTER TABLE ps_attribute_lang CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL",
        
    //     "INSERT INTO ps_attribute_lang (id_attribute,id_attributeTemp)
    //     SELECT id_product_attribute,id_productTemp FROM ps_product_attribute",
        
    //     "UPDATE ps_attribute_lang AS psAL
    //     JOIN ps_product_attribute AS psL ON psL.id_productTemp = psAL.id_attributeTemp 
    //     SET psAL.name = psL.reference",
        
    //     "ALTER TABLE ps_attribute_lang DROP COLUMN id_attributeTemp",
    //     "ALTER TABLE ps_product_attribute DROP COLUMN id_productTemp",

        //  /**
        // * TABLE ps_layered_product_attribute
        // */
        
        // "ALTER TABLE ps_layered_product_attribute CHANGE id_attribute_group id_attribute_group INT(10) UNSIGNED NOT NULL DEFAULT 1",
        // "ALTER TABLE ps_layered_product_attribute CHANGE id_shop id_shop INT(10) UNSIGNED NOT NULL DEFAULT 1",
    
        // "INSERT INTO ps_layered_product_attribute (id_product)
        //     SELECT id_product FROM ps_product_attribute",


        
        
       

       
    /**
    * CATEGORIES     CATEGORIES    CATEGORIES
    * CATEGORIES     CATEGORIES    CATEGORIES
    * CATEGORIES     CATEGORIES    CATEGORIES
    */


        /**
         * VIDANGE TABLES CATEGORIES
         */
        "DROP PROCEDURE IF EXISTS CLEAR_TABLES",
        "CREATE PROCEDURE CLEAR_TABLES()
            BEGIN
                TRUNCATE TABLE ps_category;
                TRUNCATE TABLE ps_category_lang;
                TRUNCATE TABLE ps_category_product;
                TRUNCATE TABLE ps_category_group;
                TRUNCATE TABLE ps_category_shop;
                -- etc ...
            END;",
        "CALL CLEAR_TABLES()",
        
        
        /**
        * TABLE ps_category
        */
        #1 - INSERT temp colonne id
            "INSERT INTO ps_category (id_category)
            SELECT category_id FROM knd1y_hikashop_category
            WHERE category_type = 'root'",

            "INSERT INTO ps_category (id_category)
            SELECT category_id FROM knd1y_hikashop_category
            WHERE category_published = 1 AND category_type = 'product'",

        #2 - UPDATE datas <- knd1y_hikashop_category
            "UPDATE ps_category AS ps
            JOIN knd1y_hikashop_category AS hik
            ON ps.id_category = hik.category_id
            SET ps.id_parent        = hik.category_parent_id,
                ps.id_shop_default  = '1',
                ps.level_depth      = hik.category_depth,
                ps.nleft            = hik.category_left,
                ps.nright           = hik.category_right,
                ps.active           = hik.category_published,
                ps.date_add         = CURDATE(),
                ps.date_upd         = CURDATE(),
                ps.position         = hik.category_ordering,
                ps.is_root_category = '0'", 
            
            "UPDATE `ps_category` SET `nleft` = '0', `nright` = '0'
            WHERE `ps_category`.`id_category` < 3",
            
            "UPDATE `ps_category` SET `is_root_category` = '1'
            WHERE `ps_category`.`id_category` = 2",
            

        /**
        * TABLE ps_category_lang
        */
        // #1 - INSERT id_category
            "INSERT INTO ps_category_lang (id_category) SELECT category_id FROM knd1y_hikashop_category",

        // #2 - UPDATE datas <- knd1y_hikashop_category
        // $remove_accents,
            "UPDATE ps_category_lang AS ps
            JOIN knd1y_hikashop_category AS hik
            ON ps.id_category = hik.category_id
            SET ps.id_shop          = '1',
                ps.id_lang          = '1',
                ps.name             = hik.category_name,
                ps.description      = hik.category_description,
                ps.meta_title       = hik.category_page_title,
                ps.meta_keywords    = hik.category_keywords,
                ps.meta_description = hik.category_meta_description",
            
            "UPDATE ps_category_lang AS ps
            SET ps.link_rewrite = LOWER(remove_accents(ps.name))",

        /**
        * TABLE ps_category_product
        */
        // #1 - SUPRESSION la clé primaire sur la table
            "ALTER TABLE ps_category_product DROP PRIMARY KEY",

        // #2 - AJOUT colonne id + AI + PRIMARY
            "ALTER TABLE ps_category_product ADD id INT(255) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (id)",

        // #3 - CHANGE valeur par default cols id_product + id_category
            " ALTER TABLE ps_category_product CHANGE id_product id_product INT(10) UNSIGNED NULL DEFAULT NULL",
            " ALTER TABLE ps_category_product CHANGE id_category id_category  INT(10) UNSIGNED NULL DEFAULT NULL",

        // #4 - INSERT temp colonne id
            "INSERT INTO ps_category_product (id) SELECT product_category_id FROM knd1y_hikashop_product_category",

        // #5 - UPDATE datas <- knd1y_hikashop_product_category
            "UPDATE ps_category_product AS ps
            JOIN knd1y_hikashop_product_category AS hik ON ps.id = hik.product_category_id
            SET ps.id_category  = hik.category_id,
                ps.id_product   = hik.product_id,
                ps.position    = hik.ordering",

        // #6 - SUPRESSION colonne id
            "ALTER TABLE ps_category_product DROP COLUMN id",

        // #7 - AJOUT la clé primaire sur id_category & id_product
            "ALTER TABLE ps_category_product ADD PRIMARY KEY (id_category,id_product)",

        /**
         * TABLE ps_category_group
         */
       
        // #3 - CHANGE valeur par default cols id_product + id_category
            " ALTER TABLE ps_category_group CHANGE id_category id_category INT(10) UNSIGNED NOT NULL DEFAULT 1",
            " ALTER TABLE ps_category_group CHANGE 	id_group id_group INT(10) UNSIGNED NOT NULL DEFAULT 1",
            "INSERT INTO ps_category_group (id_category)
                SELECT id_category FROM ps_category AS newA
                ON DUPLICATE KEY UPDATE id_category = newA.id_category",

            #5 - UPDATE datas <- 3 pour la visibilité de tous les visiteurs
           
        " ALTER TABLE ps_category_group CHANGE 	id_group id_group INT(10) UNSIGNED NOT NULL DEFAULT 2",
        "INSERT INTO ps_category_group (id_category)
            SELECT id_category FROM ps_category AS newB  
            ON DUPLICATE KEY UPDATE id_category = newB.id_category",
        
        " ALTER TABLE ps_category_group CHANGE 	id_group id_group INT(10) UNSIGNED NOT NULL DEFAULT 3",
        
        "INSERT INTO ps_category_group (id_category)
            SELECT id_category FROM ps_category AS newC  
            ON DUPLICATE KEY UPDATE id_category = newC.id_category",            
        
    /**
    * TABLE ps_category_shop
    */ 
    "ALTER TABLE ps_category_shop CHANGE id_shop id_shop INT(11) NOT NULL DEFAULT 1",
    "ALTER TABLE ps_category_shop CHANGE position position INT(10) NOT NULL DEFAULT 0",
    
    "INSERT INTO ps_category_shop (id_category)
    SELECT id_category FROM ps_category",
    
    "UPDATE ps_category_shop AS ps
    JOIN ps_category AS psCat USING (id_category)
    SET ps.position = psCat.position", 

    "ALTER TABLE ps_category_shop CHANGE id_shop id_shop INT(11) NOT NULL",
    "ALTER TABLE ps_category_shop CHANGE position position INT(10) NOT NULL",


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
        "INSERT INTO ps_product (id_product) SELECT product_id FROM knd1y_hikashop_product
        WHERE product_published = 1 AND product_type = 'main'",

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
            ps.price                = hikPrice.price_value
            WHERE hik.product_published = 1",
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
    
        // DELAIS LIVRAISON
        // "ALTER TABLE ps_product_lang CHANGE delivery_in_stock delivery_in_stock TEXT CHARACTER DEFAULT NULL",
    
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
            psLang.name                 = hikK.product_name"
            // DELAIS LIVRAISON
            // psLang.delivery_in_stock    = hikK.product_delais",

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
        "INSERT INTO ps_product_shop(id_product) SELECT product_id FROM knd1y_hikashop_product
        WHERE product_published = 1",

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
        "ALTER TABLE ps_layered_price_index ADD PRIMARY KEY (id_product,id_currency,id_shop,id_country)",
        


    /**
     * IMAGES     IMAGES    IMAGES
     * IMAGES     IMAGES    IMAGES
     * IMAGES     IMAGES    IMAGES
     */

         
         /**
         * VIDANGE TABLES IMAGES
         */
            "DROP PROCEDURE IF EXISTS CLEAR_TABLES_IMAGES",
            "CREATE PROCEDURE CLEAR_TABLES_IMAGES()
                BEGIN
                    TRUNCATE TABLE ps_image;
                    TRUNCATE TABLE ps_image_lang;
                    TRUNCATE TABLE ps_image_shop;
                END;",
            "CALL CLEAR_TABLES_IMAGES()",

        /**
        * TABLE ps_image
        */
        
        #1 - INSERT ps_image
            "INSERT INTO ps_image(id_image,id_product)
            SELECT file_id,file_ref_id FROM knd1y_hikashop_file AS new 
            WHERE file_type = 'product' 
            ON DUPLICATE KEY UPDATE id_product = new.file_ref_id",
        
            "DELETE FROM ps_image WHERE id_product = 0",
      
        #2 - CREATE TABLE ps_image_tmp -> Table temporaire pour traitement du cover (Version du serveur : 5.7.34)
            // code pour Mariadb
            //"SELECT id_image,id_product,RANK() OVER (PARTITION BY id_product ORDER BY id_image ASC) position FROM ps_image",
            "CREATE TABLE ps_image_tmp
                AS
                SELECT 
                    t.id_image,
                    t.id_product,
                    (
                        SELECT 1 + count(*)
                        FROM ps_image t1
                        WHERE 
                            t1.id_product = t.id_product 
                            AND t1.id_image < t.id_image

                    ) AS position,
                    NULL AS cover
                FROM ps_image t
                ORDER BY t.id_image, t.id_product",
        
                "ALTER TABLE ps_image_tmp CHANGE cover cover TINYINT(1) UNSIGNED NULL",
                
                "UPDATE ps_image_tmp
                        SET cover = 1
                        WHERE position = 1",
                
                "TRUNCATE TABLE ps_image",

        #3 - INSERT dans ps_image et suppression de la table temporaire
            "INSERT INTO ps_image SELECT * FROM ps_image_tmp",
            "DROP TABLE ps_image_tmp",


        /**
         * TABLE ps_image_lang
         */
            "ALTER TABLE ps_image_lang ADD COLUMN id_product_temp INT(10) NULL DEFAULT NULL",
            "ALTER TABLE ps_image_lang CHANGE id_lang id_lang INT(10) UNSIGNED NOT NULL DEFAULT '1'",
            "ALTER TABLE ps_image_lang CHANGE legend legend VARCHAR(255) NULL",
       
        #1 - INSERT ps_image_lang
            "INSERT INTO ps_image_lang(id_image) SELECT id_image FROM ps_image ORDER BY id_image ASC",
       
        #3 - UPDATE ps_image_lang
            "UPDATE ps_image_lang AS psImgL
                JOIN ps_image AS psImg USING (id_image)
                SET psImgL.id_product_temp = psImg.id_product",
                    
            "UPDATE ps_image_lang AS psImgL      
                JOIN ps_product_lang AS psProdL ON psImgL.id_product_temp = psProdL.id_product
                SET psImgL.legend = psProdL.name",

        #4 - ALTER ps_image_lang
            "ALTER TABLE ps_image_lang CHANGE id_lang id_lang INT(10) NOT NULL",
            "ALTER TABLE ps_image_lang CHANGE legend legend VARCHAR(255) NULL",
            "ALTER TABLE ps_image_lang DROP COLUMN id_product_temp",


        /**
         * TABLE ps_image_shop
         */
            "ALTER TABLE ps_image_shop CHANGE id_shop id_shop INT(11) UNSIGNED NOT NULL DEFAULT 1",
        
            #1 - INSERT ps_image_shop
            "INSERT INTO ps_image_shop(id_product,id_image,cover)
            SELECT id_product,id_image,cover FROM ps_image AS new
            ON DUPLICATE KEY UPDATE id_product = new.id_product",
        
            "UPDATE ps_image_shop AS psImgS SET psImgS.id_shop = 1",
            "ALTER TABLE ps_image_shop CHANGE id_shop id_shop INT(11) UNSIGNED NOT NULL"
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
