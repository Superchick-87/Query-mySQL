<!DOCTYPE html>
<html>

<head>
    <title>MySQL</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.8/d3.min.js" type="text/JavaScript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.2.8/d3.min.js" type="text/JavaScript"></script>
    <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/5.9.1/d3.min.js"></script>
    <script src="js/1121_jquery-ui.js"></script>

</head>

<body >
    <h1>MySQL</h1>
    <button id="Go">Traitement</button>
    <div id="txtHint">
    </div>
</body>
<script language="javascript">
    function load() {
        window.location.reload();
    };
    function rtn() {
        //    window.history.go(-1);
        document.getElementById("txtHint").innerHTML = "";
        
    };
    
    /* Fonction Ajax */
    var boutonGo = document.getElementById("Go");
    boutonGo.addEventListener("click", showCustomer);

    function showCustomer(str) {
        var xhttp;
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
            boutonGo.innerHTML = "Traitement";
            boutonGo.addEventListener("click", load);
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
                boutonGo.innerHTML = "Retour";
                boutonGo.addEventListener("click", load);
                return;
            }
        };


        /* Methode GET -> passe une seule variable */
        /* Methode POST -> passe plusieurs variables */
        // xhttp.open("GET", "getuser.php?Ville="+MenuA,true);
        // xhttp.send();
        xhttp.open("GET", "getuser.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send();
    };
</script>

</html>