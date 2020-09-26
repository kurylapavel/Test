<?php
    $integers = array();
 
    $argv = filter_var_array($argv,FILTER_VALIDATE_INT);
     
    echo '<br/>';
    for($i=1;$i<count($argv)-1;$i++){
        if(!empty($argv[$i]) || $argv[$i] === 0){
            array_push($integers,$argv[$i]);
        }
    }

    $integers = array_unique($integers);
    
    $arrayCount = count($integers);
    for($j=0;$j<$arrayCount;$j++){
        for($i=0;$i<count($integers)-1;$i++){
            if($integers[$i]>$integers[$i+1]){
                $toReplace = $integers[$i];
                $integers[$i] = $integers[$i+1];
                $integers[$i+1] = $toReplace;
            }
        }
        $arrayCount--;
    }

    print_r($integers);


?>