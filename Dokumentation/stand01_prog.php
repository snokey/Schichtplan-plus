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
		
		$content='<div id="calendar">'.
                        '<div class="box">'.
                        $this->_createNavi().
                        '</div>'.
                        '<div class="box-content">'.
                                '<ul class="label">'.$this->_createLabels().'</ul>';   
                                $content.='<div class="clear"></div>';     
                                $content.='<ul class="dates">';    
                                 
                                $weeksInMonth = $this->_weeksInMonth($month,$year);
                                // wochen im monat
                                for( $i=0; $i<$weeksInMonth; $i++ ){
                                     
                                    //Tage in der Woche
                                    for($j=1;$j<=7;$j++){
                                        $content.=$this->_showDay($i*7+$j);
                                    }
                                }
                                 
                                $content.='</ul>';
                                 
                                $content.='<div class="clear"></div>';     
             
                        $content.='</div>';
                 
        $content.='</div>';
        return $content;   
    }



