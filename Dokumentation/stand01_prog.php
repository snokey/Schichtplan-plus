<?php
/** Php Philip Schoof

*Kalender Arbeitszeiten eintragen und abrufen
*Ausrechnen des Gehaltes je nach Steuerklasse
*Profile verwalten
**/


class Calendar { 


  public function_construct(){
      $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    //

private $dayLabels = array("Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag","Sonntag");
     
    private $currentYear=0;
     
    private $currentMonth=0;
     
    private $currentDay=0;
     
    private $currentDate=null;
     
    private $daysInMonth=0;
     
    private $naviHref= null;

    //

    public function show() {
        $year  == null;
         
        $month == null;
		
		if(null==$year&&isset($_GET['year'])){
			$year = $_GET['year'];
		}else if(null==$year){
			$year
		}


