<?php
/**
 * Adds a trip
 */
function addLiikuntamatka($lat, $lng, $title, $desc, $startdate, $enddate, $img, $old_img_name, $new_img_name, $pdf, $old_pdf_name, $new_pdf_name)
{
    $pdo = getConnection();

    $sql = "INSERT INTO liikuntamatka (lat,lng,otsikko,kuvausteksti,alkupvm,loppupvm,kuva,pdf,pdf_uusinimi,pdf_vanhanimi,kuva_uusinimi,kuva_vanhanimi) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$lat, $lng, $title, $desc, $startdate, $enddate, $img, $pdf, $new_pdf_name, $old_pdf_name, $new_img_name, $old_img_name]);
}

/**
 * Returns all trips
 */
function getLiikuntamatkat()
{
    $pdo = getConnection();

    $sql = "SELECT id,lat,lng,otsikko,kuvausteksti,alkupvm,loppupvm,pdf_uusinimi,pdf_vanhanimi,kuva_uusinimi,kuva_vanhanimi FROM liikuntamatka";
    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
}

/**
 * Deletes a trip with certain id
 */
function deleteLiikuntamatka($id)
{
    $pdo = getConnection();

    $sql = "DELETE FROM liikuntamatka WHERE id=?; ";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id]);
}

/**
 * Updates a trip
 * PDF file and names are optional
 * Image file and names are optional
 */
function updateLiikuntamatka($id, $lat, $lng, $title, $desc, $startdate, $enddate, $img, $old_img_name, $new_img_name, $pdf, $old_pdf_name, $new_pdf_name)
{
    $pdo = getConnection();

    $sql = "UPDATE liikuntamatka SET lat=?,lng=?,otsikko=?,kuvausteksti=?,alkupvm=?,loppupvm=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$lat, $lng, $title, $desc, $startdate, $enddate, $id]);

    // PDF
    if ($pdf != null) {
        $sql = "UPDATE liikuntamatka SET pdf=?,pdf_uusinimi=?,pdf_vanhanimi=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$pdf, $new_pdf_name, $old_pdf_name, $id]);
    }
    // Image
    if ($img != null) {
        $sql = "UPDATE liikuntamatka SET kuva=?,kuva_uusinimi=?,kuva_vanhanimi=? WHERE id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$img, $new_img_name, $old_img_name, $id]);
    }
}
