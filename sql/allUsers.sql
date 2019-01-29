DELIMITER |
CREATE PROCEDURE allUsers()
BEGIN
SELECT `users`.first_name, `users`.last_name, `users`.email, roles.role `campus`.name 
FROM `users` 
INNER JOIN roles ON roles.id =`users`.role 
INNER JOIN `campus` ON campus.id = `users`.campus;
END|

