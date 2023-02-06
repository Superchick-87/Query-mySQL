<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.8/d3.min.js" type="text/JavaScript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.9.1/d3.min.js"></script>

<?php
$servname = 'localhost';
$dbname = 'Consultations';
$user = 'root';
$pass = 'root';

$tableTarguet2 = 'test3';
$tableTarguet = 'test2';
$tableOrigin = 'test';
try {
    $dbco = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
    $dbco->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
    /**
     * Construction d'une table issue de tables multiples
     * 2 types de jointures :
     * #1 - JOIN
     * #2 - JOINTURE INTERNE
     */
    
     $modif = [ 
        // "INSERT INTO ps_category (id_product) SELECT product_id FROM knd1y_hikashop_category",
        // "CREATE TABLE test2 LIKE test"

        // "INSERT INTO $tableTarguet2(id) SELECT id FROM $tableOrigin"
        "INSERT INTO test3(id) SELECT id from test"
       
        #1 - JOIN
        // "UPDATE test
        // JOIN test2 USING (id_product)
        // JOIN test3 ON test.id_product = test3.id_product
        // SET test3.marque = test.marque_,
        //     test2.marque_1 = test.marque_1,
        //     test2.marque_2 = test.marque_2,
        //     test2.marque = test3.marque"

        #2 - JOINTURE INTERNE 
        // "UPDATE test AS t, test2 AS t2, test3 AS t3
        // SET t2.marque_2 = t.marque_2,
        // t3.marque_2 = t.marque_2,
        // t2.marque_1 = t.marque_1,
        // t3.marque_1 = t.marque_1
        // WHERE t.id_product = t3.id_product AND t.id_product = t2.id_product"

    
    ];
    $messages = [
        // "<b>marque</b> dans table <b>".$tableTarguet."</b>",
        "<b> </b> dans table <b>".$tableTarguet."</b>",
        "<b> </b> dans table <b>".$tableTarguet2."</b>"
    ];
           
    $i=0;
    $n=1;
    foreach ($modif as $query) {
        $sth = $dbco->prepare($query);
        $sth->execute();
        $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
        echo '<p>&#10004; ' .$n++. 'Copie réussie colonne '.$messages[$i++].'</p>';
        };

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
    </br>'. $e->getMessage().'</div>';
}