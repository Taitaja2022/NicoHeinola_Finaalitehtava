<?php

function adminController()
{
    if (isLogged()) {
        require "./models/liikuntamatka.php";

        $path = "./saved/";
        $img_limit = 512000; # 500 kb in bytes
        $pdf_limit = 10485760; # 10 mb in bytes

        if (isset($_POST["addliikunta"], $_POST["lat"], $_POST["lng"], $_POST["title"], $_POST["desc"], $_POST["startdate"], $_POST["enddate"], $_FILES["img"], $_FILES["pdf"])) {
            $lat = $_POST["lat"];
            $lng = $_POST["lng"];
            $title = sanitizeString($_POST["title"]);
            $desc = sanitizeString($_POST["desc"]);
            $startdate = $_POST["startdate"];
            $enddate = $_POST["enddate"];
            $img = $_FILES["img"];
            $old_img_name = $img["name"];
            $pdf = $_FILES["pdf"];
            $old_pdf_name = $img["name"];

            $new_img_name = date("Y_m_d") . $title . ".jpg";
            $new_pdf_name = date("Y_m_d") . $title . ".pdf";
            $new_img_name = sanitizeName($new_img_name);
            $new_pdf_name = sanitizeName($new_pdf_name);

            $imgContent = addslashes(file_get_contents($img["tmp_name"]));
            $pdfContent = addslashes(file_get_contents($pdf["tmp_name"]));

            if ($img["size"] <= $img_limit && $pdf["size"] <= $pdf_limit) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimetypeimg = finfo_file($finfo, $_FILES['img']['tmp_name']);
                $mimetypepdf = finfo_file($finfo, $_FILES['pdf']['tmp_name']);
                if (($mimetypeimg == 'image/jpeg' || $mimetypeimg == 'image/jpg') && $mimetypepdf == "application/pdf") {
                    // Works
                    // PDF
                    if (is_uploaded_file($pdf["tmp_name"])) {
                        if (move_uploaded_file($pdf["tmp_name"], $path . $new_pdf_name)) {
                        } else {
                            echo "Failed to move your image.";
                        }
                    } else {
                        echo "Failed to upload your image.";
                    }
                    // Image
                    if (is_uploaded_file($img["tmp_name"])) {
                        if (move_uploaded_file($img["tmp_name"], $path . $new_img_name)) {
                        } else {
                            echo "Failed to move your image.";
                        }
                    } else {
                        echo "Failed to upload your image.";
                    }
                    addLiikuntamatka($lat, $lng, $title, $desc, $startdate, $enddate, $imgContent, $old_img_name, $new_img_name, $pdfContent, $old_pdf_name, $new_pdf_name);
                }
            } else {
                echo "<script>alert('Too large files')</script>";
            }
        }

        $matkat = getLiikuntamatkat();


        if (isset($_POST["delete"], $_POST["selected"])) {
            $id = $_POST["selected"];

            // Kovalevy
            $matka = null;
            foreach ($matkat as $m) {
                if ($m["id"] == $id) {
                    $matka = $m;
                    break;
                }
            }

            if ($matka != null) {

                $duplicateImage = false;
                $duplicatePDF = false;

                foreach ($matkat as $m) {
                    if ($m["id"] !== $matka["id"]) {
                        if ($m["pdf_uusinimi"] == $matka["pdf_uusinimi"]) {
                            $duplicatePDF = true;
                        }
                        if ($m["kuva_uusinimi"] == $matka["kuva_uusinimi"]) {
                            $duplicateImage = true;
                        }
                        if ($duplicateImage && $duplicatePDF) {
                            break;
                        }
                    }
                }

                if (!$duplicatePDF) {
                    try {
                        if (file_exists($path . $matka["pdf_uusinimi"])) {
                            unlink($path . $matka["pdf_uusinimi"]);
                        }
                    } catch (Exception $e) {
                    }
                }
                if (!$duplicateImage) {
                    try {
                        if (file_exists($path . $matka["kuva_uusinimi"])) {
                            unlink($path . $matka["kuva_uusinimi"]);
                        }
                    } catch (Exception $e) {
                    }
                }
            }
            // Tietokanta
            deleteLiikuntamatka($id);
        }

        if (isset($_POST["edit"], $_POST["lat"], $_POST["id"], $_POST["lng"], $_POST["title"], $_POST["desc"], $_POST["startdate"], $_POST["enddate"])) {
            $lat = $_POST["lat"];
            $lng = $_POST["lng"];
            $title = sanitizeString($_POST["title"]);
            $desc = sanitizeString($_POST["desc"]);
            $startdate = $_POST["startdate"];
            $enddate = $_POST["enddate"];
            $id = $_POST["id"];

            if (isset($_FILES["img"]) && !empty($_FILES["img"]["tmp_name"])) {
                $img = $_FILES["img"];
                $old_img_name = $img["name"];
                $new_img_name = date("Y_m_d") . $title . ".jpg";
                $new_img_name = sanitizeName($new_img_name);
                $imgContent = addslashes(file_get_contents($img["tmp_name"]));
            } else {
                $img = null;
                $old_img_name = null;
                $new_img_name = null;
                $imgContent = null;
            }
            if (isset($_FILES["pdf"]) && !empty($_FILES["pdf"]["tmp_name"])) {
                $pdf = $_FILES["pdf"];
                $old_pdf_name = $pdf["name"];
                $new_pdf_name = date("Y_m_d") . $title . ".pdf";
                $new_pdf_name = sanitizeName($new_pdf_name);
                $pdfContent = addslashes(file_get_contents($pdf["tmp_name"]));
            } else {
                $pdf = null;
                $old_pdf_name = null;
                $new_pdf_name = null;;
                $pdfContent = null;
            }

            // Poistaa vanhat tiedostot ja laittaa uudet
            if ($pdf != null && $pdf["size"] <= $pdf_limit) {
                $id = $_POST["id"];

                // Kovalevy
                $matka = null;
                foreach ($matkat as $m) {
                    if ($m["id"] == $id) {
                        $matka = $m;
                        break;
                    }
                }
                if ($matka != null) {
                    try {
                        if (file_exists($path . $matka["pdf_uusinimi"])) {
                            unlink($path . $matka["pdf_uusinimi"]);
                        }
                    } catch (Exception $e) {
                    }
                }

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimetypepdf = finfo_file($finfo, $_FILES['pdf']['tmp_name']);
                if ($mimetypepdf == "application/pdf") {
                    // PDF
                    if (is_uploaded_file($pdf["tmp_name"])) {
                        if (move_uploaded_file($pdf["tmp_name"], $path . $new_pdf_name)) {
                        } else {
                            echo "Failed to move your image.";
                        }
                    } else {
                        echo "Failed to upload your image.";
                    }
                }
            }
            if ($img != null && $img["size"] <= $img_limit) {
                $id = $_POST["id"];

                // Kovalevy
                $matka = null;
                foreach ($matkat as $m) {
                    if ($m["id"] == $id) {
                        $matka = $m;
                        break;
                    }
                }
                if ($matka != null) {
                    try {
                        if (file_exists($path . $matka["kuva_uusinimi"])) {
                            unlink($path . $matka["kuva_uusinimi"]);
                        }
                    } catch (Exception $e) {
                    }
                }

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimetypeimg = finfo_file($finfo, $_FILES['img']['tmp_name']);
                if (($mimetypeimg == 'image/jpeg' || $mimetypeimg == 'image/jpg')) {
                    // Image
                    if (is_uploaded_file($img["tmp_name"])) {
                        if (move_uploaded_file($img["tmp_name"], $path . $new_img_name)) {
                        } else {
                            echo "Failed to move your image.";
                        }
                    } else {
                        echo "Failed to upload your image.";
                    }
                }
            }

            updateLiikuntamatka($id, $lat, $lng, $title, $desc, $startdate, $enddate, $imgContent, $old_img_name, $new_img_name, $pdfContent, $old_pdf_name, $new_pdf_name);
        }

        $matkat = getLiikuntamatkat();

        require "./views/admin.view.php";
    } else {
        header("location: ?page=login");
    }
}
