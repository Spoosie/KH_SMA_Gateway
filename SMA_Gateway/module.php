<?
class SMA_Gateway extends IPSModule
{
    var $moduleName = "SMA_Gateway";

    var $deviceParameter = array(

               array ("pattern" => "/Device Name: (.*)/", "result" => array(array("id" => 1 ,"parameter" => "Device Name","type" => 3))),
               array ("pattern" => "/Device Class: (.*)/", "result" => array(array("id" => 1 ,"parameter" => "Device Class","type" => 3))),
               array ("pattern" => "/Device Type: (.*)/", "result" => array(array("id" => 1 ,"parameter" => "Device Type","type" => 3))),
               array ("pattern" => "/Software Version: (.*)/", "result" => array(array("id" => 1 ,"parameter" => "Software Version","type" => 3))),
               array ("pattern" => "/Serial number: (.*)/", "result" => array(array("id" => 1 ,"parameter" => "Serial Number","type" => 3))),
               array ("pattern" => "/Device Status: (.*)/", "result" => array(array("id" => 1 ,"parameter" => "Device Status","type" => 3))),
               array ("pattern" => "/Device Temperature: (.*)°C/", "result" => array(array("id" => 1 ,"parameter" => "Device Temperature","profileSuffix" => "Temperature","type" => 2))),
               array ("pattern" => "/GridRelay Status: (.*)/", "result" => array(array("id" => 1 ,"parameter" => "GridRelay Status","type" => 3))),
               array ("pattern" => "/Pac max phase 1: (.*)W/", "result" => array(array("id" => 1 ,"parameter" => "Pac max phase 1","profileSuffix" => "PowerW","type" => 2))),
               array ("pattern" => "/Pac max phase 2: (.*)W/", "result" => array(array("id" => 1 ,"parameter" => "Pac max phase 2","profileSuffix" => "PowerW","type" => 2))),
               array ("pattern" => "/Pac max phase 3: (.*)W/", "result" => array(array("id" => 1 ,"parameter" => "Pac max phase 3","profileSuffix" => "PowerW","type" => 2))),

               array ("pattern" => "/EToday: (.*)kWh/", "result" => array(array("id" => 1 ,"parameter" => "Energy today","profileSuffix" => "Energy","type" => 2))),
               array ("pattern" => "/ETotal: (.*)kWh/", "result" => array(array("id" => 1 ,"parameter" => "Energy total","profileSuffix" => "Energy","type" => 2))),
               array ("pattern" => "/Operation Time: (.*)h/", "result" => array(array("id" => 1 ,"parameter" => "Operation Time","profileSuffix" => "Hours","type" => 2))),
               array ("pattern" => "/Feed-In Time: (.*)h/", "result" => array(array("id" => 1 ,"parameter" => "FeedIn Time","profileSuffix" => "Hours","type" => 2))),

               array ("pattern" => "/String 1 Pdc: (.*)kW - Udc: (.*)V - Idc: (.*)A/", "result" => array(array("id" => 1 ,"parameter" => "String 1 Power DC","profileSuffix" => "PowerkW","type" => 2),array("id" => 2 ,"parameter" => "String 1 Voltage DC","profileSuffix" => "Voltage","type" => 2),array("id" => 3 ,"parameter" => "String 1 Current DC","profileSuffix" => "Current","type" => 2))),
               array ("pattern" => "/String 2 Pdc: (.*)kW - Udc: (.*)V - Idc: (.*)A/", "result" => array(array("id" => 1 ,"parameter" => "String 2 Power DC","profileSuffix" => "PowerkW","type" => 2),array("id" => 2 ,"parameter" => "String 2 Voltage DC","profileSuffix" => "Voltage","type" => 2),array("id" => 3 ,"parameter" => "String 2 Current DC","profileSuffix" => "Current","type" => 2))),

               array ("pattern" => "/Phase 1 Pac : (.*)kW - Uac: (.*)V - Iac: (.*)A/", "result" => array(array("id" => 1 ,"parameter" => "Phase 1 Power AC","profileSuffix" => "PowerkW","type" => 2),array("id" => 2 ,"parameter" => "Phase 1 Voltage AC","profileSuffix" => "Voltage","type" => 2),array("id" => 3 ,"parameter" => "Phase 1 Current AC","profileSuffix" => "Current","type" => 2))),
               array ("pattern" => "/Phase 2 Pac : (.*)kW - Uac: (.*)V - Iac: (.*)A/", "result" => array(array("id" => 1 ,"parameter" => "Phase 2 Power AC","profileSuffix" => "PowerkW","type" => 2),array("id" => 2 ,"parameter" => "Phase 2 Voltage AC","profileSuffix" => "Voltage","type" => 2),array("id" => 3 ,"parameter" => "Phase 2 Current AC","profileSuffix" => "Current","type" => 2))),
               array ("pattern" => "/Phase 3 Pac : (.*)kW - Uac: (.*)V - Iac: (.*)A/", "result" => array(array("id" => 1 ,"parameter" => "Phase 3 Power AC","profileSuffix" => "PowerkW","type" => 2),array("id" => 2 ,"parameter" => "Phase 3 Voltage AC","profileSuffix" => "Voltage","type" => 2),array("id" => 3 ,"parameter" => "Phase 3 Current AC","profileSuffix" => "Current","type" => 2))),
               array ("pattern" => "/Total Pac   : (.*)kW/", "result" => array(array("id" => 1 ,"parameter" => "Total Power AC","profileSuffix" => "kW","type" => 2))),

               array ("pattern" => "/Grid Freq. : (.*)Hz/", "result" => array(array("id" => 1 ,"parameter" => "Grid Frequency","profileSuffix" => "Frequency","type" => 2))),

               array ("pattern" => "/Current Inverter Time: (.*)/", "result" => array(array("id" => 1 ,"parameter" => "Current Inverter Time","type" => 3))),
               array ("pattern" => "/Inverter Wake-Up Time: (.*)/", "result" => array(array("id" => 1 ,"parameter" => "Inverter WakeUp Time","type" => 3))),
               array ("pattern" => "/Inverter Sleep Time  : (.*)/", "result" => array(array("id" => 1 ,"parameter" => "Inverter Sleep Time","type" => 3))),

                );


