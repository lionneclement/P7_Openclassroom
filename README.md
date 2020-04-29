# P7_Openclassroom
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/f3fb0f0c6f6548ac982b615fa88b2751)](https://www.codacy.com/manual/lionneclement/P7_Openclassroom?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=lionneclement/P7_Openclassroom&amp;utm_campaign=Badge_Grade)
## Clone
1) Make a clone with `https://github.com/lionneclement/P7_Openclassroom.git` and `cd P7_Openclassroom`
2) Install composer with `composer install`
3) Create database with `php bin/console doctrine:database:create`
4) Create table with `php bin/console doctrine:schema:create`
5) Create data with `php bin/console doctrine:fixtures:load`

   By default a user was created with email=client@gmail.com and password=password
   
6) Run server with `bin/console server:run` or `symfony server:start`and go to localhost with port 8000
   
7) For get the documentation you need to go in http://localhost:8000/api/doc

Normally everything works, If you have a error or send me an mail to lionneclement@gmail.com or create a issue
