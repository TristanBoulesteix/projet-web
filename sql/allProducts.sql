DELIMITER |
CREATE PROCEDURE allProducts()

BEGIN
	SELECT `name_product`, `description_product`, `price_product`, `id_category`
	FROM `product`;
END|