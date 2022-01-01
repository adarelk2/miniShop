<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Const/time.php';
    class TimeAgo
    {
        function __construct($oldTime) //the base time that you want to calculate the diff from
        {
//             $this->calculator = time("Y-m-d H:i:s") - strtotime($oldTime);
            $this->calculator = time() - strtotime($oldTime);
            return $this;
        }
        
        public static function convertDateAndTime($_date,$_Type = "full")
        {
            if($_Type == "full"){
                return date("H:i d/m/Y",strtotime($_date));
            }elseif($_Type == "date"){
                return date("d/m/Y",strtotime($_date));
            }elseif($_Type == "hour"){
                return date("H:i:s",strtotime($_date));
            }
            
        }

        function regular() //deducting the current time from the old time and return how long ago was it.
        {
            $message = "";
             if ($this->calculator >= ONE_YEAR) 
            {
                $message =  "לפני ".intval($this->calculator/ONE_YEAR). " שנים";
            }
            else if ($this->calculator >= ONE_MONTH) 
            {
                $message =  "לפני ".intval($this->calculator/ONE_MONTH). " חודשים";
            }
             else if ($this->calculator >= ONE_WEEK) 
            {
                $message =  "לפני ".intval($this->calculator/ONE_WEEK). " שבועות";
            }
            else if ($this->calculator >= ONE_DAY) 
            {
                $message =  "לפני ".intval($this->calculator/ONE_DAY). " ימים";
            }
             else if ($this->calculator >= ONE_HOUR) 
            {
                $message =  "לפני ".intval($this->calculator/ONE_HOUR). " שעות";
            }
            else if ($this->calculator >= TWO_MIN) 
            {
                $message =  "לפני ".intval($this->calculator/ONE_MIN). " דקות";
            }
           else if ($this->calculator >= ONE_MIN) 
            {
                $message =  "לפני ".intval($this->calculator/ONE_MIN) . " דקות";
            }
            else if ($this->calculator < ONE_MIN) 
            {
                $message =  "לפני ".intval($this->calculator) . " שניות";
            }
            return $message;
        }

    }
?>