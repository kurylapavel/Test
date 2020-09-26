<?php
    require_once './scripts/connect.php';

    $sql ="SELECT * FROM `persons` WHERE 1";

    ////////// 1
    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
            echo <<<ROW
            <tr>
                <td>$row[fullname] - </td>
                <td>$row[money]</td>
                <br/>
            </tr>
ROW;
        }
        
    }else{
        echo "error";
    }

    /////////// 2
    echo '<br/>';

    $sql ="SELECT p.city_id from persons p inner join transactions t where p.id = t.from_person_id or p.id = t.to_person_id";
    $citiesIdArray = array();
    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
            array_push($citiesIdArray,$row['city_id']);
        }    
    }else{
        echo "error";
    }


    $tmp = array_count_values($citiesIdArray);

    $max = max($tmp);

    $city_id = array_search($max,$tmp);

    $sql = "SELECT c.name from cities c where c.id =$city_id";

    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
            echo $row['name'], '<br/>'; 
        }    
    }else{
        echo "error";
    }

    ////////// 3
    echo '<br/>';

    $sql = 'SELECT t.transaction_id from transactions t 
    where (select city_id from persons where t.from_person_id = id ) = (select city_id from persons where t.to_person_id = id )';

    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
            $transactionsId=$row['transaction_id'];
        }    
    }else{
        echo "error";
    }

    $sql = "SELECT * from transactions where transaction_id = $transactionsId";

    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
            echo <<<ROW
            <tr>
                <td>transaction id - $row[transaction_id], </td>
                <td>from person id - $row[from_person_id],</td>
                <td>to person id - $row[to_person_id], </td>
                <td>amount - $row[amount]</td>
                <br/>
            </tr>
ROW;
        }    
    }else{
        echo "error";
    }
    mysqli_close($conn);
?>