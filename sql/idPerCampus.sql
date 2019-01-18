DELIMITER |

CREATE PROCEDURE idPerCampus(IN campus_id INT)

BEGIN 
	SELECT `name` 
	FROM `campus`
	WHERE `id_campus`= campus_id;
END|
