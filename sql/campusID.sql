DELIMITER |

CREATE PROCEDURE campusID(IN campus_name VARCHAR(255))

BEGIN 
	SELECT `id` 
	FROM `campus`
	WHERE `name`= campus_name;
END|
