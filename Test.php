<?php
function sortArray($mainArray)
{
$count=count($mainArray);
for($i=0;$i<$count;$i++)
{
    $index=$i;
	$number=$mainArray[$i];
    $flag=false;
	for($j=0;$j<$count;$j++)
	{
	    if($index!=$j)
		{
		   if($number==$mainArray[$j])
		   {
		      $flag=true;
		   }
		}
	}
	
	if($flag==false)
	{
		echo $number;
	}
	
}
}
?>