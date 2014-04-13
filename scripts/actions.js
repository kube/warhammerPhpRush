
function		selectShip(ship, shipNumber, player)
{
	game.selectedShip = shipNumber;
	refreshMap();
}

function		shipFire(ship)
{
	var x = ship.position.x;
	var y = ship.position.y;

	if (ship.direction == 0)
	{
		y += ship.height / 2;
		x--;
	}
	else if (ship.direction == 1)
	{
		x += ship.height / 2;
		y--;
	}
	else if (ship.direction == 2)
	{
		y -= ship.height / 2 + 1;
		x--;
	}
	else if (ship.direction == 3)
	{
		x -= ship.height / 2 + 1;
		y--;
	}
	$("#sq_x"+parseInt(x)+"y"+parseInt(y)).addClass("fire");
	setTimeout(function()
		{
			$("#sq_x"+parseInt(x)+"y"+parseInt(y)).removeClass("fire");
		}, 650);
}

function		rotateShipLeft(ship)
{
	ship.direction = ship.direction + 1;
	ship.direction %= 4;
}

function		rotateShipRight(ship)
{
	ship.direction += 4;
	ship.direction--;
	ship.direction %= 4;
}

function		checkShipCollisions(ship)
{
	if (checkIcebergCollision(ship))
		return true;
	
	for (var p in game.players)
		for (var i in game.players[p].ships)
			if (checkShipsCollision(ship, game.players[p].ships[i]))
				return true;
	return false;
}

function		checkIcebergCollision(ship)
{
	var limits = getShipLimits(ship);

	for (var j = limits.y0; j < limits.y1; j++)
		for (var i = limits.x0; i < limits.x1; i++)
			if (game.board.grid[j][i])
				return true;
	return false;
}

function		checkShipsCollision(shipA, shipB)
{
	var a = getShipLimits(shipA);
	var b = getShipLimits(shipB);

	if (shipA == shipB)
		return false;
	if (a.x0 < b.x1 && a.x1 > b.x0
		&& a.y0 < b.y1 && a.y1 > b.y0)
		return true;
	return false;
}

function		checkOverflow(ship, action)
{
	var limits = getShipLimits(ship);

	if (limits.x0 < 0 || limits.x1 > game.board.width)
		return true;
	if (limits.y0 < 0 || limits.y1 > game.board.height)
		return true;
	return false;
}

function		moveShipUp(ship, nb)
{
	var position = $.extend(true, {}, ship.position);

	if (ship.direction == 0)
		ship.position.y += nb;
	else if (ship.direction == 1)
		ship.position.x += nb;
	else if (ship.direction == 2)
		ship.position.y -= nb;
	else if (ship.direction == 3)
		ship.position.x -= nb;
	if (checkOverflow(ship))
		$.extend(ship.position, position);
	else
		ship.move--;
}
