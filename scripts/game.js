
function	getShipLimits(ship, rotate)
{
	width = ship.width;
	height = ship.height;

	if (ship.direction % 2 ^ rotate)
		width = [height, height = width][0]; // Swap
	limits = new Array();
	limits.x0 = parseInt(ship.position.x - width / 2);
	limits.x1 = parseInt(ship.position.x + width / 2);
	limits.y0 = parseInt(ship.position.y - height / 2);
	limits.y1 = parseInt(ship.position.y + height / 2);
	return(limits);
}

function	selectShip(ship, shipNumber, player)
{
	game.selectedShip = shipNumber;
	console.log(ship, shipNumber);
	refreshMap();
}

function	displayShip(ship, shipNumber, player)
{
	var limits = getShipLimits(ship);

	for (var j = limits.y0; j < limits.y1; j++)
	{
		for (var i = limits.x0; i < limits.x1; i++)
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
	if (ship.direction == 0)
		ship.position.y = ship.position.y + nb;
	else if (ship.direction == 1)
		ship.position.x = ship.position.x + nb;
	else if (ship.direction == 2)
		ship.position.y = ship.position.y - nb;
	else if (ship.direction == 3)
		ship.position.x = ship.position.x - nb;
	ship.move --;
}

function	initializeGame()
{
	document.addEventListener("keydown", function(e)
	{
		console.log(e.keyCode);

		switch (e.keyCode)
		{
			case 46:
				if (e.ctrlKey)
					window.location = "reset";
				break;

			case 32:
				if (e.ctrlKey)
					$.ajax({
						type: 'GET',
						url: 'ajax/refresh',
						success: function(output, status, xhr)
						{
							console.log(output);
							game = JSON.parse(output);
							refreshMap();
						}
					});
				break;

			case 38:
				moveShipUp(game['player'+game.currentPlayer].ships[game.selectedShip], 1);
				refreshMap();
				e.preventDefault();
				break;

			case 37:
				rotateShipLeft(game['player'+game.currentPlayer].ships[game.selectedShip]);
				refreshMap();
				e.preventDefault();
				break;

			case 39:
				rotateShipRight(game['player'+game.currentPlayer].ships[game.selectedShip]);
				refreshMap();
				e.preventDefault();
				break;
		}

	});
}

function	refreshMap()
{
	if (game)
	{
		$(".boardSquare").removeClass("ship player1 player2 selected").unbind("click");
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