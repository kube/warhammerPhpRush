<?php

function	generateMap($height, $width){

	$tab = array();
	for ($i = 0; $i < $height; $i++)
	{
		for ($j = 0; $j < $width; $j++)
		{
			if (($j > ($width / 3) && $j < ($width / 3 * 2) || ($i > ($height / 3) && $i < ($height / 3 * 2))))
			{
				$tmp = rand(0, 800);
				if ($tmp == 1)
					$tab[$i][$j] = 2;
				else
					$tab[$i][$j] = 0;
			}
			else
				$tab[$i][$j] = 0;
		}
	}
	for ($i = 0; $i < $height; $i++)
	{
		for ($j = 0; $j < $width; $j++)
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
					if (($jn > ($width / 3) && $jn < ($width / 3 * 2)) || ($in > ($height / 3) && $in < ($height / 3 * 2)))
					{
						if (($jn > 0 && $jn < $width) && ($in > 0 && $in < $height)) 
							$tab[$in][$jn] = 1;
					}
				}
			}
		}
	}
	return ($tab);
}
?>