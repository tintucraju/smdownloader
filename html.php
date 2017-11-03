<?php 
header("Access-Control-Allow-Origin: *");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Smule Downloader By Tintu C Raju</title>
	<meta name="theme-color" content="#E91E63" />
	<meta 
     name='viewport' 
     content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' 
/>
<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">

</head>
<body>

<div class='main'>

<form method='get' target='frameName' action ="https://smuledownloader.herokuapp.com/api.php">
<div class='header'>
	<h3 class='appTitle'>Smule Downloader By Tintu</h3>
	<h3 class='urlText'>
	Url
	</h3>
	 <input type='text' name='smule_url' class='downloadInput'><button type='submit' class='go'>Go</button>
</div>

<div class='resultSection'>
	
	<iframe name='frameName' id='resultFrame'></iframe>

	
</div>
</form>


</div>


<script>
 
//  function infiniteRunner(){
//  	setTimeout(infiniteRunner,1000);
//  } 

// infiniteRunner();


</script> 


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
