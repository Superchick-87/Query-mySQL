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
    * PRODUCTS  ACCESSORY   PRODUCTS  ACCESSORY
    * PRODUCTS  ACCESSORY   PRODUCTS  ACCESSORY
    * PRODUCTS  ACCESSORY   PRODUCTS  ACCESSORY
    */
     
    /**
    * VIDANGE TABLES PRODUCTS
    */
        "DROP PROCEDURE IF EXISTS CLEAR_TABLES_PRODUCT",
        "CREATE PROCEDURE CLEAR_TABLES_PRODUCT()
            BEGIN
                TRUNCATE TABLE ps_accessory;
            END;",
        "CALL CLEAR_TABLES_PRODUCT()",
        
        /**
         * TABLE ps_accessory
         */
        "INSERT INTO ps_accessory (id_product_1,id_product_2)
            SELECT product_id,product_related_id
            FROM knd1y_hikashop_product_related
            WHERE product_related_type = 'related'",
    ];

    $messages = [
       
    ];

    $i = 0;
    $n = 1;
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
