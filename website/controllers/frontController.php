<?php

function frontController()
{

    if (isset($_POST["name"], $_POST["title"], $_POST["email"], $_POST["amount"])){
        $name = $_POST["name"];
        $title = $_POST["title"];
        $email = $_POST["email"];
        $amount = $_POST["amount"];

        $to = "keijo.salakari@winnova.fi";
        $subject = "Ilmoittautuminen";
        
        $message = "<p>Matka: $title</p>";
        $message .= "<p>Nimi: $name</p>";
        $message .= "<p>Sähköposti: $email</p>";
        $message .= "<p>Matkustavien ihmisten määrä: $amount</p>";
        
        $header = "From:$email \r\n";
        $header .= "Cc:afgh@somedomain.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

         $retval = mail($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "<script>alert('Lähetetty!')</script>";
         } else {
            echo "<script>alert('Ei pystytty lähettämään!')</script>";
         }
    }

    require "./views/frontpage.php";

    $matkat = getLiikuntamatkat();

    foreach ($matkat as $m) {
        echo "<script>
        addMarker(
        '" . $m["lat"] . "',
        '" . $m["lng"] . "',
        './intra/saved/" . $m["kuva_uusinimi"] . "',
        '" . $m["otsikko"] . "',
        '" . $m["alkupvm"] . "',
        '" . $m["loppupvm"] . "',
        '" . $m["kuvausteksti"] . "',
        './intra/saved/" . $m["pdf_uusinimi"] . "',
        );
        </script>";
    }
}
