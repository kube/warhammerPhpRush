<?php

$tab = array();



for ($i = 0; $i < 100; $i++)
{
	for ($j = 0; $j < 150; $j++)
	{
		if (($j > 50 && $j < 100) || ($i > 25 && $i < 75))
		{
			$tmp = rand(0, 900);
			if ($tmp == 1)
				$tab[$i][$j] = 2;
			else
				$tab[$i][$j] = 0;
		}
		else
			$tab[$i][$j] = 0;
	}
}

for ($i = 0; $i < 100; $i++)
{
    for ($j = 0; $j < 150; $j++)
    {
		if ($tab[$i][$j] == 2)
		{
			$tab[$i][$j] = 1;
			$in = $i;
			$jn = $j;
			$rand = rand(50, 60);
			for ($y = 0; $y < $rand; $y++)
			{
				if (rand(0, 1) == 1)
				{
					if (rand(0, 1) == 1)
						$in++;
					else
						$jn++;
				}
				else
				{
					if (rand(0, 1) == 1)
						$in--;
					else
						$jn--;
				}
				if (($jn > 50 && $jn < 100) || ($in > 25 && $in < 75))
				{
					if (($jn > 0 && $jn < 150) && ($in > 0 && $in < 100)) 
						$tab[$in][$jn] = 1;
				}
			}
		}
    }
}

foreach ($tab as $elem)
{
	foreach ($elem as $value)
	{
		echo $value;
	}
	echo "\n";
}
?>