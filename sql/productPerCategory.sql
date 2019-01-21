DELIMITER |
CREATE PROCEDURE productPerCategory(IN category VARCHAR(255))

BEGIN
    SELECT `products`.`id`,`products`.`name`,`description`,`price`, `category`
	FROM `products`
	INNER JOIN `categories` ON products.`id_category`= categories.id
	WHERE `name` = `category`;
END|