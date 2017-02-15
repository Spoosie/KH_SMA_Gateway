<?
class SMA_Gateway extends IPSModule
{
	$moduleName = "SMA_Gateway";
//    var $ch;
	var $baseURL;
	var $debug;
	
    public function Create()
    {
        //Never delete this line!
        parent::Create();
        
        //These lines are parsed on Symcon Startup or Instance creation
        //You cannot use variables here. Just static values.
        $this->RegisterPropertyString("Solar Log Path", "https://127.0.0.1/solar.log");
        $this->RegisterPropertyBoolean("Debug", false);
       
    }
    
    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();

        $this->baseURL = $this->ReadPropertyString("Solar Log Path");
        $this->debug = $this->ReadPropertyString("Debug");

		$getLogScript = file_get_contents(__DIR__ . "/parseSolarLog.php");
		$scriptID = $this->RegisterScript("parseSolarLog", "parseSolarLog", $getLogScript);
		IPS_SetScriptTimer($scriptID, 60); 
	}
    
	public function getSolarLog()
	{
		$solarLog = file_get_contents($this->baseURL);

		$logArray = explode("\n",$solarLog);
		$logArraySize = sizeof($logArray);
		
		if ($debug)
		{
			IPS_LogMessage($this->moduleName,print_r($logArray);
			IPS_LogMessage($this->moduleName,"Array size =".$logArraySize);
		}

		// In letzter Zeile sollte sich ein 
		// INFO: Done.
		// befinden
		if (strpos($logArray[$logArraySize-1], "INFO: Done.") !== false)
		{
			IPS_LogMessage($this->moduleName,"Solar.log fehlerhaft");
			return NULL;
		}

		return $logArray;
	}

}
?>
