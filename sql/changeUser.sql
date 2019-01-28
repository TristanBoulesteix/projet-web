DELIMITER |
CREATE PROCEDURE changeUser(id_user INT(255), selection VARCHAR(255))
BEGIN
	UPDATE  `users`
	SET role = selection
	WHERE `id` = id_user;
END|