DELIMITER |
CREATE PROCEDURE rolPerUser(role_id INT)

BEGIN
	SELECT `role`
	FROM `roles`
	WHERE `id`= role_id;
END|