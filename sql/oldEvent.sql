DELIMITER |
CREATE PROCEDURE oldEvent()

BEGIN
    SELECT `id`,`description`, `date`,`type`,`cost`, `image`, `name`
	FROM `events`
	WHERE `date` < CURRENT_DATE();
END|
