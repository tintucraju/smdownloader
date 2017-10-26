<?php
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

$smule_url = $_GET['smule_url'];
$smule_url = urlencode($smule_url);
$fetch_data = smule_("sing.salon/smule-downloader/?url=".$smule_url);
$xplode_dat = explode('<a class="ipsButton ipsButton_medium ipsButton_important" href="',$fetch_data);
// var_dump($xplode_dat);
// die;
$fetch_data = str_replace('">  Download Video','',explode("</a>",explode('<a class="ipsButton ipsButton_medium ipsButton_important" href="',$fetch_data)[1])[0]);
$final_url = explode('"',$fetch_data)[0];
$log = file_get_contents("log.txt");
$log .="\n" . date("d-M-Y") . " - from url " . $smule_url;
//file_put_contents("log.txt", $log);
echo $final_url; 
//echo "<a href='$final_url'>Download</a>";
  die;



header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . $fname . "\""); 
readfile($final_url); 

die;




?>


// smule downloader new feature releast 0.6 ==> 1.1

var _smule_download_button_current_count = 0;

function _generate_download_buttons(){
    
    var _buttons =  document.querySelectorAll("a.title");
    var _old_buttons = document.querySelectorAll(".downloadSmuleQuick");

    for(var x=0;x<_old_buttons.length;++x){
        _old_buttons[x].remove(); 
    }

    var _css = 'float: right;position: absolute;top: 12px;padding: 4px;right: 135px;background: #fafffa;border: solid 1px gainsboro;color: #009688;padding-left: 8px;padding-right: 10px;';
    _css+='top: 52px !important;right: 63px !important;height: 20px !important;font-size: 11px;padding: 4px !important;padding-top: 1.9px !important;background: #f1eded !important;'
    for(var i=0;i<_buttons.length;++i){
        var ob = _buttons[i];
        var _html = '<button url="'+ob.href+'" class="downloadSmuleQuick" style="'+_css+'">Download</button>';
        ob.insertAdjacentHTML('afterend', _html);
    }

    _smule_download_button_current_count = _buttons.length;
}


function _dom_updated_for_smule(){
    if(document.querySelectorAll("a.title").length> _smule_download_button_current_count){
        _generate_download_buttons();
    }
    setTimeout(_dom_updated_for_smule,1000);
}

_dom_updated_for_smule();


document.addEventListener('click',function(e){
    if(e.target && e.target.className== 'downloadSmuleQuick'){
        var _target_url = e.srcElement.getAttribute("url")
        window.open("http://local.dev/other/smule_downloader/?smule_url="+_target_url);
        console.log(e.srcElement);
    }
 })


