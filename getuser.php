<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.8/d3.min.js" type="text/JavaScript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.9.1/d3.min.js"></script>

<?php
$servname = 'localhost';
$dbname = 'trconseil2023';
$user = 'root';
$pass = 'root';

// $tableTarguet2 = 'test3';
// $tableTarguet = 'test2';
// $tableOrigin = 'test';
try {
    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $modif = [
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

        //     /**
        //     * TABLE ps_category
        //     */
        //     // #1 - INSERT temp colonne id
        //     "INSERT INTO ps_category (id_category) SELECT category_id FROM knd1y_hikashop_category",

        //     // #2 - UPDATE datas <- knd1y_hikashop_category
        //     "UPDATE ps_category AS ps
        //     -- JOIN knd1y_hikashop_category USING (id)
        //     -- JOIN Question USING (id)
        //     JOIN knd1y_hikashop_category AS hik
        //     ON ps.id_category = hik.category_id
        //     SET ps.id_parent        = hik.category_parent_id,
        //         ps.id_shop_default  = '1',
        //         ps.level_depth      = hik.category_depth,
        //         ps.nleft            = hik.category_left,
        //         ps.nright           = hik.category_right,
        //         ps.active           = hik.category_published,
        //         ps.date_add         = CURDATE(),
        //         ps.date_upd         = CURDATE(),
        //         ps.position         = hik.category_ordering,
        //         ps.is_root_category = '0'", 

        //     /**
        //     * TABLE ps_category_lang
        //     */
        //     // #1 - INSERT id_category
        //     "INSERT INTO ps_category_lang (id_category) SELECT category_id FROM knd1y_hikashop_category",

        //    // #2 - UPDATE datas <- knd1y_hikashop_category
        //    "UPDATE ps_category_lang AS ps
        //     -- JOIN knd1y_hikashop_category USING (id)
        //     -- JOIN Question USING (id)
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

        //     * FONCTION CAMELCASE
        //     */
        //     "DROP FUNCTION IF EXISTS proper_case",
        //     "CREATE FUNCTION `proper_case`(str varchar(128)) RETURNS varchar(128)
        //     BEGIN
        //     DECLARE n, pos INT DEFAULT 1;
        //     DECLARE sub, proper VARCHAR(128) DEFAULT '';

        //     if length(trim(str)) > 0 then
        //         WHILE pos > 0 DO
        //             set pos = locate(' ',trim(str),n);
        //             if pos = 0 then
        //                 set sub = lower(trim(substr(trim(str),n)));
        //             else
        //                 set sub = lower(trim(substr(trim(str),n,pos-n)));
        //             end if;

        //             set proper = concat_ws(' ', proper, concat(lower(left(sub,1)),substr(sub,2)));
        //             set n = pos + 1;
        //         END WHILE;
        //     end if;

        //     RETURN trim(proper);
        //     END",

        //     "UPDATE test2
        //     SET marque_2= proper_case(marque_2)"

        "UPDATE test2
    SET marque_2= LOWER(marque_1)",

        //     * FONCTION SUP CARACTERES SPECIAUX
        //     */
        "DROP FUNCTION IF EXISTS remove_accents",
        // "DELIMITER",
        "CREATE FUNCTION remove_accents(`str` TEXT)
        RETURNS text
        LANGUAGE SQL
        DETERMINISTIC
        NO SQL
        SQL SECURITY INVOKER
        COMMENT ''
     
    BEGIN
        SET str = REPLACE(str,'Š','S');
        SET str = REPLACE(str,'š','s');
        SET str = REPLACE(str,'Ð','Dj');
        SET str = REPLACE(str,'Ž','Z');
        SET str = REPLACE(str,'ž','z');
        SET str = REPLACE(str,'À','A');
        SET str = REPLACE(str,'Á','A');
        SET str = REPLACE(str,'Â','A');
        SET str = REPLACE(str,'Ã','A');
        SET str = REPLACE(str,'Ä','A');
        SET str = REPLACE(str,'Å','A');
        SET str = REPLACE(str,'Æ','A');
        SET str = REPLACE(str,'Ç','C');
        SET str = REPLACE(str,'È','E');
        SET str = REPLACE(str,'É','E');
        SET str = REPLACE(str,'Ê','E');
        SET str = REPLACE(str,'Ë','E');
        SET str = REPLACE(str,'Ì','I');
        SET str = REPLACE(str,'Í','I');
        SET str = REPLACE(str,'Î','I');
        SET str = REPLACE(str,'Ï','I');
        SET str = REPLACE(str,'Ñ','N');
        SET str = REPLACE(str,'Ò','O');
        SET str = REPLACE(str,'Ó','O');
        SET str = REPLACE(str,'Ô','O');
        SET str = REPLACE(str,'Õ','O');
        SET str = REPLACE(str,'Ö','O');
        SET str = REPLACE(str,'Ø','O');
        SET str = REPLACE(str,'Ù','U');
        SET str = REPLACE(str,'Ú','U');
        SET str = REPLACE(str,'Û','U');
        SET str = REPLACE(str,'Ü','U');
        SET str = REPLACE(str,'Ý','Y');
        SET str = REPLACE(str,'Þ','B');
        SET str = REPLACE(str,'ß','Ss');
        SET str = REPLACE(str,'à','a');
        SET str = REPLACE(str,'á','a');
        SET str = REPLACE(str,'â','a');
        SET str = REPLACE(str,'ã','a');
        SET str = REPLACE(str,'ä','a');
        SET str = REPLACE(str,'å','a');
        SET str = REPLACE(str,'æ','a');
        SET str = REPLACE(str,'ç','c');
        SET str = REPLACE(str,'è','e');
        SET str = REPLACE(str,'é','e');
        SET str = REPLACE(str,'ê','e');
        SET str = REPLACE(str,'ë','e');
        SET str = REPLACE(str,'ì','i');
        SET str = REPLACE(str,'í','i');
        SET str = REPLACE(str,'î','i');
        SET str = REPLACE(str,'ï','i');
        SET str = REPLACE(str,'ð','o');
        SET str = REPLACE(str,'ñ','n');
        SET str = REPLACE(str,'ò','o');
        SET str = REPLACE(str,'ó','o');
        SET str = REPLACE(str,'ô','o');
        SET str = REPLACE(str,'õ','o');
        SET str = REPLACE(str,'ö','o');
        SET str = REPLACE(str,'ø','o');
        SET str = REPLACE(str,'ù','u');
        SET str = REPLACE(str,'ú','u');
        SET str = REPLACE(str,'û','u');
        SET str = REPLACE(str,'ý','y');
        SET str = REPLACE(str,'ý','y');
        SET str = REPLACE(str,'þ','b');
        SET str = REPLACE(str,'ÿ','y');
        SET str = REPLACE(str,'ƒ','f');
        SET str = REPLACE(str,'\'','-');
        SET str = REPLACE(str,',','-');
        SET str = REPLACE(str,' ','-');
        SET str = REPLACE(str,'--','-');
     RETURN str;
    END",
        //DELIMITER ;",

        "UPDATE test2
    SET marque_2= remove_accents(marque_2)",

        //     /**
        //     * TABLE ps_category_product
        //     */
        //     // #1 - SUPRESSION la clé primaire sur la table
        //      "ALTER TABLE ps_category_product DROP PRIMARY KEY",

        //     // #2 - AJOUT colonne id + AI + PRIMARY
        //      "ALTER TABLE ps_category_product ADD id INT(255) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (id)",

        //     // #3 - CHANGE valeur par default cols id_product + id_category
        //     " ALTER TABLE ps_category_product CHANGE id_product id_product INT(10) UNSIGNED NULL DEFAULT NULL",
        //     " ALTER TABLE ps_category_product CHANGE id_category id_category  INT(10) UNSIGNED NULL DEFAULT NULL",

        //     // #4 - INSERT temp colonne id
        //     "INSERT INTO ps_category_product (id) SELECT product_category_id FROM knd1y_hikashop_product_category",

        //     // #5 - UPDATE datas <- knd1y_hikashop_product_category
        //     "UPDATE ps_category_product AS ps
        //     JOIN knd1y_hikashop_product_category AS hik ON ps.id = hik.product_category_id
        //     SET ps.id_category  = hik.category_id,
        //         ps.id_product   = hik.product_id,
        //         ps.	position    = hik.ordering",

        //     // #6 - SUPRESSION colonne id
        //     "ALTER TABLE ps_category_product DROP COLUMN id",

        //     // #7 - AJOUT la clé primaire sur id_category & id_product
        //     "ALTER TABLE ps_category_product ADD PRIMARY KEY (id_category,id_product)",

        /**
         * TABLE ps_category_group
         */
        // #1 - SUPRESSION la clé primaire sur la table
        "ALTER TABLE ps_category_group DROP PRIMARY KEY",
        "ALTER TABLE ps_category_group DROP INDEX id_category",
        "ALTER TABLE ps_category_group DROP INDEX id_group",

        // #2 - AJOUT colonne id + AI + PRIMARY
        "ALTER TABLE ps_category_group ADD id INT(255) NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (id)",

        // #3 - CHANGE valeur par default cols id_product + id_category
        " ALTER TABLE ps_category_group CHANGE id_category id_category INT(10) UNSIGNED NULL DEFAULT NULL",
        " ALTER TABLE ps_category_group CHANGE 	id_group id_group INT(10) UNSIGNED NULL DEFAULT NULL",

        // #4 - INSERT temp colonne id
        "INSERT INTO ps_category_group (id_category) SELECT id_category FROM ps_category",

        // #5 - UPDATE datas <- 3 pour la visibilité de tous les visiteurs
        "UPDATE ps_category_group SET id_group = '3'",

        // #6 - SUPRESSION colonne id
        "ALTER TABLE ps_category_group DROP COLUMN id",

        // #7 - AJOUT INDEX & PRIMARY la clé primaire sur id_category & id_product
        "ALTER TABLE ps_category_group ADD INDEX id_category (id_category) USING BTREE",
        "ALTER TABLE ps_category_group ADD INDEX id_group (id_group) USING BTREE",
        "ALTER TABLE ps_category_group ADD PRIMARY KEY (id_category,id_group)"
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
        echo '<p>&#10004; ' . $n++ . ') ' . $messages[$i++] . '</p>';
    };

    /**
     * Construction d'une table issue de tables multiples
     * 2 types de jointures :
     * #1 - JOIN
     * #2 - JOINTURE INTERNE
     */

    // #1 - UPDATE datas <- knd1y_hikashop_category
    //  "UPDATE ps_category AS ps
    //  -- JOIN knd1y_hikashop_category USING (id)
    //  -- JOIN Question USING (id)
    //  JOIN knd1y_hikashop_category AS hik
    //  ON ps.id_category = hik.category_id
    //  SET ps.id_parent        = hik.category_parent_id,
    //      ps.id_shop_default  = '1',
    //      ps.level_depth      = hik.category_depth,
    //      ps.nleft            = hik.category_left,
    //      ps.nright           = hik.category_right,
    //      ps.active           = hik.category_published,
    //      ps.date_add         = CURDATE(),
    //      ps.date_upd         = CURDATE(),
    //      ps.position         = hik.category_ordering,
    //      ps.is_root_category = '0'"

    #2 - JOIN
    // "UPDATE test AS t, test2 AS t2, test3 AS t3
    // SET t2.marque_2 = t.marque_2,
    // t3.marque_2 = t.marque_2,
    // t2.marque_1 = t.marque_1,
    // t3.marque_1 = t.marque_1
    // WHERE t.id_product = t3.id_product AND t.id_product = t2.id_product"

    /**
     * 1/ Traitement multiple requêtes
     * 2/ Remplacement de données col 1
     * 3/ Remplacement de données col 2
     * 4/ Création nouvelle col
     * 5/ Concat col 1 + col 2 dans nouvelle col
     */

    // $modif = [
    //     "CREATE TABLE test2 LIKE test",
    //     "INSERT INTO test2 SELECT * from test",
    //     "UPDATE test2 SET marque_1 = 'Honda' WHERE marque_1 !=''",
    //     "UPDATE test2 SET marque_2 = 'Kawa' WHERE marque_2 !=''",
    //     "ALTER TABLE test2 ADD marque VARCHAR(50)",
    //     "UPDATE test2 SET marque = CONCAT(marque_1,marque_2)",
    //     "ALTER TABLE test2 DROP COLUMN marque_1, DROP COLUMN marque_2"
    // ];
    // $messages = [
    //     "Table créée",
    //     "Insertion des données",
    //     "Modif marque Honda réussie",
    //     "Modif marque Kawa réussie",
    //     "Création de la colonne marque réussie",
    //     "Fusion réussie",
    //     "Suppression de marque_1 et marque_2"
    // ];
    // $i=0;
    // $n=1;
    // foreach ($modif as $query) {
    //     $stmt = $dbco->prepare($query);
    //     $stmt->execute();
    //     echo '<p>&#10004;' .$n++. ' '.$messages[$i++].'</p>';
    // }

    /**
     * Création d'une table suivant un modèle
     */

    // $dupTable = "CREATE TABLE test2 LIKE test";
    // $requete = $dbco->prepare($dupTable);
    // $requete->execute();
    // echo '<p>Table créée</p>';


    /**
     * Insertion des données de la table source
     * dans la nouvelle table
     */

    // $dupTable = "INSERT INTO test2 SELECT * from test";
    // $requete = $dbco->prepare($dupTable);
    // $requete->execute();
    // echo '<p>Insertion des données</p>';



    /**
     * Copier / Remplacer #1
     * partout où pas vide
     */

    // $modif = "UPDATE test2
    // SET marque_1 = 'Honda ' WHERE marque_1 !=''";
    // $requete = $dbco->prepare($modif);
    // $requete->execute();
    // echo '<p>Modif marque Honda réussie</p>';


    /**
     * Copier / Remplacer #2
     * partout où pas vide
     */

    // $modif2 = "UPDATE test2
    // SET marque_2 = 'Kawa' WHERE marque_2 !=''";
    // $requete2 = $dbco->prepare($modif2);
    // $requete2->execute();
    // echo '<p>Modif marque Kawa réussie</p>';


    /**
     * Ajout nouvelle colonne
     * et ses caractéristiques (type + nom)
     */

    // $ajoutColMarque = "ALTER TABLE test2
    // ADD marque VARCHAR(50)";
    // $requeteAjoutColM = $dbco->prepare($ajoutColMarque);
    // $requeteAjoutColM->execute();
    // echo '<p>Ajout de la colonne marque réussi</p>';


    /**
     * Concaténation et insertion 
     * dans colonne créé
     * Attention les colonnes doivent être du même type
     */

    // $join_col = "UPDATE test2 SET marque = CONCAT(marque_1,',',marque_2)";
    // $requeteJoinColM = $dbco->prepare($join_col);
    // $requeteJoinColM->execute();
    // echo '<p>Fusion réussie</p>';


    // $suppColMarque = "ALTER TABLE test2
    // DROP COLUMN marque";
    // $requeteSuppColM = $dbco->prepare($suppColMarque);
    // $requeteSuppColM->execute();
    // echo '<p>Suppression de la colonne marque réussi</p>';


} catch (PDOException $e) {
    echo '<div class="erreur">&#10006;</br>Erreur de connexion
    </br>' . $e->getMessage() . '</div>';
}
