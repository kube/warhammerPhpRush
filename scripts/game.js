
function 	rotateWidth(width, height, direction)
{
	if (direction == 1)
		return (height);
	else if (direction == 2)
		return (width);
	else if (direction == 3)
		return (height);
	else
		return (width);
}

function 	rotateHeight(height, width, direction)
{
	if (direction == 1)
		return (width);
	else if (direction == 2)
		return (height);
	else if (direction == 3)
		return (width);
	else
		return (height);
}

function	displayShip(ship, player)
{
	var width = rotateWidth(ship.width, ship.height, ship.direction);
	var height = rotateHeight(ship.height, ship.width, ship.direction);

	for (var j = parseInt(ship.position.y - height / 2);
			j < parseInt(ship.position.y + height / 2);
			j++)
	{
		for (var i = parseInt(ship.position.x - width / 2);
				i < parseInt(ship.position.x + width / 2);
				i++)
			$("#sq_x"+i+"y"+j).addClass("ship player" + player);
	}
}

function	refreshMap()
{
	if (game)
	{
		$(".boardSquare").removeClass("ship player1 player2");
		// for (var i in game.board.grid)
		// {
		// 	for (var j in game.board.grid[i])
		// 	{
		// 		game.board.grid[i][j]
		// 		$("#sq_x"+i+"y"+j).
		// 	}
		// }
		for (var i in game.player1.ships)
			displayShip(game.player1.ships[i], 1);
		for (var i in game.player2.ships)
			displayShip(game.player2.ships[i], 2);
	}
}