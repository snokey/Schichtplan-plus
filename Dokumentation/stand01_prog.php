<?php
/** Php Philip Schoof

*Kalender erstellen in dem man dann Arbeitszeiten eintragen und abrufen kann
*Ausrechnen des Gehaltes je nach Steuerklasse
*Profile verwalten
**/


class Calendar { 


  public function_construct(){
      $this->naviHref = htmlentities($_SERVER['PHP_SELF']);
    }

    // Der Kalender

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
		
		        
         
        if(null==$month&&isset($_GET['month'])){
 
            $month = $_GET['month'];
         
        }else if(null==$month){
 
            $month = date("m",time());
         
        }        

		  $this->currentYear=$year;
         
        $this->currentMonth=$month;
         
        $this->daysInMonth=$this->_daysInMonth($month,$year);


