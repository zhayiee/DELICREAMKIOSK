<?php 
  include '../deliCream/db/connection.php';
  include '../deliCream/db/select.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deli Cream - Menu</title>
  <link rel="stylesheet" type="text/css" href="../deliCream/bootstrap/css/bootstrap.min.css"/>
</head>
<style>
body, html{
    background-image: url(../deliCream/images/2nd\ bg.jpg);
    background-size: 100% auto;
    background-repeat: no-repeat;
    background-attachment: fixed;
    font-family: 'Arial', sans-serif;
}
.menu:hover{
  transform: scale(1.05);
}
.pink-text{
    background-color: #f0e2f191;
    color: rgb(225, 53, 110);
    font-size: 50px;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}
.option{
    background-color: rgba(255, 192, 203, 0.489);
    border: 2px solid black;
}
.btn-view{
  background-color: #ed91c2;
  border: 2px dashed #fc6783;
}
.active{
  background-color: rgb(199, 161, 167) !important;

}
.card{
  background-color: #c8b9c1e3;
}
</style>
<body>
    <div class="container-fluid text-center">
         <div class="d-flex align-items-center justify-content-center">
            <button class="btn" style="background-color: rgb(222, 197, 201); color: rgb(225, 53, 110);"><a class="text-decoration-none text-light" href="start.html">Back</a></button>
            <h1 class="ms-auto me-auto pink-text">Menu</h1>
         </div>
        <div class="d-flex">
            <section class="menuSection">
                <div class="btn-group-vertical me-3">
                    <button id="coneNCup" type="button" class="btn btn-primary p-0 menu" style="width: 150px; height: 150px;"><img src="../deliCream/images/cone&cup.png" class="w-100 h-100" style="object-fit: cover;"></button>
                    <button id="flavors" type="button" class="btn btn-primary p-0 menu" style="width: 150px; height: 150px;"><img src="../deliCream/images/flavor.png" class="w-100 h-100" style="object-fit: cover;"></button>
                    <button id="topping" type="button" class="btn btn-primary p-0 menu" style="width: 150px; height: 150px;"><img src="../deliCream/images/toppings.png" class="w-100 h-100" style="object-fit: cover;"></button>
                    <button id="addOn" type="button" class="btn btn-primary p-0 menu" style="width: 150px; height: 150px;"><img src="../deliCream/images/add-ons.png" class="w-100 h-100" style="object-fit: cover;"></button>
                </div>
            </section>
            <section class="option overflow-auto d-flex flex-wrap flex-wrap d-none" style="max-height: 37rem; max-width: 100%;" id="flavor">
                <?php
                   while ($row = $flavor->fetch_assoc()){
                ?>
                <div class="card p-2 m-2" style="width: 11rem; height: 20rem;">
                    <img src="../deliCream/images/<?= $row['flavor_poster']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"><?= $row['flavor_name']?></h5>
                      <p><b><?= $row['price']?></b></p> 
                       <div class="buttons d-flex align-items-center justify-content-center">
                        <button class="btn" id="<?= idConvert($row['flavor_name']);?>Add" onclick="addQty('<?= idConvert($row['flavor_name']);?>', '<?= $row['flavor_name']?> flavor')">+</button>
                        <p class="m-0" id="<?= idConvert($row['flavor_name']);?>Qty" >0</p>
                        <button class="btn" id="<?= idConvert($row['flavor_name']);?>Minus" onclick="minusQty('<?= idConvert($row['flavor_name']);?>', '<?= $row['flavor_name']?> flavor')">-</button>
                       </div>
                    </div>
                </div>
                <?php
                   }
                ?>
            </section>
            <section class="option overflow-auto d-flex flex-wrap flex-wrap d-none w-100" id="cone">
               <?php
                   while ($row = $cone->fetch_assoc()){
                ?>
                <div class="card p-2 m-2" style="width: 11rem; height: 20rem;">
                    <img src="../deliCream/images/<?= $row['cone_poster']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"><?= $row['cone_name']?></h5>
                      <p><b><?= $row['price']?></b></p> 
                       <div class="buttons d-flex align-items-center justify-content-center">
                        <button class="btn" id="<?= idConvert($row['cone_name']);?>Add" onclick="addQty('<?= idConvert($row['cone_name']);?>', '<?= $row['cone_name']?> cone')">+</button>
                        <p class="m-0" id="<?= idConvert($row['cone_name']);?>Qty" >0</p>
                        <button class="btn" id="<?= idConvert($row['cone_name']);?>Minus" onclick="minusQty('<?= idConvert($row['cone_name']);?>', '<?= $row['cone_name']?> cone')">-</button>
                       </div>
                    </div>
                </div>
                <?php
                   }
                ?>
                <?php
                   while ($row = $cup->fetch_assoc()){
                ?>
                <div class="card p-2 m-2" style="width: 11rem; height: 20rem;">
                    <img src="../deliCream/images/<?= $row['cup_poster']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"><?= $row['cup_name']?></h5>
                      <p><b><?= $row['price']?></b></p> 
                       <div class="buttons d-flex align-items-center justify-content-center">
                        <button class="btn" id="<?= idConvert($row['cup_name']);?>Add" onclick="addQty('<?= idConvert($row['cup_name']);?>', '<?= $row['cup_name']?> cups')">+</button>
                        <p class="m-0" id="<?= idConvert($row['cup_name']);?>Qty" >0</p>
                        <button class="btn" id="<?= idConvert($row['cup_name']);?>Minus" onclick="minusQty('<?= idConvert($row['cup_name']);?>', '<?= $row['cup_name']?> cup')">-</button>
                       </div>
                    </div>
                </div>
                <?php
                   }
                ?>
            </section>
            <section class="option overflow-auto d-flex flex-wrap flex-wrap d-none" style="max-height: 37rem; max-width: 100%;" id="toppings">
               <?php
                   while ($row = $toppings->fetch_assoc()){
                ?>
                <div id="<?= idConvert($row['toppings_name']);?>" class="card p-2 m-2 toppings" style="width: 11rem; height: 20rem;">
                    <img src="../deliCream/images/<?= $row['toppings_poster']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"><?= $row['toppings_name']?></h5>
                      <p class="<?= idConvert($row['toppings_name'])?>"><b><?= $row['price']?></b></p> 
                       <div class="price d-flex align-items-center justify-content-center">
                       </div>
                    </div>
                </div>
                <?php
                   }
                ?>
            </section>
            <section class="option overflow-auto d-flex flex-wrap flex-wrap d-none" style="max-height: 37rem; max-width: 100%;" id="add-ons">
               <?php
                   while ($row = $add_ons->fetch_assoc()){
                ?>
                <div class="card p-2 m-2" style="width: 11rem; height: 20rem;">
                    <img src="../deliCream/images/<?= $row['addOns_poster']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title"><?= $row['addOns_name']?></h5>
                      <p><b><?= $row['price']?></b></p> 
                       <div class="buttons d-flex align-items-center justify-content-center">
                        <button class="btn" id="<?= idConvert($row['addOns_name']);?>Add" onclick="addQty('<?= idConvert($row['addOns_name']);?>', '<?= $row['addOns_name']?> add-ons')">+</button>
                        <p class="m-0" id="<?= idConvert($row['addOns_name']);?>Qty" >0</p>
                        <button class="btn" id="<?= idConvert($row['addOns_name']);?>Minus" onclick="minusQty('<?= idConvert($row['addOns_name']);?>', '<?= $row['addOns_name']?> add-ons')">-</button>
                       </div>
                    </div>
                </div>
                <?php
                   }
                ?>
            </section>
            <section class="option d-flex flex-wrap flex-wrap w-100" id="bg">
            </section>
        </div>  
        <div class="view-cart d-flex justify-content-end mt-3">
          <button type="button" class="btn btn-view text-light" data-bs-toggle="modal" data-bs-target="#cart">View cart</button>
        </div>
        <div class="modal" id="cart">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h6 class="pink-text mx-auto">Cart</h6>
              </div>
              <div class="modal-body" id="orderItems">
                <h6 class="pink-text">Content</h6>
                
              </div>
              <div class="modal-footer">
                <button class="btn" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
    </div>

    <script src="option.js"></script>
    <script src="../deliCream/bootstrap/js/bootstrap.bundle.js"></script>
</body>
</html>
