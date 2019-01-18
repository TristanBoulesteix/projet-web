DELIMITER |
CREATE PROCEDURE rolPerUser(role_id INT)

BEGIN
	SELECT `role_name`
	FROM `role`
	WHERE `id_role`= role_id;
END|