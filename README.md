# Тестовое задание #1
Description:
You have 4 tables - users , posts , comments

User has right to do CRUD with post and comments which means any user can create any post and leave any comment under any post.
But , only owner of the post or the comment has right to update it or delete it , other users have no right to update and delete others’ posts or comments

Requirements:
1. Do it using Laravel Framework , version 9
2. Database should be Postgres

Endpoints:
1. GET /api/users should return all users with posts and all comments which the current user left under any post

2. GET /api/posts should return all posts belong to current user and all comments of each user

3. POST /api/posts

4. POST /api/comments

Bonus:
writing Unit tests
using TDD methodology

Развёртывание проекта для linux:
- git clone https://github.com/meepozZza/users-posts-comments-test.git
- cd ./users-posts-comments-test/docker
- docker-compose up -d --force --build
- docker exec -it users_posts_comments.php-fpm bash
- php artisan migrate

Локальный адрес проекта: https://users_posts_comments.localhost/

P.S. Для получения данных со связями используется параметр with при обращении по http. Если нужна подгрузка связей, то следует использовать его. Например при обращении к GET api/users/{user}/posts с получением всех комментариев, запрос будет выглядить так: /api/users/{user}/posts?with[]=comments.

Получение списка постов определённого пользователя вынес в отдельный роут /api/users/{user}/posts для корректной бизнес-логики и валидации policy

# Тестовое задание #2
Описание: Есть таблица calls
Колонки: id, user_id, calltime (datetime) время звонка, duration_sec(int) продолжительность звонка в секундах
Нужно вывести по месяцам текущего года сколько у каждого юзера было перерывов больше 5 минут между звонками
user_id | month | breaks

Решение:
\
<code>
SELECT user_id, date_part('month', mon) as month, count(*) as breaks<br>
&nbsp;FROM (<br>
&nbsp;&nbsp;SELECT user_id,<br>
&nbsp;&nbsp;DATE_TRUNC('month', calltime) as mon,<br>
&nbsp;&nbsp;LEAD(calltime)<br>
&nbsp;&nbsp;OVER(<br>
&nbsp;&nbsp;&nbsp;PARTITION by user_id, DATE_TRUNC('day', calltime)<br>
&nbsp;&nbsp;&nbsp;ORDER BY calltime<br>
&nbsp;&nbsp;) - (calltime + duration_sec * interval '1 second') as breaktime<br>
&nbsp;&nbsp;FROM calls<br>
&nbsp;&nbsp;WHERE DATE_TRUNC('year', calltime) = DATE_TRUNC('year', NOW())<br>
&nbsp;) as calls<br>
&nbsp;WHERE breaktime > INTERVAL '5 minute'<br>
&nbsp;GROUP BY month, user_id<br>
</code>
