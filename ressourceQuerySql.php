<?php
    /**
     * APPEL FONCTIONS :
     * -> proper_case
     * -> remove_accents
     */
        // "UPDATE test2
        // SET marque_2= LOWER(marque_1)",
        // "DROP FUNCTION IF EXISTS proper_case",
        // $proper_case,
        // "DROP FUNCTION IF EXISTS remove_accents",
        // $remove_accents,

        // "UPDATE test2
        // SET marque_2 = proper_case(remove_accents(marque_1))",

        // "UPDATE geoAssoc
        // SET CodePostal = CONCAT('0',CodePostal)
        // WHERE LENGTH(CodePostal) < 5"

        // "UPDATE geoAssoc
        // SET Dep = SUBSTR(CodePostal, 1, 2)"

        // "UPDATE geoAssoc
        // SET Dep_Nom = 'Creuse'
        // WHERE Dep = '23'"

        // "UPDATE test2
        // SET marque_2= remove_accents(marque_2)"

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
?>