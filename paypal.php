<?php

if (isset($_REQUEST['p']) && isset($_REQUEST['i'])){

    $packet = $_REQUEST['p'];
    $id = $_REQUEST['i'];

    switch ($packet) {
		case '1':
            setData(array('item_name' => 'Cyborg ships.  (ID: '.$id.' )', 'amount' => '5.99'));
            break;
		case '2':
            setData(array('item_name' => '20 LF-4+20 BO3 Shield+5.000.000 Uridium+10 Level LF4+10 Level B03 Shield+1 Week Premium (ID: '.$id.' )', 'amount' => '15.00'));
            break; 
		case '3':
            setData(array('item_name' => '40 LF-4+40 BO3 Shield+10.000.000 Uridium+16 Level LF4+16 Level B03 Shield+2 Week Premium (ID: '.$id.' )', 'amount' => '30.00'));
            break;
		case '4':
            setData(array('item_name' => '2 Weeks premium (ID: '.$id.' )', 'amount' => '4.99'));
            break;
		case '5':
            setData(array('item_name' => '1 month premium (ID: '.$id.' )', 'amount' => '8.99'));
            break;
		case '6':	
            setData(array('item_name' => '2000 E.C(ID: '.$id.' )', 'amount' => '3.99'));
            break;
		case '7':
            setData(array('item_name' => '4500 E.C (ID: '.$id.' )', 'amount' => '6.99'));
            break;
        case '8':
            setData(array('item_name' => '15000 E.C (ID: '.$id.' )', 'amount' => '14.99'));
            break;
		case '9':
            setData(array('item_name' => '30000 E.C (ID: '.$id.' )', 'amount' => '24.99'));
            break;
		case '10':
            setData(array('item_name' => '75000 E.C (ID: '.$id.' )', 'amount' => '40.99'));
            break;
        case '11':
            setData(array('item_name' => '500000 uridium (ID: '.$id.' )', 'amount' => '5.99'));
            break;
		case '12':
            setData(array('item_name' => '1500000 uridium (ID: '.$id.' )', 'amount' => '8.99'));
            break;
		case '13':
            setData(array('item_name' => '3000000 uridium (ID: '.$id.' )', 'amount' => '11.99'));
            break;     
		case '14':
            setData(array('item_name' => '5000000 uridium (ID: '.$id.' )', 'amount' => '15.99'));
            break;  
		case '15':
            setData(array('item_name' => '10000000 uridium (ID: '.$id.' )', 'amount' => '19.99'));
            break; 
		case '16':
            setData(array('item_name' => '1 Gold Key.Contents:The system gives it randomly=
Goliath+Cyborg Desings.
These contents are available. (ID: '.$id.' )', 'amount' => '5.99'));
            break; 
		case '17':
            setData(array('item_name' => '10 Gold Key.Contents:The system gives it randomly=
Goliath+Cyborg Desings.
These contents are available. (ID: '.$id.' )', 'amount' => '40.99'));
            break; 
		case '18':
            setData(array('item_name' => '100 Blue Key (ID: '.$id.' )', 'amount' => '10.99'));
            break; 
		case '19':
            setData(array('item_name' => '250 Blue Key (ID: '.$id.' )', 'amount' => '16.99'));
            break; 
		case '20':
            setData(array('item_name' => '10 E.C Key (ID: '.$id.' )', 'amount' => '7.99'));
            break; 
		case '21':
            setData(array('item_name' => '25 E.C Key (ID: '.$id.' )', 'amount' => '17.99'));
            break; 
		case '22':
            setData(array('item_name' => '20 Prometheusz+20 BO3 Shield+5.000.000 Uridium+10 Level Prometheusz+10 Level B03 Shield+2 Week Premium (ID: '.$id.' )', 'amount' => '25.00'));
            break;
		case '23':
            setData(array('item_name' => '40 Prometheusz+40 BO3 Shield+10.000.000 Uridium+16 Level Prometheusz+16 Level B03 Shield+1 Month Premium+5000 E.C (ID: '.$id.' )', 'amount' => '50.00'));
            break;
			
			
        default:
            die('403.');
            break;

    }


} else {
    die('403.');
}

function setData($params){
    $query = array();
    $query['cmd'] = "_donations";
    $query['business'] = "@gmail.com";
    $query['item_name'] = $params['item_name'];
    $query['amount'] = $params['amount'];
    $query['currency_code'] = "EUR";
    $query['custom'] = "";
    $query['return'] = 'http://completed.php';
    $query['cancel_return'] = 'http://canceled.php';
    header('Location: https://www.paypal.com/cgi-bin/webscr?' . http_build_query($query));
}

?>