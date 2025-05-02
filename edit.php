<?php
 require_once ("includes/connection.php"); 

 if(isset($_GET["pid"])){
    $pid = $_GET["pid"];
    $sql = "SELECT * FROM properties WHERE id = '$pid'";
    $res = mysqli_query($connect, $sql);
    // no need for a while loop since we are pulling out just one row
    $rows = mysqli_fetch_assoc($res);
    $id = $rows["id"];
    $adminid = $rows["adminid"];
    $pname = $rows["name"];
    $pimg = $rows["img"];
    $ptype = $rows["ptype"];
    $price = $rows["price"];
    $area = $rows["area"];
    $bed = $rows["bed"];
    $bath = $rows["bath"];
    $garage = $rows["garage"];
    $location = $rows["location"];
    $description = $rows["description"];
    $status = $rows["status"];


  }else{
    header("Location: property.php");
    return false;
  }

 require_once ("includes/headertwo.php"); 
 ?>

  <main id="main">
    <section class="container" style="margin-top: 10%;">
        <div class="row">
            <div class="col-md-12">
                <h3>Edit Property</h3>
                <p>fill the form below to edit a post.</p>
            </div>
        </div>
        <div class="row mt-3 mb-4">
                <div class= "col-md-4">
                    <p>Display Photo</p>
                    <img src="includes/post/<?=$pimg?>" alt="" width="100" height="100">
                </div>
            </div>
        <div class="row">
            <div class="col-md-12">
                <form action="includes/editsub.php" METHOD= "POST" enctype="multipart/form-data">
                <?php
                  if(isset($_GET["error"])){ ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button class="btn-close" data-bs-dismiss="alert"></button>
                      <p><?= $_GET["error"];?></p>
                    </div>
                    <?php } 
                    elseif(isset($_GET["success"])){ ?>
                    <div class="alert alert-success alert-dismissible">
                      <button class="btn-close" data-bs-dismiss="alert"></button>
                      <p><?php echo $_GET["success"];?></p>
                    </div>
                    <?php } ?>

                    <div class="form-group"> 
                        <label for="">Name</label>
                        <input type="text" value="<?=$pname?>" class="form-control" name="name" id="">
                        <input type="hidden" name="pid" value="<?=$pid?>">
                        <input type="hidden" name="img" value="<?=$img?>">
                    </div>
                    <div class="form-group">
                        <label for="">Location</label>
                        <input type="text" value="<?=$location?>" class="form-control" name="location" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Property Type</label>
                        <input type="text" value="<?=$ptype?>" class="form-control" name="type" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="status" class="form-control" id="">
                            <option value="<?=$status?>"><?=$status?></option>
                            <option value="Sale">Sale</option>
                            <option value="Rent">Rent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Area</label>
                        <input type="text" value="<?=$area?>" class="form-control" name="area" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Bed</label>
                        <input type="text" value="<?=$bed?>" class="form-control" name="bed" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Bath</label>
                        <input type="text" value="<?=$bath?>" class="form-control" name="bath" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Garage</label>
                        <input type="text" value="<?=$garage?>" class="form-control" name="garage" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="desc" id="" cols="30" rows="10" class="form-control"><?=$description?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Picture</label>
                        <input type="file" class="form-control" name="file" id="">
                    </div>
                    <div class="form-group">
                        <label for="">Price</label>
                        <input type="number" class="form-control" name="price"
                         value="<?=$price?>" id="">
                    </div>
                    <div class="form-group mt-3">
                        <button class="btn btn-success" name="submit">submit</button>
                    </div>
                </form><br><br>
            </div>
        </div>
    </section>
  </main><!-- End #main -->

  

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>