<?php
namespace DareboostPHP;


/**
 * Dareboost API SDK Class
 * 
 * @author generated
 * @author Yohann Nizon <ynizon@gmail.com>
 * DOC --> https://www.dareboost.com/fr/documentation-api
 * @version 2018-11-11 11:10
 */
class DareboostAPI extends DareboostBase
{

	/**
	Get available locations
	*/
	public function getAvailableLocations()
	{
		return $this->run(array("config"), array() );
	}
	
	/**
	Get available browsers for one location
	
	Name	Required	Type	Default	Description
	@param location	Yes	String	None	Name of the location eg.: "Paris", "Washington", ...
	*/
	public function getAvailableBrowsersForOneLocation($location)
	{
		return $this->run(array("config"), array("location"=>$location) );
	}
	
	/**
	Generate a PDF
		
	Name	Required	Type	Default	Description
	@param reportId	Yes	String	None	Unique identifier of the report you want to download
	@param useDefaultStyle	No	Boolean	true	Use the default style from Dareboost. Set to "false if you want to user your white-label.
	@param addTableOfContent	No	Boolean	false	Add a table of content at the beginning of the PDF. Set to "true" if you want one.
	@param showOverallMetrics	No	Boolean	true	Add metrics related to web performance. Set to "false" if you don't want them.
	@param showBestPractices	No	Boolean	true	Display tips and best practices on the PDF. Set to "false" if you don't want them.
	@param showTitleOnly	No	Boolean	true	Only display titles of tips. Set to "false" if you want the advice too. (Only available if you set showBestPractices to true)
	@param showIssueAndImprovementsOnly	No	Boolean	true	Only display the best practices that can be improved. Set to "false" if you want to display advice with a score of 100/100. (Only available if you set showBestPractices to true)
	*/
	public function generatePDF($reportId, $params = array())
	{
		return $this->run(array("pdf","launch"), $params );
	}
	
	/**
	Generate a PDF
	*/
	public function getPDF()
	{
		return $this->run(array("pdf","get"), array() );
	}
	
	/**
	Analyse a page
	
	Name	Required	Type	Default	Description
	@param url	Yes	String	None	URL to analyze
	@param lang	No	String	"en"	lang of the analysis ("en" or "fr")
	@param location	No	String	random	the location to be use. See Get available locations to retrieve available locations.
	@param browser.name	No	String	"Chrome"	the browser to be use. See Get available browsers to retrieve available browser for a locations.
	@param mobileAnalysis	No	Boolean	false	set to true if you want your page to be analyzed in a mobile context. This parameter is override if you define a "browser"
	@param isPrivate	No	Boolean	false	Set to true to restrict access to this report to you and accounts linked to yours
	@param visualMetrics	No	Boolean	false	Set to true if you want to have visual metrics ( start render, last visual change, speedindex). Be careful activate this option will cost you more than one credit.
	@param adblock	No	Boolean	false	Set to true to enable adblock plugin for your analyse (not available with Firefox browser)
	@param disableH2	No	Boolean	false	Set to true to disable HTTP/2 support on the browser
	@param downstream	No	Number	browser default value	downstream bandwidth max limitation
	@param upstream	No	Number	browser default value	upstream bandwidth max limitation
	@param latency	No	Number	browser default value	minimum network latency
	@param height	No	Number	browser default value	height of the screen
	@param width	No	Number	browser default value	width of the screen
	@param user	No	String	None	basic authentication user
	@param password	No	String	None	basic authentication password
	@param postData	No	List	None	list of data send with the first request
	@param headers	No	List	None	list of HTTP headers added on all HTTP request
	@param disableAnimation.script	No	Boolean	false	Set to true if you want to stop animation using setTimeout() or setInterval() functions (after onload event).
	@param disableAnimation.css	No	Boolean	false	Set to true if you want to disable CSS animation, transition and transform properties (after onload event).
	@param cookie	No	List	None	list of cookies added on HTTP request (depend on domain and path)
	@param blacklist	No	List	None	list of regexp to block matching request
	@param whitelist	No	List	None	list of regexp to allow only matching request
	@param dnsMapping	No	List	None	Allow to map a hostname to another one, or directly to an IP address (e.g. origin:"*.google-analytics.com", destination:"blackhole.com" or origin:"my-cdn.my-website.com", destination:"132.45.65.251"
	*/
	public function analysisLaunch($params = array())
	{
		return $this->run(array("analysis","launch"), $params );
	}
	
	/**
	Retrieve analysis result
	
	Name	Required	Type	Default	Description
	@param reportId	Yes	String	None	unique identifiant of the report, obtained when launch an analysis from the API.
	@param metricsOnly	No	Boolean	False	Set to true to get a report summary only, lighter (excluding advice, categories and detected technologies).
	@param getUniqueIDsForTips	No	Boolean	False	Set to true to get an ID for each element of report.tips
	*/
	public function getAnalysisReport($params = array())
	{
		return $this->run(array("analysis","report"), $params );
	}
	
	/**
	Retrieve HAR from an analysis
	
	Name	Required	Type	Default	Description
	@param reportId	Yes	String	None	unique identifiant of the report, obtained when launch an analysis from the API.
	*/
	public function getAnalysisHar($params = array())
	{
		return $this->run(array("analysis","har"), $params );
	}
	
	/**
	Get the list of monitorings
	
	Name	Required	Type	Default	Description
	@param name	No	String	None	a string pattern to filter your monitoring and return only those that contain the pattern in their name
	@param url	No	String	None	a string pattern to filter your monitoring and return only those that contains the pattern in their url
	*/
	public function getMonitoringsList($params = array())
	{
		return $this->run(array("monitoring","list"), $params );
	}
	
