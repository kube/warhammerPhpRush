
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

function		checkOverflow(ship, action)
{
	var limits = getShipLimits(ship);

	console.log(limits);

	if (limits.x0 < 0 || limits.x1 > game.board.width)
	{
		console.log("a");
		return true;
	}
	if (limits.y0 < 0 || limits.y1 > game.board.height)
	{
		console.log("b");
		return true;
	}
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
