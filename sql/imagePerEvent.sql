DELIMITER |

CREATE PROCEDURE imagePerEvent(IN event INT)

BEGIN 
	SELECT `images`.`id`,`image`,`votes` 
	FROM `images`
	INNER JOIN `events` ON image.`id_event`= events.id
	WHERE `id_event`= event;
END|
