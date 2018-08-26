#!/bin/sh

# Konstanten
DBACCOUNT="web873"
ACCOUNT="web873"
DBPASSWORT="DunkDBA05"

DIR="/var/www/html/$ACCOUNT/html/backup"
WEBSPACE="/var/www/html/$ACCOUNT/html"
DATUM=`date +%d-%m-%Y`

# altes Backup löschen
# rm -f $DIR/*

# Backup DB
mysqldump -u $DBACCOUNT -p$DBPASSWORT -h localhost usr_web873_4   > $DIR/backup-db.sql
gzip -9 --best $DIR/backup-db.sql

### mit Datum folgende Zeile auskommentieren
mv $DIR/backup-db.sql.gz $DIR/backup-db-$DATUM.sql.gz

#Backup Webspace
#cd $WEBSPACE
#tar cvfz $DIR/backup-webspace.tar.gz *

### mit Datum folgende Zeile auskommentieren
# mv $DIR/backup-webspace.tar.gz $DIR/backup-webspace-$DATUM.tar.gz
