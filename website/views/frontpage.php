<!DOCTYPE html>
<html lang="fi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verkkosivu</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css" integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ==" crossorigin="" />

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js" integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ==" crossorigin=""></script>

    <!--script src="./js/leaflet.js"></script-->

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/nav.css">
    <link rel="stylesheet" href="./css/herobanner.css">
    <link rel="stylesheet" href="./css/service.css">
    <link rel="stylesheet" href="./css/popup.css">
    <link rel="stylesheet" href="./css/contact.css">
    <link rel="stylesheet" href="./css/references.css">
    <link rel="stylesheet" href="./css/map.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sanchez&display=swap" rel="stylesheet">
</head>

<body>
    <div id="popupDiv" class="PopupDiv Hidden">
        <form class="PopupForm" method="post">
            <p class="Close" onclick="togglePopup('',false)">Sulje</p>
            <h2>Ilmoittautuminen</h2>
            <input type="text" name="name" placeholder="Etu- ja sukunimi" required>
            <input readonly id="titleandname" type="text" name="title" required>
            <input type="email" name="email" placeholder="Sähköposti" required>
            <input min="1" type="number" name="amount" placeholder="Matkustavien ihmisten määrä" required>
            <input class="Button" type="submit" value="Lähetä">
        </form>
    </div>
    <script src="./js/popupForm.js"></script>
    <header>
        <nav>
            <img alt="Logo" class="Logo" src="./images/HeroBanner/AnneSetalaLogo.jpg">
        </nav>
    </header>
    <main>
        <div class="Herobanner">
            <img class="Banner" alt="Banner" src="./images/HeroBanner/HeroBannerKuvia/KuvaNorja3_Pixabay.jpg">
            <div class="Content">
                <h1 class="Header">Liikuntamatkat</h1>
                <p class="Text">Hyvinvointia ja elämyksiä Euroopan kohteissa.
                    Olen järjestänyt patikointi- ja hyvinvointimatkoja jo 10 vuoden ajan vuosittain eri Euroopan
                    kohteisiin mm. Italiaan, Itävaltaan, Skotlantiin, Kroatiaan, Irlantiin ja Sloveniaan.
                    Matkat ovat kokonaisvaltaista hyvinvointia tukevia. Upeat nähtävyydet koetaan patikoiden ja
                    paikallinen gastronomia tulee myös tutuksi.
                    Tutustu kohteisiin kartasta ja lue asiakkaitteni kokemuksia liikuntamatkoista!
                </p>
                <a class="Button" href="#mapsection">Karttaan</a>
            </div>
        </div>
    </main>
    <section class="Service">
        <div class="Images">
            <img class="Img2" alt="Kuva" src="./images/Palvelusta/PalvelustaKuvia/AnneSetala_Kuva4.JPG">
            <img class="Img1" alt="Kuva" src="./images/Palvelusta/PalvelustaKuvia/AnneSetala_kuva1.jpeg">
        </div>
        <div class="Content">
            <h2 class="Center">Anne Setälä</h2>
            <p class="Center">Fysioterapeutin tutkinto 1986</p>
            <p class="Center">Yrittäjänä vuodesta 1998</p>
            <p class="Center">FISAF-Personal Trainer 2006</p>
            <p class="Empty"></p>
            <p>Olen järjestänyt liikunta ja hyvinvointimatkoja jo vuodesta 2012. Pitkäaikainen kumppanini on
                matkatoimisto Kontiki.
                Kon-Tiki Tours tarjoaa hyvinvointimatkoja yhteistyössä alan huippuammattilaisten kanssa.
                Hyvinvointimatkojeni ohjelma koostuu esimerkiksi vesijumpasta, joogasta, mindfulnessista, retriitistä,
                vaelluksesta ja patikoinnista hyvää ruokaa ja viihtyisää majoitusta unohtamatta.
                Jokainen hyvinvointimatka on tarkkaan suunniteltu, sinun ei tarvitse kuin hypätä kyytiin! Lue myös
                tyytyväisten asiakkaitteni kommentit ja kokemukset matkoista referenssit - osiosta.
            </p>
            <p class="Empty"></p>
            <p>Ota yhteyttä ja jutellaan lisää seuraavasta matkastamme!</p>
            <p>Anne</p>
        </div>
    </section>
    <section class="References">
        <div class="Header">
            <h2>Kokemuksia Anne Setälän liikuntamatkoista</h2>
            <p>Olemme koonneet tähän tyytyväisten asiakkaidemme kokemuksia liikuntamatkoistamme Klikkaa referenssin kohdalta, niin pääset asiakaskertomukseen! </p>
        </div>
        <div class="Content" id="animatedref">
            <div id="asub" class="sub">
                <div class="Ref">
                    <h3 class="Header">Taloushallinnon ammattilainen Anja Kirjuri, 45-vuotta.</h3>
                    <img alt="Kuva" src="./images/Referenssit/Referenssi1_AnjaKirjuri.jpg">
                    <p class="Text">Parasta Annen liikuntamatkoissa on ehdottomasti työhyvinvoinnin kasvu. Liikuntamatkat tuovat erinomaisen tasapainon toimisto ja näyttöpäätteellä tehtävään työhön. Näyttöpäätetyöskentelyssä minulle tulee helposti erilaisia hartia tai niskavaivoja. Annen matkoihin on helppo heittäytyä mukaan ja elimistö voi hyvin liikuntamatkan jälkeen. Työhön tulee uutta puhtia, kun ihminen voi hyvin! </p>
                    <p class="Text">(Kuva lähde: https://pixabay.com/fi/photos/yhti%c3%b6-liiketoimintaa-ty%c3%b6ntekij%c3%a4-1067978/)</p>
                    <p class="Text">Liikuntamatka: Itävalta 19.–26.5.2018</p>
                </div>
                <div class="Ref">
                    <h3 class="Header">Ohjelmoija Kalle Koodari, 38-vuotta.</h3>
                    <img alt="Kuva" src="./images/Referenssit/Referenssi2_KalleKoodari.jpg">
                    <p class="Text">Löysin Annen liikuntamatkat tyttöystäväni kanssa. Matkoissa parasta on helppous ja hyvin toimiva kokonaisuus. Olemme käyttäneet Annen fysioterapiapalveluita aikaisemmin, liikuntamatkoilla kaikki on järjestetty ja stressi helpottuu!</p>
                    <p class="Text">(Kuva lähde: https://pixabay.com/fi/photos/kannettava-tietokone-koodi-2557468/)</p>
                    <p class="Text">Liikuntamatka: Slovenia 2.–9.10.2019</p>
                </div>
                <div class="Ref">
                    <h3 class="Header">Lääkäri Lenni Lekuri, 58-vuotta.</h3>
                    <img alt="Kuva" src="./images/Referenssit/Referenssi3_LenniLekuri.jpg">
                    <p class="Text">Lääkärinä tiedän, että ihmisen terveyteen tarvitaan kokonaisvaltaista hyvinvointia. Suosittelen Anne Setälän liikuntamatkoja kaikille, jotka haluavat lisätä hyvinvointiaan!</p>
                    <p class="Text">(Kuva lähde: https://pixabay.com/fi/photos/kannettava-tietokone-koodi-2557468/)</p>
                    <p class="Text">Liikuntamatka: Itävalta 19.–26.5.2018 ja Slovenia 2.–9.10.2019</p>
                </div>
                <div class="Ref">
                    <h3 class="Header">Puutarhuri Kalle Kukkanen, 45-vuotta.</h3>
                    <img alt="Kuva" src="./images/Referenssit/Refrenssi4_KalleKukkanen.jpg">
                    <p class="Text">Annen liikuntamatkojen kohteet ovat aina hyvin valittuja ja kohteissa saa hyviä ideoita myös omaan työhön. Puutarhurina teen työtä käsilläni ja fysiikka on aina kovilla. Työni ajoittuvat puutarhan aina kevät, kesä ja syystoimiin. Liikuntamatkoista onkin tullut minulle jo tapa päättää kesän sesonkikausi oman hyvinvoinnin äärelle. </p>
                    <p class="Text">(Kuva lähde: https://pixabay.com/fi/photos/kannettava-tietokone-koodi-2557468/)</p>
                    <p class="Text">Liikuntamatka: Itävalta 19.–26.5.2018</p>
                </div>
                <div class="Ref">
                    <h3 class="Header">Taksiyrittäjä Timo Taksi, 50-vuotta.</h3>
                    <img alt="Kuva" src="./images/Referenssit/Referenssi5_TimoTaksi.jpg">
                    <p class="Text">Ostin itselleni ensimmäisen liikuntamatkan 50vuotislahjaksi. Taksiyrittäjänä teen pitkää päivää ja auton ratissa istuminen vaatii tasapainoksi liikuntaa ja hyvinvointia. Hyvinvointimatkan jälkeen huomasin olevani paljon virkeämpi ja työhyvinvointi lisääntyi selvästi. Lähden varmasti Annen matkaan uudestaan!</p>
                    <p class="Text">(Kuva lähde: https://pixabay.com/fi/photos/kes%c3%a4-puutarha-kukat-puutarhuri-3623282/)</p>
                    <p class="Text">Liikuntamatka: Itävalta 19.–26.5.2018</p>
                </div>
                <div class="Ref">
                    <h3 class="Header">Taloushallinnon ammattilainen Anja Kirjuri, 45-vuotta.</h3>
                    <img alt="Kuva" src="./images/Referenssit/Referenssi1_AnjaKirjuri.jpg">
                    <p class="Text">Parasta Annen liikuntamatkoissa on ehdottomasti työhyvinvoinnin kasvu. Liikuntamatkat tuovat erinomaisen tasapainon toimisto ja näyttöpäätteellä tehtävään työhön. Näyttöpäätetyöskentelyssä minulle tulee helposti erilaisia hartia tai niskavaivoja. Annen matkoihin on helppo heittäytyä mukaan ja elimistö voi hyvin liikuntamatkan jälkeen. Työhön tulee uutta puhtia, kun ihminen voi hyvin! </p>
                    <p class="Text">(Kuva lähde: https://pixabay.com/fi/photos/yhti%c3%b6-liiketoimintaa-ty%c3%b6ntekij%c3%a4-1067978/)</p>
                    <p class="Text">Liikuntamatka: Itävalta 19.–26.5.2018</p>
                </div>
                <div class="Ref">
                    <h3 class="Header">Ohjelmoija Kalle Koodari, 38-vuotta.</h3>
                    <img alt="Kuva" src="./images/Referenssit/Referenssi2_KalleKoodari.jpg">
                    <p class="Text">Löysin Annen liikuntamatkat tyttöystäväni kanssa. Matkoissa parasta on helppous ja hyvin toimiva kokonaisuus. Olemme käyttäneet Annen fysioterapiapalveluita aikaisemmin, liikuntamatkoilla kaikki on järjestetty ja stressi helpottuu!</p>
                    <p class="Text">(Kuva lähde: https://pixabay.com/fi/photos/kannettava-tietokone-koodi-2557468/)</p>
                    <p class="Text">Liikuntamatka: Slovenia 2.–9.10.2019</p>
                </div>
                <div class="Ref">
                    <h3 class="Header">Lääkäri Lenni Lekuri, 58-vuotta.</h3>
                    <img alt="Kuva" src="./images/Referenssit/Referenssi3_LenniLekuri.jpg">
                    <p class="Text">Lääkärinä tiedän, että ihmisen terveyteen tarvitaan kokonaisvaltaista hyvinvointia. Suosittelen Anne Setälän liikuntamatkoja kaikille, jotka haluavat lisätä hyvinvointiaan!</p>
                    <p class="Text">(Kuva lähde: https://pixabay.com/fi/photos/kannettava-tietokone-koodi-2557468/)</p>
                    <p class="Text">Liikuntamatka: Itävalta 19.–26.5.2018 ja Slovenia 2.–9.10.2019</p>
                </div>
                <div class="Ref">
                    <h3 class="Header">Puutarhuri Kalle Kukkanen, 45-vuotta.</h3>
                    <img alt="Kuva" src="./images/Referenssit/Refrenssi4_KalleKukkanen.jpg">
                    <p class="Text">Annen liikuntamatkojen kohteet ovat aina hyvin valittuja ja kohteissa saa hyviä ideoita myös omaan työhön. Puutarhurina teen työtä käsilläni ja fysiikka on aina kovilla. Työni ajoittuvat puutarhan aina kevät, kesä ja syystoimiin. Liikuntamatkoista onkin tullut minulle jo tapa päättää kesän sesonkikausi oman hyvinvoinnin äärelle. </p>
                    <p class="Text">(Kuva lähde: https://pixabay.com/fi/photos/kannettava-tietokone-koodi-2557468/)</p>
                    <p class="Text">Liikuntamatka: Itävalta 19.–26.5.2018</p>
                </div>
                <div class="Ref">
                    <h3 class="Header">Taksiyrittäjä Timo Taksi, 50-vuotta.</h3>
                    <img alt="Kuva" src="./images/Referenssit/Referenssi5_TimoTaksi.jpg">
                    <p class="Text">Ostin itselleni ensimmäisen liikuntamatkan 50vuotislahjaksi. Taksiyrittäjänä teen pitkää päivää ja auton ratissa istuminen vaatii tasapainoksi liikuntaa ja hyvinvointia. Hyvinvointimatkan jälkeen huomasin olevani paljon virkeämpi ja työhyvinvointi lisääntyi selvästi. Lähden varmasti Annen matkaan uudestaan!</p>
                    <p class="Text">(Kuva lähde: https://pixabay.com/fi/photos/kes%c3%a4-puutarha-kukat-puutarhuri-3623282/)</p>
                    <p class="Text">Liikuntamatka: Itävalta 19.–26.5.2018</p>
                </div>
            </div>
        </div>
    </section>
    <script src="./js/animatedRef.js"></script>
    <section id="mapsection" class="Map">
        <h2 class="Header">Kartta</h2>
        <div id="map"></div>
    </section>
    <section class="Contact">
        <form class="ContactForm">
            <h2>Haluan lisätietoa</h2>
            <input type="text" placeholder="Nimi">
            <input type="text" placeholder="Sähköposti">
            <input type="text" placeholder="Puhelin">
            <textarea placeholder="Teksti"></textarea>
            <input class="Button" type="submit" value="Lähetä">
        </form>
    </section>
    <script src="./js/map.js"></script>
</body>

</html>