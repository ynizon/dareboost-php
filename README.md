# dareboost-php
For Dareboost API PHP library v0.5.

You have 3 files:
DareboostBase is for call the API...
DareboostAPI is the list of functions available with the API (see https://www.dareboost.com/en/documentation-api)
DareboostCustomAPI is a list of custom functions i need. 

Define your dareboost token api on your config/app.php
DAREBOOST_KEY

Then, use like this:
use DareboostPHP\DareboostBase;
use DareboostPHP\DareboostAPI;
use DareboostPHP\DareboostCustomAPI;

$api = new DareboostCustomAPI(config("app.DAREBOOST_KEY"));
//Launch Analysis<br/>
$params = array("url"=>"https://www.gameandme.fr");
$json = $api->analysisLaunch($params);
//Get a result from a url
$api = new DareboostCustomAPI(config("app.DAREBOOST_KEY"));
$tab = $api->getAnalysisReportForUrl("https://www.gameandme.fr");

Take care with this error:
Too many simultaneous analysis. You have reached the maximum number of simultaneous analysis for your profile. You can upgrade your offer or wait until the current analysis is completed.

Contact: ynizon@gmail.com
