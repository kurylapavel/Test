<?php
    $names = ["silver","gold","violet","lime","blue"];
    for($j=0;$j<5;$j++){
        $colors = array(); 
        shuffle($names);
        for($i=0;$i<5;$i++){
            do{
                $randColor = array_rand($names,1);
            }
            while($names[$i]==$names[$randColor]); 
                array_push($colors,$names[$randColor]);
        }

        $text =<<<TEXT
        <span style="color: $colors[0]">$names[0]  
        <span style="color: $colors[1]">$names[1]  
        <span style="color: $colors[2]">$names[2]  
        <span style="color: $colors[3]">$names[3]  
        <span style="color: $colors[4]">$names[4]  
        </br>
TEXT;
        echo $text;
    }
?>