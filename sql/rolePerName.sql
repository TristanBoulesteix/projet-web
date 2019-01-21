DELIMITER |
CREATE PROCEDURE rolPerUser(nameRole VARCHAR(255))

BEGIN
	SELECT `id_role`
	FROM `role`
	WHERE `name_role`= nameRole;
END|