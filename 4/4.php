<body>
    <form method = "post">
        <input type="text" name="team" placeholder="Команда"><br>
        <input type="submit" value="Поиск" name="find"><br>
    </form>    
</body>

<?php
    function mb_ucfirst($str) {
        $str = mb_strtoupper(mb_substr($str, 0, 1, 'UTF-8'), 'UTF-8').mb_strtolower(mb_substr($str, 1, mb_strlen($str), 'UTF-8'), 'UTF-8');
        return $str;
    }

    if(isset($_POST['find'])){
        include('domParser.php');

        $footballTeam = mb_ucfirst($_POST['team']);

        $link = 'https://terrikon.com/football/italy/championship/table';

        $year1 = 2020;
        $year2 = 21;

        for($j=0;$j<12;$j++){

            $html = file_get_html($link); 

            $list = $html->find('div[class="tab"]',0);

            $trArray = $list->find('tr');

            $teamPosition = array();

            for($i=1;$i<21;$i++){
                $listArray = $trArray[$i]->find('td');
                if($listArray[1]->plaintext == $footballTeam){
                    array_push($teamPosition,$listArray[0]);
                    echo "Сезон $year1-$year2 - команда $footballTeam заняла сесто № ";
                    echo $listArray[0];
                    echo '<br/>';
                    $year1--;
                    $year2--;
                    break; 
                }   
            }

          if(empty($teamPosition)){
                echo "Сезон $year1-$year2 - команда $footballTeam либо не принемала участия, либо не вошла в топ 20!";
                echo '<br/>';
                $year1--;
                $year2--;
            }
            $link = "https://terrikon.com/football/italy/championship/$year1-$year2/table";

        }

    }
    


?>