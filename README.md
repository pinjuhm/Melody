1. Što je potrebno: 
    - instaliran composer
    - instaliran lokalni server npr. xampp
    - instaliran phpadminpanel (mysql) (phpmyadmin dolazi predinstaliran sa xampp-om)
    
2. Pokrenuti komandu: git clone https://github.com/Nebra98/Melody_1 , ili Download ZIP
    
3. Nakon što ste preuzeli datoteku, potrebno je da se navigirate u nju preko terminala ili cmd-a
 
4. Nakon što ste se navigirali potrebno je pokrenuti komandu: composer update (ili composer install)

5. Pokrenuti komandu: cp .env.example .env (ako koristite windows onda samo napravite kopiju .env.example u istom folderu i tu promijenite ime u .env)

6. Napraviti novu bazu podataka u phpmyadmin (npr. ime: hello)

7. U .env fileu podesiti parametre za spajanje s bazom podataka: 
    - DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    - DB_PORT=3306
    - DB_DATABASE=ime_baze_podataka
    - DB_USERNAME=root
    - DB_PASSWORD=
            
8. Pokrenuti komandu: php artisan key:generate 

9. Pokrenuti komandu: php artisan storage:link

9. File baze podataka (hello.sql) koji se nalazi u folderu potrebno je importati u novonapravljenoj bazi podataka u phpmyadmin panelu
 
10. Pokrenuti lokalni server (php artisan serve)

Podaci za logiranje kao admin user su:
- email: admin@admin.com
- pass: password

