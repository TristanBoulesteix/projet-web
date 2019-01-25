DELIMITER |
CREATE PROCEDURE addLike(id_image INT)

BEGIN
	UPDATE `images` 
	SET `votes` = `votes` + 1 
	WHERE `id` = id_image ;
END