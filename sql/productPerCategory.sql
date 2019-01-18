DELIMITER |
CREATE PROCEDURE productPerCategory(IN category VARCHAR(255))

BEGIN
	SELECT `id_product`,`name_product`,`description_product`,`price_product`
	FROM `product`
	INNER JOIN `categories` ON product.id_category=categories.id_category
	WHERE `name_category` = category;
END|