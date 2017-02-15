<?
IPS_LogMessage(SMA_Gateway->moduleName,"TEST");
die();


	$phase1_global = explode(" ",$logArray[100]);
	$eTotal_global = explode(" ",$logArray[71]);
	$operationTimer_global = explode(" ",$logArray[72]);
	$feedInTime_global = explode(" ",$logArray[73]);

	$phase1_zelle1 = explode(" ",$logArray[106]);
	$eTotal_zelle1 = explode(" ",$logArray[77]);
	$operationTimer_zelle1 = explode(" ",$logArray[78]);
	$feedInTime_zelle1 = explode(" ",$logArray[79]);

	$phase1_zelle2 = explode(" ",$logArray[112]);
	$eTotal_zelle2 = explode(" ",$logArray[83]);
	$operationTimer_zelle2 = explode(" ",$logArray[84]);
	$feedInTime_zelle2 = explode(" ",$logArray[85]);



	// Rumrechnen
	$leistung_global = floatval(str_replace("kW","",$phase1_global[6]))*1000;
	$ertrag_global = floatval(str_replace("kWh","",$eTotal_global[1]));
	$betriebsstunden_global = floatval(str_replace("h","",$operationTimer_global[2]));
	$einspeisezeit_global = floatval(str_replace("h","",$feedInTime_global[4]));

	$leistung_zelle1 = floatval(str_replace("kW","",$phase1_zelle1[6]))*1000;
	$ertrag_zelle1 = floatval(str_replace("kWh","",$eTotal_zelle1[1]));
	$betriebsstunden_zelle1 = floatval(str_replace("h","",$operationTimer_zelle1[2]));
	$einspeisezeit_zelle1 = floatval(str_replace("h","",$feedInTime_zelle1[4]));

	$leistung_zelle2 = floatval(str_replace("kW","",$phase1_zelle2[6]))*1000;
	$ertrag_zelle2 = floatval(str_replace("kWh","",$eTotal_zelle2[1]));
	$betriebsstunden_zelle2 = floatval(str_replace("h","",$operationTimer_zelle2[2]));
	$einspeisezeit_zelle2 = floatval(str_replace("h","",$feedInTime_zelle2[4]));



	// In Variablen schreiben
	if ($ertrag_global > 0)
		SetValueFloat(54688 /*[PV Anlage\Daten\Gesamt\Ertrag]*/ ,$ertrag_global); // [PV Anlage\Daten\Gesamt\Ertrag]

	SetValueFloat(11160 /*[PV Anlage\Daten\Gesamt\Aktuelle Leistung]*/ ,$leistung_global); // [PV Anlage\Daten\Gesamt\Aktuelle Leistung]
	SetValueFloat(33316 /*[PV Anlage\Daten\Gesamt\Betriebsstunden]*/ , $betriebsstunden_global); // [PV Anlage\Daten\Gesamt\Betriebsstunden]
	SetValueFloat(40474 /*[PV Anlage\Daten\Gesamt\Einspeisezeit]*/ , $einspeisezeit_global); // [PV Anlage\Daten\Gesamt\Einspeisezeit]

	
	if ($ertrag_zelle1 > 0)
		SetValueFloat(45201 /*[PV Anlage\Daten\Zelle 1\Ertrag]*/ ,$ertrag_zelle1);  // [PV Anlage\Daten\Zelle 1\Ertrag]

	SetValueFloat(30616 /*[PV Anlage\Daten\Zelle 1\Aktuelle Leistung]*/ ,$leistung_zelle1); // [PV Anlage\Daten\Zelle 1\Aktuelle Leistung]
	SetValueFloat(42661 /*[PV Anlage\Daten\Zelle 1\Betriebsstunden]*/ , $betriebsstunden_zelle1);  // [PV Anlage\Daten\Zelle 1\Betriebsstunden]
	SetValueFloat(20173 /*[PV Anlage\Daten\Zelle 1\Einspeisezeit]*/ , $einspeisezeit_zelle1); // [PV Anlage\Daten\Zelle 1\Einspeisezeit]

	if ($ertrag_zelle2 > 0)
		SetValueFloat(38567 /*[PV Anlage\Daten\Zelle 2\Ertrag]*/ ,$ertrag_zelle2); // [PV Anlage\Daten\Zelle 2\Ertrag]

	SetValueFloat(33919 /*[PV Anlage\Daten\Zelle 2\Aktuelle Leistung]*/ ,$leistung_zelle2); // [PV Anlage\Daten\Zelle 2\Aktuelle Leistung]
	SetValueFloat(18179 /*[PV Anlage\Daten\Zelle 2\Betriebsstunden]*/ , $betriebsstunden_zelle2); // [PV Anlage\Daten\Zelle 2\Betriebsstunden]
	SetValueFloat(19422 /*[PV Anlage\Daten\Zelle 2\Einspeisezeit]*/ , $einspeisezeit_zelle2); // [PV Anlage\Daten\Zelle 2\Einspeisezeit]


	
	IPS_LogMessage("PV Anlage","ErtragGlobal=".$ertrag_global." kWh / LeistungGlobal=".$leistung_global." W / BetriebsstundenGlobal=".$betriebsstunden_global." Std");
	IPS_LogMessage("PV Anlage","ErtragZ1=".$ertrag_zelle1." kWh / LeistungZ1=".$leistung_zelle1." W / BetriebsstundenZ1=".$betriebsstunden_zelle1." Std");
	IPS_LogMessage("PV Anlage","ErtragZ2=".$ertrag_zelle2." kWh / LeistungZ2=".$leistung_zelle2." W / BetriebsstundenZ2=".$betriebsstunden_zelle2." Std");
