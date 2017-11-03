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


<meta name="referrer" content="no-referrer" />



	<?php 
		if($result_html!=''){
	?>
	<script>
        //location.href='https://hidereferrer.com/?<?php echo $final_url;?>'
		window.open('<?php echo $final_url;?>');
    </script> 
    <?php 
            //echo $final_url;    
        }
    ?>
