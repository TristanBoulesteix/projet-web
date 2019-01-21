DELIMITER |
CREATE PROCEDURE rolPerUser(name VARCHAR(255))

BEGIN
	SELECT `role_name`
	FROM `role`
	INNER JOIN `user` ON role.id_role=user.id_role
	WHERE `first_name_user` = name;
END|