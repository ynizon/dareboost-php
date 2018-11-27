<?php
namespace DareboostPHP;


/**
 * Dareboost API SDK Class With Custom Query
 * Here, you have custom queries for getting some informations with custom settings (for my projects)...
 * 
 * @author generated
 * @author Yohann Nizon <ynizon@gmail.com>
 * DOC --> https://www.dareboost.com/fr/documentation-api
 * @version 2018-11-11 11:10
 */
class DareboostCustomAPI extends DareboostAPI
{
	/**
	Retrieve a report for an url
	return boolean, or report array
	*/	
	public function getAnalysisReportForUrl($url){
		$params = array("url"=>$url);
		
		$tab = array();
		$analysis = $this->analysisLaunch($params);
		if (isset($analysis["reportId"])){
			$sReportId = $analysis["reportId"];
			$params = array("reportId"=>$sReportId);
			
			$tab = array("status"=>202);//202 = In progress
			$iRetry = 0;			
			do{
				sleep(15);
				$tab = $this->getAnalysisReport($params);
				//echo var_dump($tab);
				$iRetry++;
				if ($tab["status"] == 200){
					return $tab["report"];
					exit();
				}
				
			}while ($iRetry < 5 and $tab["status"] != 200);
		}
		return false;
		
	}
}

?>