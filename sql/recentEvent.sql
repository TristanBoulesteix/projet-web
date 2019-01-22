DELIMITER |
CREATE PROCEDURE recentEvent()

BEGIN
    SELECT `id`,`description`, `date`,`type`,`cost`, `image`
	FROM `events`
	WHERE `date` > CURRENT_DATE();
END|

