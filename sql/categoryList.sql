DELIMITER |
CREATE PROCEDURE categories()

BEGIN
	SELECT `id_category`,`name_category`
	FROM `categories`;
END|