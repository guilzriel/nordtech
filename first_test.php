<?php
$myArray = [
    [1, 'a'],
    [15, 'b'],
    [4, 'c'],
    [8, 'd'],
    [12, 'e'],
    [22, 'f'],
];
function s($array)
{
    for ($i=0;$i<sizeof($array)-1;$i++)
    {
        for ($j=$i+1;$j<sizeof($array);$j++)
        {
            if ($array[$j][0] < $array[$i][0])
            {
                for ($k=0;$k<2;$k++)
                {
                    $a[$k] = $array[$i][$k];
                    $array[$i][$k] = $array[$j][$k];
                    $array[$j][$k] = $a[$k];
                }
            }
        }
    }
    return $array;
}


function s2($array){

    $tmpArray = array();
    //create array to be easily sortable
    foreach ($array as $value)
    {
        $tmpArray[ $value[0] ] = $value[1];

    }
    //sort ascending by key
    ksort($tmpArray);

    //recreate old array
    foreach ($tmpArray as $key => $value)
    {

        $newArray[] = array($key,$value);
    }
    return $newArray;
}


var_dump(s($myArray));
var_dump( s2($myArray) );
?>