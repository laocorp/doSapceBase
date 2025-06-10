<?php require_once(INCLUDES . 'header.php'); ?>
<link rel="stylesheet" href="/public/css/voucher.css">
<?php require_once(INCLUDES . 'data.php'); ?>


<br><br>

<div class="page settings styleUpdate">
<div id="dummy"></div>
<div class="settings-container">
<div class="popup">
<div class="popup-container">
<p class="popup-text"></p>
</div>
</div>
<div class="loader">
<div class="loader content">
<i class="fa fa-cog fa-spin"></i><br>
Loading
</div>
</div>
<div class="data">
<div class="input">
<input id="voucherInput" class="voucherInput" type="text" value="" placeholder="Voucher" required><br>
<br>
<button type="submit" class="btn btn-lg btn-success" onclick="useVoucher();">Use</button>
</div>
<div class="table table-list-search" style="padding-bottom: 10px;">
<table id="resultTable">
<thead><tr>
<th>Voucher</th>
<th>Item</th>
<th>Description</th>
<th>Date</th>
</tr>
</thead>
<?php
$QLog = $mysqli->query("SELECT voucher, item, amount, date FROM voucher_log WHERE userId = '".$player['userId']."' ORDER by date DESC");
if ($QLog->num_rows > 0){
    while($row = $QLog->fetch_assoc()){
        ?>
        <tbody>
        <th><?= $row['voucher']; ?></th>
        <th><?= $row['item']; ?></th>
        <th><?= $row['amount']; ?></th>
        <th><?= date("d-m-Y h:i:s", $row['date']); ?></th>
        </tbody>
        <?php
    }
} else { ?>
<tbody>

</tbody>
</table>
<div style="padding-top:10px; color:red; text-align:center; font-weight:bold;" id="nrf">No record found</div>
<?php } ?>
</div>
</div>
</div>
</div>

<script type="text/javascript">
    function useVoucher(){
        var voucherId = document.getElementById('voucherInput').value;
        
        if (voucherId){
            $.ajax({
                type: 'POST',
                url: '<?php echo DOMAIN; ?>api/',
                data: 'voucherId='+voucherId+'&action=voucher',
                success: function(response) {
                var json = jQuery.parseJSON(response);

                if (json.message !== ""){
                    toast(json.message);
                }

                if (json.voucher !== "" && json.item !== "" && json.amount !== "" && json.date){

                    var table = document.getElementById("resultTable").getElementsByTagName('tbody')[0];

                    var row = table.insertRow(0);

                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);

                    cell1.innerHTML = json.voucher;
                    cell2.innerHTML = json.item;
                    cell3.innerHTML = json.amount;
                    cell4.innerHTML = json.date;

                    if (document.getElementById('nrf')){
                        document.getElementById('nrf').style.display = 'none';
                    }

                }

                if (json.uridium !== ""){
                    document.getElementsByClassName('user-uridium')[0].innerHTML = json.uridium;
                }

                if (json.credits !== ""){
                    document.getElementsByClassName('user-credits')[0].innerHTML = json.credits;
                }

                if (json.event_coins !== ""){
                    document.getElementsByClassName('user-fraktal')[0].innerHTML = json.event_coins;
                }

                }
            });
        } else {
            toast("Please enter a voucher code.");
        }
    }
</script>


<?php require_once(INCLUDES . 'footer.php'); ?>