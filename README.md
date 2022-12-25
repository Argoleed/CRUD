# Реализация шаблона CRUD
***
### Задание
##### Разработать и реализовать клиент-серверную информационную систему, реализующую механизм CRUD
***
***
#### 1. Пользовательский интерфейс
---
![](https://raw.githubusercontent.com/Argoleed/Forum/main/user_interface.png)
***
***
#### 2. Структура базы данных
***
| Название | Тип данных | Описание                                          |
|----------|------------|---------------------------------------------------|
| id       | int        | Ключевое поле                                     |
| text     | text       | Текст поста                                       |
| date     | bigint     | Дата публикации поста                             |
| likes    | int        | Число лайков под постом                           |
| dislikes | int        | Число дизлайков под постом                        |
***
| Название | Тип данных | Описание                                          |
|----------|------------|---------------------------------------------------|
| id       | int        | id поста, к которому привязан комментарий         |
| text     | text       | Текст комментария                                 |
| date     | bigint     | Дата публикации комментария                       |
***
***
#### 3. Алгоритмы
***
- Добавление поста (setpost.php)
***
![](https://github.com/Argoleed/Forum/blob/main/setpost.png)
***
-Добавление комментария (setcomment.php)
***
![](https://github.com/Argoleed/Forum/blob/main/setcomment.png)
***
- Лайк/Дизлайк (add_emoji.php)
***
![](https://github.com/Argoleed/Forum/blob/main/add_emoji.png)
***
***
#### 4. API
***
![](https://github.com/Argoleed/Forum/blob/main/API.png)
***
***