    public function Create()
    {
        //Never delete this line!
        parent::Create();

        // --------------------------------------------------------
        // Config Variablen
        // --------------------------------------------------------
        $this->RegisterPropertyString("SolarLogPath", "http://127.0.0.1/solar.log");
        $this->RegisterPropertyBoolean("Debug", false);
        $this->RegisterPropertyInteger("UpdateIntervall", 10);

        // --------------------------------------------------------
        // Variablen Profile einrichten
        // --------------------------------------------------------
        if (!IPS_VariableProfileExists("SMA_PowerW"))
        {
            IPS_CreateVariableProfile("SMA_PowerW", 2);
            IPS_SetVariableProfileText("SMA_PowerW", "", " W");
        }

        if (!IPS_VariableProfileExists("SMA_PowerkW"))
        {
            IPS_CreateVariableProfile("SMA_PowerkW", 2);
            IPS_SetVariableProfileText("SMA_PowerkW", "", " kW");
        }

        if (!IPS_VariableProfileExists("SMA_Energy"))
        {
            IPS_CreateVariableProfile("SMA_Energy", 2);
            IPS_SetVariableProfileText("SMA_Energy", "", " kWh");
        }

        if (!IPS_VariableProfileExists("SMA_Hours"))
        {
            IPS_CreateVariableProfile("SMA_Hours", 2);
            IPS_SetVariableProfileText("SMA_Hours", "", " h");
        }

        if (!IPS_VariableProfileExists("SMA_Voltage"))
        {
            IPS_CreateVariableProfile("SMA_Voltage", 2);
            IPS_SetVariableProfileText("SMA_Voltage", "", " V");
        }

        if (!IPS_VariableProfileExists("SMA_Current"))
        {
            IPS_CreateVariableProfile("SMA_Current", 2);
            IPS_SetVariableProfileText("SMA_Current", "", " A");
        }

        if (!IPS_VariableProfileExists("SMA_Frequency"))
        {
            IPS_CreateVariableProfile("SMA_Frequency", 2);
            IPS_SetVariableProfileText("SMA_Frequency", "", " Hz");
        }

        if (!IPS_VariableProfileExists("SMA_Temperature"))
        {
            IPS_CreateVariableProfile("SMA_Temperature", 2);
            IPS_SetVariableProfileText("SMA_Temperature", "", " °C");
        }


        // --------------------------------------------------------
        // Timer installieren
        // --------------------------------------------------------
        $this->RegisterTimer("UpdateTimer", 0, 'SMAGateway_Update($_IPS[\'TARGET\']);');
    }


