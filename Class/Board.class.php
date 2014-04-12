<?php
include '../generate.php';
class Board
{
	public				$width;
	public				$height;
	public				$grid;

	public function		__construct($width, $height)
	{
		$this->width = intval($width);
		$this->height = intval($height);
		$this->grid = generateMap($height, $width);
	}

	public function		__gridToJSON()
	{
		$string = "[";
		foreach ($this->grid as $j => $line)
		{
			$string .= "[";
			foreach ($line as $i => $square)
			{
				$string .= $square;
				if ($i < $this->width - 1)
					$string .= ",";
			}
			$string .= "]";
			if ($j < $this->height - 1)
				$string .= ",";
		}
		$string .= "]";
		return $string;
	}

	public function		__toString()
	{
		return "{\n"
			."\t\"width\": ".$this->width.","
			."\t\"height\": ".$this->height.","
			."\t\"grid\":\n".$this->__gridToJSON()."\n"
			."}\n";
	}
}

?>