	/**
	Get the last report of the monitoring
		
	Name	Required	Type	Default	Description
	@param monitoringId	Yes	Number	None	the id of the monitoring
	@param metricsOnly	No	Boolean	False	Set to true to get a report summary only, lighter (excluding advice, categories and detected technologies).
	@param getUniqueIDsForTips	No	Boolean	False	Set to true to get an ID for each element of report.tips
	*/
	public function getMonitoringLastReport($params = array())
	{
		return $this->run(array("monitoring","last-report"), $params );
	}
	
	/**
	Get the reports of the monitoring
	
	Name	Required	Type	Default	Description
	@param monitoringId	Yes	Number	None	the id of the monitoring
	@param limit	No	Number	30	limit the number of reports to return (0 = no limit)
	@param lastDays	No	Number	None	Get report from the lasts X days; X being the value you give to this parameter.
	@param dateFrom	No	String	None	Retrieve audit executed after this date; standard formats based on ISO8601, which is yyyy-MM-ddTHH:mm:ssZZ, e.g. 2016-03-11T00:00:00.000+0100
	@param dateTo	No	String	None	Retrieve audit executed before this date; standard formats based on ISO8601, which is yyyy-MM-ddTHH:mm:ssZZ, e.g. 2016-03-11T00:00:00.000+0100
	@param error	No	Boolean	None	By default (no parameter), all results are returned. Specify "false" to retrieve only executions without error. Specify "true" to retrieve only executions with error.
	*/
	public function getMonitoringReports($params = array())
	{
		return $this->run(array("monitoring","reports"), $params );
	}
	
	/**
	Get the list of your scenarios (transactional analysis)
	
	Name	Required	Type	Default	Description
	@param name	No	String	None	a string pattern to filter your scenarios and return only those that contain the pattern in their name
	*/
	public function getScenarioList($params = array())
	{
		return $this->run(array("scenario","list"), $params );
	}
	
	/**
	Execute one of your scenario
		
	Name	Required	Type	Default	Description
	@param scenarioId	Yes	Number	None	the unique identifier of the scenario you want to execute
	*/
	public function scenarioLaunch($params = array())
	{
		return $this->run(array("scenario","launch"), $params );
	}
	
	/**
	Reports of a scenario	
	
	Name	Required	Type	Default	Description
	@param scenarioId	Yes	Number	None	the unique identifier of the scenario you want to execute
	@param limit	No	Number	30	limit the number of scenario reports to return (0 = no limit)
	@param lastDays	No	Number	None	Get report from the lasts X days; X being the value you give to this parameter.
	@param dateFrom	No	String	None	Retrieve scenario results executed after this date; standard formats based on ISO8601, which is yyyy-MM-ddTHH:mm:ssZZ, e.g. 2016-03-11T00:00:00.000+0100
	@param dateTo	No	String	None	Retrieve scenario results executed before this date; standard formats based on ISO8601, which is yyyy-MM-ddTHH:mm:ssZZ, e.g. 2016-03-11T00:00:00.000+0100
	@param error	No	Boolean	None	By default (no parameter), all results are returned. Specify "false" to retrieve only executions without error (status OK or CHECK_FAILED). Specify "true" to retrieve only executions with error (status different from OK and CHECK_FAILED).
	*/
	public function getScenarioReports($params = array())
	{
		return $this->run(array("scenario","reports"), $params );
	}
	
	/**
	Step report of a scenario
	
	Name	Required	Type	Default	Description
	@param stepId	Yes	String	None	unique identifier of the step result of a scenario
	*/
	public function getScenarioStepReport($params = array())
	{
		return $this->run(array("scenario","step","report"), $params );
	}
	
	/**
	Retrieve HAR from an analysis
		
	Name	Required	Type	Default	Description
	@param scenarioStepResultId	Yes	String	None	unique identifiant of the scenario step result, obtained when launch a scenario execution.
	*/
	public function getScenarioReportHar($params = array())
	{
		return $this->run(array("scenario","report","har"), $params );
	}
	
	/**
	Get a list of your events
	
	Name	Required	Type	Default	Description
	@param key	No	String	None	The event's key
	@param dateFrom	No	Date	None	Get events which start after begin; standard formats based on ISO8601, which is yyyy-MM-ddTHH:mm:ssZZ, e.g. 2016-03-11T00:00:00.000+0100
	@param monitoringId	No	String	None	Get events related to the monitoring identify by monitoringId.
	@param scenarioId	No	String	None	Get events related to the scenario identify by scenarioId.
	*/
	public function getEventList($params = array())
	{
		return $this->run(array("event","list"), $params );
	}
	
	/**
	Create a new event
	
	Name	Required	Type	Default	Description
	@param key	Yes	String	None	The event's key
	@param text	Yes	String	None	The events text
	@param date	Yes	String	None	The event's date; standard formats based on ISO8601, which is yyyy-MM-ddTHH:mm:ssZZ, e.g. 2016-03-11T00:00:00.000+0100
	@param monitorings	No	Array	None	A list of monitoring ids that you can retrieve with Get the list of monitorings.
	@param scenarios	No	Array	None	A list of scenarios ids that you can retrieve with Get the list of your scenarios.
	*/
	public function eventCreate($params = array())
	{
		return $this->run(array("event","create"), $params );
	}
	
	/**
	Delete an event
	
	Name	Required	Type	Default	Description
	@param key	Yes	String	None	The event's key
	*/
	public function eventDelete($params = array())
	{
		return $this->run(array("event","delete"), $params );
	}
}

?>