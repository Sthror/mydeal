use mydeal;
INSERT INTO `category` (`name`)
VALUES ('Входящие'), ('Учеба'), ('Работа'), ('Домашние дела'), ('Авто');

INSERT INTO `users` (`name`, `password`, `'email`)
VALUES 
('Сергей', '123', 'sergey@mydeal.ru'),
('Иван', '123', 'ivan@mydeal.ru');

INSERT INTO `task` (`name`, `date`, `category_id`, `user_id`, `status`, `file`)
VALUES 
('Собеседование в IT компании', '2019-12-01', '3', '1', '0', ''),
('Выполнить тестовое задание', '2019-12-25', '3', '1', '0', ''),
('Сделать задание первого раздела', '2020-12-21', '2', '2', '1', ''),
('Встреча с другом', '2019-12-22', '1', '1', '0', ''),
('Купить корм для кота', NULL, '4', '1', '0', ''),
('Заказать пиццу', NULL, '4', '1', '0', '');



/* получить все задачи пользователя под id = 1 */
SELECT * FROM task WHERE user_id = '1';

/* получить все задачи категории = 3 */
SELECT * FROM task WHERE category_id = '3';

/* пометили как выполненнную задачу по id = 3 */
UPDATE task SET status = '1' WHERE id = '3';


/* обновил имя по id = 3 */
UPDATE task SET name = 'обновил имя' WHERE id = '3';
