#!/bin/sh

# Konstanten
ACCOUNT="web873"
PASSWORT="DunkDBA05"

DIR="/var/www/html/$ACCOUNT/html/backup"
WEBSPACE="/var/www/html/$ACCOUNT/html/dunkomatic"
DATUM=`date +%d-%m-%Y`

# altes Backup löschen
# rm -f $DIR/*

# Backup DB
# mysqldump -u$ACCOUNT -p$PASSWORT -h localhost -A  > $DIR/backup-db.sql
# gzip -9 --best $DIR/backup-db.sql

### mit Datum folgende Zeile auskommentieren
# mv $DIR/backup-db.sql.gz $DIR/backup-db-$DATUM.sql.gz

#Backup Webspace
cd $WEBSPACE
tar cvfz $DIR/backup-webspace.tar.gz *

### mit Datum folgende Zeile auskommentieren
mv $DIR/backup-webspace.tar.gz $DIR/backup-webspace-$DATUM.tar.gz
