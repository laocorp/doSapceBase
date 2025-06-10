<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/public/css/equipament.css" />

<?php require_once(INCLUDES . 'data.php'); ?>


<div class="page ship">
<div class="ships styleUpdate" style="width:772px;height:465px; margin:0 auto;">
<div id="equipment_container"><object width="770" height="395" id="inventory" name="inventory" data="" type="application/x-shockwave-flash"><param name="allowfullscreen" value="true"><param name="allowscriptaccess" value="always"><param name="quality" value="high"><param name="wmode" value="transparent"><param name="flashvars" value=""></object></div>


<a href="/settings" class="button" title="Settings">
<button class="pet" style="position: relative;
    width: 250px;
    /* height: 36px; */
    left: 249px;
    top: -3px;
    text-align: center;
    font-size: 14px;
    border: 1px dashed #ABB50F;
    border-radius: 50px;">Select PET Design</button>
<style>
   .pet {
  background-color: #164227; /* Green */
  border: none;
  color: white;
  padding: 16px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
    }
       
    .pet:hover{
    background-color:black;
        color:red;
        border: 1px solid white;
       }
}

</style>


<?php require_once(INCLUDES . 'footer.php'); ?>
