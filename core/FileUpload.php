<?php
class FileUpload {

    public function fileUpload($uploadFile, $name_file)
    {
        if ($_FILES[$name_file]["name"] != "") {
            $target_dir = "upload/".$uploadFile;
            $target_file = $target_dir . basename($_FILES[$name_file]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $image_unique = uniqid().'.'.$imageFileType;
            $target_file = $target_dir.$image_unique;
    
            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES[$name_file]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    return "File is not an image.";
                    $uploadOk = 0;
                }
            }
            // Check file size
            if ($_FILES[$name_file]["size"] > 3000000) {
                return "Sorry, your file is too large.";
                $uploadOk = 0;
            }
    
            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }
    
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                return "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES[$name_file]["tmp_name"], $target_file)) {
                    return ["The file " . htmlspecialchars(basename($_FILES["$name_file"]["name"])) . " has been uploaded.", $image_unique];
                } else {
                    return "Sorry, there was an error uploading your file.";
                }
            }
        }
       
    }

    public function getFileContent($url) {
        $imagePath = 'upload/'.$url;

        // Đọc dữ liệu từ file ảnh
        $imageData = file_get_contents($imagePath);
        
        // Xác định kiểu MIME của file ảnh
        $mime = mime_content_type($imagePath);
        
        // Thiết lập header để hiển thị hình ảnh
        header('Content-Type: ' . $mime);
        
        // Xuất dữ liệu ảnh
        echo $imageData;
    }
}
?>