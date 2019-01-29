DELIMITER |
CREATE PROCEDURE rolPerUser(nameRole VARCHAR(255))

BEGIN
	SELECT `id`
	FROM `roles`
	WHERE `role`= nameRole;
END|