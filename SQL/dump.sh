#/bin/bash
# Variáveis
data=`date +%Y_%m_%d`
hora=`date +%H:%M:%S`
host="localhost"
user="root"
password="123qwe"
dbname="meucarroturbo"
 
echo "---------- Iniciando o Backup da Base de dados -> " $data  `date +%H:%M:%S`
 
mysqldump -u $user -p$password $dbname > $dbname-$data-$hora.sql

echo "---------- Fim do Script      -> " $data  `date +%H:%M:%S`