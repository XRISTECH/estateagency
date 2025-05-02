<?php
    require_once("connection.php");

    if(isset($_POST["submit"])){
        $name = isset($_POST["name"]) ? $_POST["name"] : " ";
        $location = isset($_POST["location"]) ? $_POST["location"] : " ";
        $type = isset($_POST["type"]) ? $_POST["type"] : " ";
        $status = isset($_POST["status"]) ? $_POST["status"] : " ";
        $area = isset($_POST["area"]) ? $_POST["area"] : " ";
        $bed = isset($_POST["bed"]) ? $_POST["bed"] : " ";
        $bath = isset($_POST["bath"]) ? $_POST["bath"] : " ";
        $desc = isset($_POST["desc"]) ? $_POST["desc"] : " ";
        $garage = isset($_POST["garage"]) ? $_POST["garage"] : " ";
        $price = isset($_POST["price"]) ? $_POST["price"] : " ";
        $pid = $_POST["pid"];
        $img = $_POST["img"];

        if ($name == "" || $location == "" || $type == "" || $status == "" || $area == "" || $bed == "" || $bath == "" || $desc == "" || $garage == "" || $price == ""){
            $error = "All fields are required";
            header("Location: ../edit.php?error=". $error."&pid=".$pid); //to bounce back to edit.php with the specific id
            return false;
        }
        

        $name = sanitize($connect, $name);
        $location = sanitize($connect, $location);
        $type = sanitize($connect, $type);
        $status = sanitize($connect, $status);
        $area = sanitize($connect, $area);
        $bed = sanitize($connect, $bed);
        $bath = sanitize($connect, $bath);
        $desc = sanitize($connect, $desc);
        $garage = sanitize($connect, $garage);
        $price = sanitize($connect, $price);
        $today = date("Y-m-d");


        if($_FILES['file']['name'] != ""){ //to check for picture editing/changing. this means  if the file upload is not empty
            $allow = array('png', 'jpeg', 'jpg', 'gif', 'heic');
            $filename = $_FILES['file']['name'];   
            $fileTmp = $_FILES['file']['tmp_name']; //temporary location
            $filesize = $_FILES['file']['size'];  
            $fileext = explode(".", $filename); //splits the string based on the parameter(.)
            $fileActualext = strtolower(end($fileext)); //file extension type

            if($filesize < 800000){
                if(in_array($fileActualext, $allow)){
                    $pic = uniqid('', true). ".".$fileActualext; //rename the img with a unique id
                    $location2 = 'post/' . $pic;
                        if(move_uploaded_file($fileTmp, $location2)){
                            // $password = md5($password); for password only(encrypting)

                            //FOR UPDATE, table name and column name is enclosed in btw `` while variable name is enclosed in btw ''

                            $sql = "UPDATE `properties` SET `name` = '$name', `location` = '$location', `ptype` = '$type', `status` = '$status', `area` = '$area', `bed` = '$bed', `bath` = '$bath', `garage` = '$garage', `description` = '$desc', `img` = '$pic', `createddate` = '$today', `price` = '$price' WHERE `id` = '$pid' ";

                            $result = mysqli_query($connect, $sql);
                            if($result){
                                unlink("post/".$img); //to remove previous picture
                                $success = "Post Updated";
                                header("Location: ../edit.php?success=". $success."&pid=".$pid);
                                return false;
                            }else{
                                $error = "error updating post";
                                header("Location: ../edit.php?error=". $error."&pid=".$pid);
                                return false;
                            }
                        }else{
                            $error = "error uploading file";
                            header("Location: ../edit.php?error=". $error."&pid=".$pid);
                            return false;
                        }
                }else{
                    $error = "Upload picture only";
                    header("Location: ../edit.php?error=". $error."&pid=".$pid);
                    return false;
                }
                    
                            //by default, password is encrypted in php using md5
            }else{
                $error = "File uploaded is too large";
                header("Location: ../edit.php?error=". $error."&pid=".$pid);
                return false;
            }
    
        }else{
        $sql = "UPDATE `properties` SET `name` = '$name', `location` = '$location', `ptype` = '$type', `status` = '$status', `area` = '$area', `bed` = '$bed', `bath` = '$bath', `garage` = '$garage', `description` = '$desc', `createddate` = '$today', `price` = '$price' WHERE `id` = '$pid' ";

        $result = mysqli_query($connect, $sql);
        if($result){
            $success = "Post Updated";
            header("Location: ../edit.php?success=". $success."&pid=".$pid);
            return false;
        }else{
            $error = "error updating post";
            header("Location: ../edit.php?error=". $error."&pid=".$pid);
            return false;
        }
        }
                    
    }else{
        header("Location: ../"); //index page
        return false;
    }



?>