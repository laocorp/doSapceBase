<?php require_once(INCLUDES . 'header.php');
$category = Functions::getShopCategories();
$player = Functions::GetPlayer();
?>
<link rel="stylesheet" href="/public/css/shopupdate.css">
<style>
.toast {
    border-radius: 2px;
    top: -35px;
    float: right;
    width: auto;
    margin-top: -100px;
    position: relative;
    max-width: 25%;
    height: auto;
    min-height: 88px;
    line-height: 1.5em;
    background-color: #323232;
    padding: 10px 25px;
    font-size: 2.1rem;
    font-weight: 500;
    color: #fff;
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -webkit-justify-content: space-between;
    -ms-flex-pack: justify;
    justify-content: space-between;
    cursor: default;
}
</style>
<?php require_once(INCLUDES . 'data.php'); ?>
<div class="page shop">
<div class="shop-container styleUpdate" style="width: 1102px;height 802px;height: 702px;">
<div class="loader">
<div class="content"><i class="fa fa-check fg-green"></i><br>
								  <b>1x ship: "ship_bigboy" purchsased.<br><br></b><br>
								  <a class="btn btn-default" onclick="PG.Gui.hideInfo();">OK</a></div>
</div>
<div class="nav-left">

<?php foreach ($category as $value) { ?>
<a  class="ammo-button" onclick="openCity('<?php echo $value; ?>')" style = 'text-transform: uppercase;'>	<?php echo $value; ?></a>	
<?php } ?>

</div>

<div class="items ps-scrollbar-y ps-container ps-active-y" style = 'overflow: auto;'>

 <div  class="w3-container w3-border city"><center>
   <h1><blink> <p style="color:red;">PURCHARSE WARNING</p></blink></h1><br>
   <h2><p style="color:white;"> No, we are responsible if the object you buy is not to your liking, read the information of each object before buying.</p><h2>
	<br>
	 <p>No refund</p>
 </center> </div>
  
<?php foreach ($category as $value) { ?>
<div id="<?php echo $value; ?>" class="<?php echo $value; ?> city" style="display:none">

<h4><?php echo $value; ?></h4>

<?php 
  $items = Functions::getShopItems($value);
  if ($items){
  foreach($items as $value2){
    
    if ($value2 && $value2['category'] == $value){
      $priceFinal = $value2['price'] ;
      ?>
        <div id="<?php echo $value2['id']; ?>" style="#2d2d2d no-repeat; background-size: 100% 100%;" class="item itmstyleUpdateCredits">
        <img src="<?php echo DOMAIN; ?><?php echo $value2['image']; ?>">
        <div class="price" style="font-weight: bold;"><?php echo number_format($priceFinal, 0, '.', '.'); ?> </div>
        </div>
      <?php
    }
  }
  } else {
    ?>
    <div style="padding: 15px;">
      <div style="border: 1px solid red; border-radius: 10px; text-align:center;">No results found.</div>
    </div>
    <?php
  }
  ?>
  </div>
  <?php
}
?>

</div>


<div class="item-infos" style="display:none; border-bottom: 1px solid #00a5a4;">
<div class="item"><img src="/do_img/global/items/ship/phoenix_100x100.png" id="imageShop"></div>
<div class="infos">
<b class="name" id="name"></b>
<p class="desc ps-container" id="info"></p>
</div>
<div class="action">

<div class="quantity-container" style="display:none;">
<b>Quantity</b>
<input id="" onkeyup="return getPrice(this.value, this.id);" class="form-control quantity priceAmount" autocomplete="off" name="quantity" type="text"  value="1" maxlength="20">
</div>

<br>
<b>Price</b>


<div class="input-group">
<div class="input-group-addon currency" id="priceType">U</div>
<input type="text" readonly="" class="form-control price" value="" id="price">
</div>

<br>
<div id=""  class="button buy comprarshop">Buy</div>

</div>
</div>
</div>
</div>
<?php require_once(INCLUDES . 'footer.php'); ?>
<script>
function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";  
}
</script>