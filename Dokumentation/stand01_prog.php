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
        $year  = null;
         
        $month = null;
		/*
		* === Feedback Alpers, Dez 11 ===
		*
		* Arbeiten Sie bitte mit Einrückungen, damit erkennbar ist, welche Teile in welchem Bereich eingeordnet sind.	
		* Hier wirkt es beispielsweise, als wenn die Kontrollstruktur eine eigene Funktion wäre und nicht zu show() gehören würde.
		*
		* === Feedback Alpers, Ende ===
		*/
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
		
		/*
		* === Feedback Alpers, Dez 11 ===
		*
		* Lassen Sie bitte diesen Teil (und andere, in denen HTML enthalten ist)
		* von der HTML'erin der Gruppe überarbeiten: Es soll HTML 5 verwendet werden,
		* das hier ist leider nur 4.01.
		*
		* === Feedback Alpers, Ende ===
		*/
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
	
	
	
	/*
	* === Feedback Alpers, Dez 11 ===
	*
	* Diese Funktion ist (wie einige andere) ein gutes Beispiel dafür, warum
	* Kommentare im Quellcode wichtig sind: Es ist nicht auf anhieb erkennbar, was
	* diese Funktion tut, bzw. warum es sie gibt.
	*
	* Bitte ergänzen Sie in solchen Fällen einen kurzen Kommentar.
	*
	* === Feedback Alpers, Ende ===
	*/
	
	private function _showDay($cellNumber){
         
        if($this->currentDay==0){
             
            $firstDayOfTheWeek = date('N',strtotime($this->currentYear.'-'.$this->currentMonth.'-01'));
                     
            if(intval($cellNumber) == intval($firstDayOfTheWeek)){
                 
                $this->currentDay=1;
                 
            }
        }
         
        if( ($this->currentDay!=0)&&($this->currentDay<=$this->daysInMonth) ){
             
            $this->currentDate = date('Y-m-d',strtotime($this->currentYear.'-'.$this->currentMonth.'-'.($this->currentDay)));
             
            $cellContent = $this->currentDay;
             
            $this->currentDay++;   
             
        }else{
             
            $this->currentDate =null;
 
            $cellContent=null;
        }
             
         
        return '<li id="li-'.$this->currentDate.'" class="'.($cellNumber%7==1?' start ':($cellNumber%7==0?' end ':' ')).
                ($cellContent==null?'mask':'').'">'.$cellContent.'</li>';
    }
	
	
	private function _createNavi(){
         
        $nextMonth = $this->currentMonth==12?1:intval($this->currentMonth)+1;
         
        $nextYear = $this->currentMonth==12?intval($this->currentYear)+1:$this->currentYear;
         
        $preMonth = $this->currentMonth==1?12:intval($this->currentMonth)-1;
         
        $preYear = $this->currentMonth==1?intval($this->currentYear)-1:$this->currentYear;
         
        return
            '<div class="header">'.
                '<a class="prev" href="'.$this->naviHref.'?month='.sprintf('%02d',$preMonth).'&year='.$preYear.'">Prev</a>'.
                    '<span class="title">'.date('Y M',strtotime($this->currentYear.'-'.$this->currentMonth.'-1')).'</span>'.
                '<a class="next" href="'.$this->naviHref.'?month='.sprintf("%02d", $nextMonth).'&year='.$nextYear.'">Next</a>'.
            '</div>';
    }

	private function _createLabels(){  
                 
        $content='';
         
        foreach($this->dayLabels as $index=>$label){
             
            $content.='<li class="'.($label==6?'end title':'start title').' title">'.$label.'</li>';
 
        }
         
        return $content;
    }



private function _weeksInMonth($month=null,$year=null){
         
        if( null==($year) ) {
            $year =  date("Y",time()); 
        }
         
        if(null==($month)) {
            $month = date("m",time());
        }
         
        
        $daysInMonths = $this->_daysInMonth($month,$year);
         
        $numOfweeks = ($daysInMonths%7==0?0:1) + intval($daysInMonths/7);
         
        $monthEndingDay= date('N',strtotime($year.'-'.$month.'-'.$daysInMonths));
         
        $monthStartDay = date('N',strtotime($year.'-'.$month.'-01'));
         
        if($monthEndingDay<$monthStartDay){
             
            $numOfweeks++;
         
        }
         
        return $numOfweeks;
    }

	private function _daysInMonth($month=null,$year=null){
         
        if(null==($year))
            $year =  date("Y",time()); 
 
        if(null==($month))
            $month = date("m",time());
             
        return date('t',strtotime($year.'-'.$month.'-01'));
    }
     
}


?>

<!--
=== Feedback Alpers, Dez 11 ===

Auch für Sie der Hinweis: Eine Dokumentation sollte (außer wenn das unumgänglich ist, um effizient auf einen Sachverhalt zu verweisen)
ausschließlich dazu genutzt werden, um zu beschreiben, auf welchem Stand sich das Projekt gerade befindet.

Für einen nicht am Projekt beteiligten muss durch die Dokumentation schnell erkennbar sein, welche Entwicklung das
Projekt genommen hat, wo die einzelnen Programmteile stehen und warum welche Entscheidungen getroffen wurden.

Das ist hier leider gar nicht der Fall.

Leider kann ich momentan (das gilt für das gesamte Projekt, nicht nur Ihren Anteil) noch keine Interaktivität für Nutzer erkennen.

=== Feedback Alpers, Ende ===