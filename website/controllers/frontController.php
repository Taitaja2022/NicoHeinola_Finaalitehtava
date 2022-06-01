<?php

function frontController()
{
    // If user has sent a sign-up form for a trip, sends an email
    if (isset($_POST["name"], $_POST["title"], $_POST["email"], $_POST["amount"])) {
        $name = $_POST["name"]; // Name of user
        $title = $_POST["title"]; // Title of trip
        $email = $_POST["email"]; // Email of user
        $amount = $_POST["amount"];  // Amount of people wanting to join

        $to = "keijo.salakari@winnova.fi"; // Who the email is sent to
        $subject = "Ilmoittautuminen"; // Title of the email

        // Builds a message
        $message = "<p>Matka: $title</p>";
        $message .= "<p>Nimi: $name</p>";
        $message .= "<p>Sähköposti: $email</p>";
        $message .= "<p>Matkustavien ihmisten määrä: $amount</p>";

        // Builds a header
        $header = "From:$email \r\n";
        $header .= "Cc:afgh@somedomain.com \r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type: text/html\r\n";

        $retval = mail($to, $subject, $message, $header); // Sends the email

        // Checks if email was sent successfully
        if ($retval == true) {
            echo "<script>alert('Lähetetty!')</script>";
        } else {
            echo "<script>alert('Ei pystytty lähettämään!')</script>";
        }
    }

    require "./views/frontpage.php";

    $matkat = getLiikuntamatkat();

    // Adds each trip to a map on frontpage
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
