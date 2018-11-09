docker exec badminton-db sh -c "mysql -uroot -p1234 --execute='drop database badminton; create database badminton;'"
docker exec badminton-db sh -c "mysql -uroot -p1234 badminton < /src/backup.sql"
