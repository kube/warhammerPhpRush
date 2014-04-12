
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

function	selectShip(ship, shipNumber, player)
{
	game.selectedShip = shipNumber;
	console.log(ship, shipNumber);
	refreshMap();
}

function	displayShip(ship, shipNumber, player)
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
		{
			$("#sq_x"+i+"y"+j)
				.addClass("ship player" + player)
				.click(function()
					{
						selectShip(ship, shipNumber, player);
					});
			if (game.selectedShip && game.selectedShip == shipNumber
				&& game.currentPlayer == player)
			{
				$("#sq_x"+i+"y"+j).addClass("selected");
			}
		}
	}
}

function		rotateShipLeft(ship)
{
	ship.direction = ship.direction + 1;
	ship.direction %= 4;
}

function		rotateShipRight(ship)
{
	ship.direction += 4;
	ship.direction --;
	ship.direction %= 4;
}

function		moveShipUp(ship, nb)
{
	if (ship.direction == 3)
		ship.position.x = ship.position.x + nb;
	else if (ship.direction == 0)
		ship.position.y = ship.position.y - nb;
	else if (ship.direction == 1)
		ship.position.x = ship.position.x - nb;
	else if (ship.direction == 2)
		ship.position.y = ship.position.y + nb;
	ship.move --;
}

function	refreshMap()
{
	if (game)
	{
		$(".boardSquare").removeClass("ship player1 player2 selected");
		// for (var i in game.board.grid)
		// {
		// 	for (var j in game.board.grid[i])
		// 	{
		// 		if (game.board.grid[i][j] == 1)
					
		// 	}
		// }
		for (var i in game.player1.ships)
			displayShip(game.player1.ships[i], i, 1);
		for (var i in game.player2.ships)
			displayShip(game.player2.ships[i], i, 2);
	}
}