<?php
$result_html = "";
header("Access-Control-Allow-Origin: *");
function smule_($url){
    try {
        $ch = curl_init();

        if (FALSE === $ch)
            throw new Exception('failed to initialize');

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_REFERER,'');
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
     

        return $content = curl_exec($ch);

        if (FALSE === $content)
            throw new Exception(curl_error($ch), curl_errno($ch));

        // ...process $content now
    } catch(Exception $e) {

        trigger_error(sprintf(
            'Curl failed with error #%d: %s',
            $e->getCode(), $e->getMessage()),
            E_USER_ERROR);

    }   

}
if(isset($_GET['smule_url'])) {
	$smule_url = $_GET['smule_url'];
	$smule_url = urlencode($smule_url);
	$fetch_data = smule_("sing.salon/smule-downloader/?url=".$smule_url);
	$xplode_dat = explode('<a class="ipsButton ipsButton_medium ipsButton_important" href="',$fetch_data);
	$fetch_data = str_replace('">  Download Video','',explode("</a>",explode('<a class="ipsButton ipsButton_medium ipsButton_important" href="',$fetch_data)[1])[0]);
	$final_url = explode('"',$fetch_data)[0];
	$log = file_get_contents("log.txt");
	$log .="\n" . date("d-M-Y") . " - from url " . $smule_url;
	$result_html = "<a target='_blank' href='$final_url'>Download</a>";
 } 
 //$result_html  = "<a target='_blank' href='test'>Download</a>";
?>





<!DOCTYPE html>
<html>
<head>
	<title>Smule Downloader</title>
	<meta name="theme-color" content="#E91E63" />
	<meta 
     name='viewport' 
     content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' 
/>
<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">

</head>
<body>

<div class='main'>

<form method='get' action ="mobile.php">
<div class='header'>
	<h3 class='appTitle'>Smule Downloader</h3>
	<h3 class='urlText'>
	Url
	</h3>
	 <input type='text' name='smule_url' class='downloadInput'><button type='submit' class='go'>Go</button>
</div>

<div class='resultSection'>
	<?php 
		if($result_html!=''){
	?>
	<iframe id='resultFrame' src='<?php echo $final_url;?>'></iframe>
	<?php 
		}
	?>
	
</div>
</form>


</div>

<style>
iframe#resultFrame {
    border: none;
    width: 100%;
    height: 50vh;
}
.resultSection{
	width: 100%;
}
button.go {
    width: 34px;
    height: 28px;
    position: relative;
    top: -4px;
    background: #F44336;
    border: none;
    color: white;
}

.urlText{
	    float: left;
    font-size: 16px;
    color: white;
    margin-top: 3px;
    margin-left: 8px;
}
.downloadInput{
	width: 75%;
    margin-left: 2%;
    margin-right: 3%;
    padding-top: 8px;
    border: solid 1px #fffdfd;
}
body{
	
}
.appTitle{
    padding: 11px;
    color: white;
    font-size: 20px;
    padding-top: 14px;
    font-family: 'Satisfy', cursive;

}
.header{
	width: 100%;
	    background: #E91E63;
	height:104px;
}
.main{
	width:100%;
}

 *{
 	margin:0;
 	padding: 0px;
 }
</style> 

</body>
</html>
