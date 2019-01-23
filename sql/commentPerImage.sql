DELIMITER |

CREATE PROCEDURE commentPerImage(IN image_id INT)

BEGIN 
	SELECT `comment`.`comment`
	FROM `comment`
	INNER JOIN `images` ON comment.`id_image`= images.id
	WHERE `id_image`= image_id;
END|
