### Laravel9, Spatie, CRUD, roles, permissions
<hr>

### Делал для себя Исключительно в образовательных целях. Возможны неточности и ошибки !!! У меня все работает!<br>

<hr>

### Использовал контейнеризацию 
| NAME | COMMAND | SERVICE | STATUS | PORTS |
|---|---|---|---|---|
| PHP1 | "docker-php-entrypoi…" | webserver | running | 0.0.0.0:8000->80/tcp, :::8000->80/tcp |
| mysql1 | "docker-entrypoint.s…" | mysqldb | running | 0.0.0.0:3306->3306/tcp, :::3306->3306/tcp, 33060/tcp |
| phpmyadmin1 | "/docker-entrypoint.…" | phpmyadmin | running | 0.0.0.0:8081->80/tcp, :::8081->80/tcp |

<hr>
Laravel v9.52.16 (PHP v8.2.18)<br><br>
docker -v<br>
Docker version 26.1.2, build 211e74b<br>
<br>
docker-compose -v<br>
Docker Compose version v2.12.2<br>
<hr>

Файлы настроек, конфигурации (Dockerfile, docker-compose.yml)  описания laravel9v2-spatie-permission.txt, база данных ale3.sql, 
ссылка на видео - первоисточник есть на гите.

Видео первоисточник канал - Grapes, за что огромное спасибо Автору!
<br>
https://www.youtube.com/watch?v=Cl0KKlkwmdc&list=PLze7bMjv1CYuFDzbuKwSqo9ZfdiScyYX7&index=6