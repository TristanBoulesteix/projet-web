DELIMITER |
CREATE PROCEDURE rolPerUser(name VARCHAR(255))

BEGIN
	SELECT `role`
	FROM `roles`
	INNER JOIN `user` ON role.id=user.role
	WHERE `first_name` = name;
END|