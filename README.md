# dareboost-php
For Dareboost API PHP library v0.5.
-----------------------------------------------------------

You have 3 files:<br/>
DareboostBase is for call the API...<br/>
DareboostAPI is the list of functions available with the API (see https://www.dareboost.com/en/documentation-api)<br/>
DareboostCustomAPI is a list of custom functions i need. <br/>

-----------------------------------------------------------
Define your dareboost token api on your config/app.php<br/>
DAREBOOST_KEY<br/>

Then, use like this:<br/>
use DareboostPHP\DareboostBase;<br/>
use DareboostPHP\DareboostAPI;<br/>
use DareboostPHP\DareboostCustomAPI;<br/>
<br/>
$api = new DareboostCustomAPI(config("app.DAREBOOST_KEY"));
//Launch Analysis<br/>
$params = array("url"=>"https://www.gameandme.fr");
$json = $api->analysisLaunch($params);<br/>

//Get a result from a url
$api = new DareboostCustomAPI(config("app.DAREBOOST_KEY"));
$tab = $api->getAnalysisReportForUrl("https://www.gameandme.fr");
<br/>
Take care with this error:
Too many simultaneous analysis. You have reached the maximum number of simultaneous analysis for your profile. You can upgrade your offer or wait until the current analysis is completed.
<br/>
-----------------------------------------------------------
Contact: ynizon@gmail.com