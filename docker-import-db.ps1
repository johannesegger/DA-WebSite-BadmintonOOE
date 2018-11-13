#http://jongurgul.com/blog/get-stringhash-get-filehash/ 
Function Get-StringHash([String] $String) 
{ 
    $StringBuilder = New-Object System.Text.StringBuilder 
    [System.Security.Cryptography.HashAlgorithm]::Create("SHA256").ComputeHash([System.Text.Encoding]::UTF8.GetBytes($String))|%{ 
        [Void]$StringBuilder.Append($_.ToString("x2")) 
    } 
    $StringBuilder.ToString() 
}

docker exec badminton-db sh -c "mysql -uroot -p1234 --execute='drop database if exists badminton; create database badminton;'"
docker exec badminton-db sh -c "mysql -uroot -p1234 badminton < /src/backup.sql"
$password = Get-StringHash(Get-StringHash("asdqwe" + "salt") + "pepper")
$statement = @"
INSERT INTO ``users``(``rank``, ``club``, ``firstname``, ``lastname``, ``sex``, ``email``, ``password``) VALUES ("administrative", 0, "Johannes", "Egger", "M", "eggj", "$password")
"@
Write-Host $statement
docker exec badminton-db sh -c "mysql -uroot -p1234 badminton --execute='$statement'"
