<?php

function getLiikuntamatka()
{
    $pdo = getConnection();
}

function addLiikuntamatka($lat, $lng, $title, $desc, $startdate, $enddate, $img, $old_img_name, $new_img_name, $pdf, $old_pdf_name, $new_pdf_name)
{
    $pdo = getConnection();

    //lat 	lng 	otsikko 	kuvausteksti 	alkupvm 	loppupvm 	kuva 	pdf 	pdf_uusinimi 	pdf_vanhanimi 	kuva_uusinimi 	kuva_vanhanimi

    $sql = "INSERT INTO liikuntamatka (lat,lng,otsikko,kuvausteksti,alkupvm,loppupvm,kuva,pdf,pdf_uusinimi,pdf_vanhanimi,kuva_uusinimi,kuva_vanhanimi) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$lat, $lng, $title, $desc, $startdate, $enddate, $img, $pdf, $new_pdf_name, $old_pdf_name, $new_img_name, $old_img_name]);
}

function getLiikuntamatkat()
{
    $pdo = getConnection();

    $sql = "SELECT id,lat,lng,otsikko,kuvausteksti,alkupvm,loppupvm,pdf_uusinimi,pdf_vanhanimi,kuva_uusinimi,kuva_vanhanimi FROM liikuntamatka";
    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll();
    return $data;
}

function deleteLiikuntamatka($id){
    $pdo = getConnection();

    $sql = "DELETE FROM liikuntamatka WHERE id=?; ";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute([$id]);
}

function updateLiikuntamatka($id,$lat, $lng, $title, $desc, $startdate, $enddate, $img, $old_img_name, $new_img_name, $pdf, $old_pdf_name, $new_pdf_name){
    $pdo = getConnection();
    
    /*
     UPDATE table_name
SET column1 = value1, column2 = value2, ...
WHERE condition; 
    */
    // pdf_uusinimi,pdf_vanhanimi,kuva_uusinimi,kuva_vanhanimi
    $sql = "UPDATE liikuntamatka SET lat=?,lng=?,otsikko=?,kuvausteksti=?,alkupvm=?,loppupvm=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$lat, $lng, $title, $desc, $startdate, $enddate, $id]);

    // PDF
    $sql = "UPDATE liikuntamatka SET pdf=?,pdf_uusinimi=?,pdf_vanhanimi=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pdf,$new_pdf_name,$old_pdf_name,$id]);

    // Image
    $sql = "UPDATE liikuntamatka SET pdf=?,pdf_uusinimi=?,pdf_vanhanimi=? WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$pdf,$new_pdf_name,$old_pdf_name,$id]);
}