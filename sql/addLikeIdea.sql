DELIMITER |
CREATE PROCEDURE addLikeIdea(id_idea INT)

BEGIN
	UPDATE `ideas` 
	SET `votes` = `votes` + 1 
	WHERE `id` = id_idea ;
END