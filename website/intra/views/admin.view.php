<?php

// Adding a trip
echo "
<h1>Liikuntamatkojen lisäys</h1>
<form enctype='multipart/form-data' style='display: flex; flex-direction: column; width: 500px' method='post'>
<label>Sijainti</label>
<input step='any' type='number' name='lat' placeholder='Lat' required>
<input step='any' type='number' name='lng' placeholder='Lng' required>
<label>Muut</label>
<input type='text' name='title' placeholder='Otsikko' required>
<textarea name='desc' placeholder='Kuvausteksti'></textarea>
<input type='date' name='startdate' placeholder='aloituspäivämäärä' required>
<input type='date' name='enddate' placeholder='loppupäivämäärä' required>
<label>Liitteet</label>
<input type='file' enctype='multipart/form-data' name='img' accept='image/jpeg' placeholder='loppupäivämäärä' required>
<input type='file' enctype='multipart/form-data' name='pdf' accept='.pdf' placeholder='loppupäivämäärä' required>
<input type='submit' name='addliikunta' value='Lisää liikuntamatka'>
</form>
";

// Selectring a trip (for editing or deleting)
echo "
<h1>Liikuntamatkojen muokkaus ja poisto</h1>
<form method='post'>
<select name='selected'>
";

// Adds each trip as an option to select
foreach ($matkat as $matka) {

    echo "<option value='" . $matka["id"] . "'>" . $matka["otsikko"] . " (" . $matka["alkupvm"] . " - " . $matka["loppupvm"] . ")" . "</option>";
}

echo "
</select>
<input type='submit' name='delete' value='Poista'>
<input type='submit' name='readytoedit' value='Muokkaa'>
</form>
";

// If user wants to edit selected trip, shows an edit form
if (isset($_POST["readytoedit"], $_POST["selected"])) {
    $id = $_POST["selected"];
    $matka = null;
    foreach ($matkat as $m) {
        if ($m["id"] == $id) {
            $matka = $m;
            break;
        }
    }

    // Simple edit form
    echo "
    <h1>Liikuntamatkojen lisäys</h1>
    <form enctype='multipart/form-data' style='display: flex; flex-direction: column; width: 500px' method='post'>
    <label>Sijainti</label>
    <input step='any' value='" . $matka["lat"] . "' type='number' name='lat' placeholder='Lat' required>
    <input hidden=true value='" . $matka["id"] . "' type='number' name='id' placeholder='Lat' required>
    <input step='any' value='" . $matka["lng"] . "' type='number' name='lng' placeholder='Lng' required>
    <label>Muut</label>
    <input value='" . $matka["otsikko"] . "' type='text' name='title' placeholder='Otsikko' required>
    <textarea name='desc' placeholder='Kuvausteksti'>" . $matka["kuvausteksti"] . "</textarea>
    <input value='" . $matka["alkupvm"] . "' type='date' name='startdate' placeholder='aloituspäivämäärä' required>
    <input value='" . $matka["loppupvm"] . "' type='date' name='enddate' placeholder='loppupäivämäärä' required>
    <label>Liitteet</label>
    <input type='file' enctype='multipart/form-data' name='img' accept='image/jpeg' placeholder='loppupäivämäärä'>
    <input type='file' enctype='multipart/form-data' name='pdf' accept='.pdf' placeholder='loppupäivämäärä'>
    <input type='submit' name='edit' value='Muokkaa matkaa'>
    </form>
    ";
}
