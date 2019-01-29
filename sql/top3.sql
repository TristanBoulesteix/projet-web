DELIMITER |
CREATE PROCEDURE top3()

BEGIN
	SELECT `id_product`
	FROM `order`
	GROUP BY `id_product`
	LIMIT 3;
END|