    public function Destroy()
    {
        $this->UnregisterTimer("UpdateTimer");

        //Never delete this line!
        parent::Destroy();
    }

    public function ApplyChanges()
    {
        //Never delete this line!
        parent::ApplyChanges();

        // --------------------------------------------------------
        // Timer starten
        // --------------------------------------------------------
        $this->SetTimerInterval("UpdateTimer", $this->ReadPropertyInteger("UpdateIntervall"));
    }

    public function getSolarLog()
    {
        $baseURL = $this->ReadPropertyString("SolarLogPath");
				
        IPS_LogMessage($this->moduleName,"Retrieving '".$baseURL."'");

        $solarLog = file_get_contents($baseURL);

		if ($solarLog == false)
		{
            IPS_LogMessage($this->moduleName,"Could not open '".$baseURL."'");
            return NULL;
		}

        // Leerzeilen entfernen
		$solarLog = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $solarLog);
		$solarLog = utf8_decode($solarLog);
        $logArray = explode("\n",$solarLog,-1);	// -1 => Letzten Umbruch nicht in Array wandeln
        $logArraySize = sizeof($logArray);
		

        if ($this->ReadPropertyBoolean("Debug"))
        {
            IPS_LogMessage($this->moduleName,print_r($logArray,true));
            IPS_LogMessage($this->moduleName,"Array size = ".$logArraySize);
			IPS_LogMessage($this->moduleName,"Last row=".$logArray[$logArraySize-1]);
        }

        // In letzter Zeile sollte sich ein
        // INFO: Done.
        // befinden
        if (strpos($logArray[$logArraySize-1], "INFO: Done.") === false)
        {
            IPS_LogMessage($this->moduleName,"'".$baseURL."' incomplete!");
            return NULL;
        }

