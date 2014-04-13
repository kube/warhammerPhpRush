
function	initializeGame()
{
	addKeyListener();
}

function	getShipById(id)
{
	return game["player"+game.currentPlayer].ships[id];
}

function	getSelectedShip()
{
	return getShipById(game.selectedShip);
}

function	getShipLimits(ship)
{
	width = ship.width;
	height = ship.height;

	if (ship.direction % 2)
		width = [height, height = width][0]; // Swap
	limits = new Array();
	limits.x0 = parseInt(ship.position.x - width / 2);
	limits.x1 = parseInt(ship.position.x + width / 2);
	limits.y0 = parseInt(ship.position.y - height / 2);
	limits.y1 = parseInt(ship.position.y + height / 2);
	return(limits);
}

function	displayShip(ship, shipNumber, player)
{
	var limits = getShipLimits(ship);

	for (var j = limits.y0; j < limits.y1; j++)
	{
		for (var i = limits.x0; i < limits.x1; i++)
		{
			if (game.selectedShip && game.selectedShip == shipNumber
				&& game.currentPlayer == player)
			{
				var el		= $("#sq_x"+i+"y"+j);
				var newone	= el.clone(true);
				el.before(newone);
				el.remove();
				$("#sq_x"+i+"y"+j).addClass("selected");
			}
			$("#sq_x"+i+"y"+j)
				.addClass("ship player" + player)
				.click(function()
					{
						selectShip(ship, shipNumber, player);
					});
		}
	}
}

function	refreshMap()
{
	if (game)
	{
		if (game.currentPlayer == 2)
		{	
			$("#board").removeClass("reverse");
			$("#playerTurn").text("Player 2")
				.removeClass()
				.addClass("p2");
		}
		else
		{
			$("#board").addClass("reverse");
			$("#playerTurn").text("Player 1")
				.removeClass()
				.addClass("p1");
		}
		$(".boardSquare").removeClass("ship player1 player2 selected").unbind("click");
		for (var i in game.board.grid)
		{
			for (var j in game.board.grid[i])
			{
				if (game.board.grid[i][j])
					$("#sq_x"+j+"y"+i)
						.addClass("obstacle");
			}
		}
		for (var i in game.player1.ships)
			displayShip(game.player1.ships[i], i, 1);
		for (var i in game.player2.ships)
			displayShip(game.player2.ships[i], i, 2);
	}
}
