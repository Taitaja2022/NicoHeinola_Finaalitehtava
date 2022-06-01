<?php

function adminController()
{
    // Makes sure that user is logged in
    if (isLogged()) {
        require "./models/liikuntamatka.php"; // Handles all sql commands

        $path = "./saved/"; // Path to a folder where pdfs and images are stored for markers
        $img_limit = 512000; # 500 kb in bytes
        $pdf_limit = 10485760; # 10 mb in bytes

        // Checks if user wants to add a trip
        if (isset($_POST["addliikunta"], $_POST["lat"], $_POST["lng"], $_POST["title"], $_POST["desc"], $_POST["startdate"], $_POST["enddate"], $_FILES["img"], $_FILES["pdf"])) {
            $lat = $_POST["lat"]; // Latitude
            $lng = $_POST["lng"]; // Longitude
            $title = sanitizeString($_POST["title"]); // Title of the trip (Sanitized)
            $desc = sanitizeString($_POST["desc"]); // Description of the trip (Sanitized)
            $startdate = $_POST["startdate"];
            $enddate = $_POST["enddate"];
            $img = $_FILES["img"];
            $old_img_name = $img["name"];
            $pdf = $_FILES["pdf"];
            $old_pdf_name = $img["name"];

            $new_img_name = date("Y_m_d") . $title . ".jpg"; // Creates a new name for the image
            $new_pdf_name = date("Y_m_d") . $title . ".pdf"; // Creates a new name for the pdf fil
            // Makes the names folder-friendly
            $new_img_name = sanitizeName($new_img_name);
            $new_pdf_name = sanitizeName($new_pdf_name);

            $imgContent = addslashes(file_get_contents($img["tmp_name"]));
            $pdfContent = addslashes(file_get_contents($pdf["tmp_name"]));

            // Checks if image / pdf file sizes aren't too large. Then saves the images into the 'path' folder (specified above)
            if ($img["size"] <= $img_limit && $pdf["size"] <= $pdf_limit) {
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimetypeimg = finfo_file($finfo, $_FILES['img']['tmp_name']);
                $mimetypepdf = finfo_file($finfo, $_FILES['pdf']['tmp_name']);
                if (($mimetypeimg == 'image/jpeg' || $mimetypeimg == 'image/jpg') && $mimetypepdf == "application/pdf") {
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

        // If user wants to delete a trip
        if (isset($_POST["delete"], $_POST["selected"])) {
            $id = $_POST["selected"];

            // Finds the trip that user wants to delete
            $matka = null;
            foreach ($matkat as $m) {
                if ($m["id"] == $id) {
                    $matka = $m;
                    break;
                }
            }

            // If the id was correct (aka. trip was found)
            if ($matka != null) {

                // Used for checking if an image / pdf with same name has already been saved
                $duplicateImage = false;
                $duplicatePDF = false;

                // Checks for duplicate names
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

                // Doesn't remove the files if some other marker on the map uses them (aka. a duplicate was found)
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

            // Removes the trip
            deleteLiikuntamatka($id);
        }

        // If the user wants to edit a trip
        if (isset($_POST["edit"], $_POST["lat"], $_POST["id"], $_POST["lng"], $_POST["title"], $_POST["desc"], $_POST["startdate"], $_POST["enddate"])) {
            $lat = $_POST["lat"];
            $lng = $_POST["lng"];
            $title = sanitizeString($_POST["title"]);
            $desc = sanitizeString($_POST["desc"]);
            $startdate = $_POST["startdate"];
            $enddate = $_POST["enddate"];
            $id = $_POST["id"]; // Id of trip being edited

            // Checks if image / pdf are being edited.
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

            // Removes old files and saves the new ones if being edited
            // PDF
            if ($pdf != null && $pdf["size"] <= $pdf_limit) {
                $id = $_POST["id"];

                // Tries to find the trip being edited
                $matka = null;
                foreach ($matkat as $m) {
                    if ($m["id"] == $id) {
                        $matka = $m;
                        break;
                    }
                }

                // If found and a pdf for trip exists, removes the old file
                if ($matka != null) {
                    try {
                        if (file_exists($path . $matka["pdf_uusinimi"])) {
                            unlink($path . $matka["pdf_uusinimi"]);
                        }
                    } catch (Exception $e) {
                    }
                }

                // Saves the new uploaded file onto harddisk
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $mimetypepdf = finfo_file($finfo, $_FILES['pdf']['tmp_name']);
                if ($mimetypepdf == "application/pdf") {
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

            // JPG IMAGE
            if ($img != null && $img["size"] <= $img_limit) {
                $id = $_POST["id"];

                // Tries to find the trip being edited
                $matka = null;
                foreach ($matkat as $m) {
                    if ($m["id"] == $id) {
                        $matka = $m;
                        break;
                    }
                }

                // If found and a pdf for trip exists, removes the old file
                if ($matka != null) {
                    try {
                        if (file_exists($path . $matka["kuva_uusinimi"])) {
                            unlink($path . $matka["kuva_uusinimi"]);
                        }
                    } catch (Exception $e) {
                    }
                }

                // Saves the new uploaded file onto harddisk
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
            
            updateLiikuntamatka($id, $lat, $lng, $title, $desc, $startdate, $enddate, $imgContent, $old_img_name, $new_img_name, $pdfContent, $old_pdf_name, $new_pdf_name); // Updates the trip
        }

        // Shows intra page
        $matkat = getLiikuntamatkat();
        require "./views/admin.view.php";
    } else {
        header("location: ?page=login");
    }
}
