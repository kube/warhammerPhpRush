
function	initializeGame()
{
	addKeyListener();

	// Add Refresh Loop
	setInterval(function()
		{
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
		}, 1000);
}

function	getShipById(id)
{
	return game.players[game.currentPlayer - 1].ships[id];
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
			var	shipObj = $("#sq_x"+i+"y"+j);
			if (game.selectedShip && game.selectedShip == shipNumber
				&& game.currentPlayer == player)
			{
				var newone	= shipObj.clone(true);
				shipObj.before(newone);
				shipObj.remove();
				shipObj = $("#sq_x"+i+"y"+j);
				shipObj.addClass("selected");
			}
			shipObj
				.addClass("ship player" + player)
				.click(function()
					{
						if (game.currentPlayer == player)
							selectShip(ship, shipNumber, player);
					});
			if (checkShipCollisions(ship))
				shipObj.addClass("collision");
			else
				shipObj.removeClass("collision");
		}
	}
}

function	refreshMap()
{
	if (game)
	{
		if (game.currentPlayer % 2)
			$("#board").addClass("reverse");
		else
			$("#board").removeClass("reverse");
		$("#playerTurn").text("Player "+game.currentPlayer)
			.removeClass()
			.addClass("p"+game.currentPlayer);

		$(".boardSquare").removeClass("ship player1 player2 player3 player4 selected").unbind("click");
		for (var i in game.board.grid)
		{
			for (var j in game.board.grid[i])
			{
				if (game.board.grid[i][j])
					$("#sq_x"+j+"y"+i)
						.addClass("obstacle");
			}
		}
		for (var p in game.players)
			for (var i in game.players[p].ships)
				displayShip(game.players[p].ships[i], i, parseInt(p) + 1);
	}
}
