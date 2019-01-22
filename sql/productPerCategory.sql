DELIMITER |
CREATE PROCEDURE productPerCategory()

BEGIN
    SELECT `products`.`id`,`products`.`name`,`description`,`price`, `category`
	FROM `products`
	INNER JOIN `categories` ON products.`id_category`= categories.id
	WHERE `name` = `category`;
END|


DELIMITER |
CREATE PROCEDURE categoryPerProducts(IN category VARCHAR(255))

BEGIN
SET FOREIGN_KEY_CHECKS = ON;
    SELECT `products`.`id`,`products`.`name`,`description`,`price`
	FROM `products`
	INNER JOIN `categories` ON products.`id_category`= categories.id
	WHERE `category` = category;
END|