        IPS_LogMessage($this->moduleName,"done!");
        return $logArray;
    }

    public function Update()
    {
        $solarLog = $this->getSolarLog();

        if ($solarLog == NULL)
            return;

		$baseURL = $this->ReadPropertyString("SolarLogPath");

        IPS_LogMessage($this->moduleName,"Updating devices from '".$baseURL."'");
        $sn = false;

        // Geräte auflisten
        foreach($solarLog as $solarLine)
        {
            // Aktuelles Device ermitteln
            preg_match('/SUSyID: (.*) - SN: (.*)/',$solarLine,$result);

            // SUSyID: xxx - SN: xxxxx gefunden
            if (!empty($result))
            {
                $sn = trim($result[2]);
                continue;
            }

            // So lange noch keine SN gesetzt ist, nächste Zeile
            if (!$sn)
                continue;

            // Verschiedene Parameter durchgehen
            foreach($this->deviceParameter as $parameterEntry)
            {
                preg_match($parameterEntry["pattern"],$solarLine,$result);

                if (!empty($result))
                {
                    $deviceCatID = $this->CreateCategory("Device (".$sn.")", "SMA".$sn,$this->InstanceID);

                    foreach($parameterEntry["result"] as $resultEntry)
                    {
                        $value = trim($result[$resultEntry["id"]]);
                        $ident =  "SMA".$sn.str_replace(" ","",$resultEntry["parameter"]);
                        if (isset($resultEntry["profileSuffix"]))
                            $profile = "SMA_".$resultEntry["profileSuffix"];
                        else
                            $profile = "";

                        $this->CreateVariable($resultEntry["parameter"], $resultEntry["type"], $value, $ident, $deviceCatID,$profile);
                    }

                    break;
                }
            }
        }

        IPS_LogMessage($this->moduleName,"done!");

    }




    protected function SetTimerInterval($Name, $Interval)
    {
        $id = @IPS_GetObjectIDByIdent($Name, $this->InstanceID);

        if ($id === false)
            throw new Exception('Timer not present', E_USER_WARNING);
        if (!IPS_EventExists($id))
            throw new Exception('Timer not present', E_USER_WARNING);

        $Event = IPS_GetEvent($id);

        if ($Interval < 1)
        {
            if ($Event['EventActive'])
                IPS_SetEventActive($id, false);
        }
        else
        {
            if ($Event['CyclicTimeValue'] <> $Interval)
                IPS_SetEventCyclic($id, 0, 0, 0, 0, 1, $Interval);
            if (!$Event['EventActive'])
                IPS_SetEventActive($id, true);
        }
    }

    private function CreateCategory( $Name, $Ident = '', $ParentID = 0 )
    {
        global $RootCategoryID;

        if ($this->ReadPropertyBoolean("Debug"))
            IPS_LogMessage($this->moduleName,"CreateCategory: ($Name,$Ident,$ParentID)");

        if ( '' != $Ident )
        {
            $CatID = @IPS_GetObjectIDByIdent( $Ident, $ParentID );
            if ( false !== $CatID )
            {
               $Obj = IPS_GetObject( $CatID );
               if ( 0 == $Obj['ObjectType'] ) // is category?
                  return $CatID;
            }
        }

        $CatID = IPS_CreateCategory();
        IPS_SetName( $CatID, $Name );
        IPS_SetIdent( $CatID, $Ident );

        if ( 0 == $ParentID )
            if ( IPS_ObjectExists( $RootCategoryID ) )
                $ParentID = $RootCategoryID;
        IPS_SetParent( $CatID, $ParentID );

        return $CatID;
    }

    private function SetVariable( $VarID, $Type, $Value )
    {
        switch( $Type )
        {
           case 0: // boolean
              SetValueBoolean( $VarID, $Value );
              break;
           case 1: // integer
              SetValueInteger( $VarID, $Value );
              break;
           case 2: // float
              SetValueFloat( $VarID, $Value );
              break;
           case 3: // string
              SetValueString( $VarID, $Value );
              break;
        }
    }

    private function CreateVariable( $Name, $Type, $Value, $Ident = '', $ParentID = 0 ,$Profil = "")
    {
        if ($this->ReadPropertyBoolean("Debug"))
            IPS_LogMessage($this->moduleName,"CreateVariable: ($Name,$Type,$Value,$Ident,$ParentID,$Profil)");

        if ( '' != $Ident )
        {
            $VarID = @IPS_GetObjectIDByIdent( $Ident, $ParentID );
            if ( false !== $VarID )
            {
               $this->SetVariable( $VarID, $Type, $Value );
               if ($Profil != "")
                    IPS_SetVariableCustomProfile($VarID,$Profil);
               return;
            }
        }
        $VarID = @IPS_GetObjectIDByName( $Name, $ParentID );
        if ( false !== $VarID ) // exists?
        {
           $Obj = IPS_GetObject( $VarID );
           if ( 2 == $Obj['ObjectType'] ) // is variable?
            {
               $Var = IPS_GetVariable( $VarID );
               if ( $Type == $Var['VariableValue']['ValueType'] )
                {
                   $this->SetVariable( $VarID, $Type, $Value );
                   if ($Profil != "")
                        IPS_SetVariableCustomProfile($VarID,$Profil);

                   return;
                }
            }
        }

        $VarID = IPS_CreateVariable( $Type );

        IPS_SetParent( $VarID, $ParentID );
        IPS_SetName( $VarID, $Name );

        if ( '' != $Ident )
           IPS_SetIdent( $VarID, $Ident );

        $this->SetVariable( $VarID, $Type, $Value );

        if ($Profil != "")
            IPS_SetVariableCustomProfile($VarID,$Profil);

    }

}
?>
