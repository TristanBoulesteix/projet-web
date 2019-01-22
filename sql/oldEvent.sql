DELIMITER |
CREATE PROCEDURE oldEvent()

BEGIN
    SELECT `id`,`description`, `date`,`type`,`cost`, `image`
	FROM `events`
	WHERE `date` < CURRENT_DATE();
END|
