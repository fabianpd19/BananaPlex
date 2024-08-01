#!/bin/bash

# Variables
DB_NAME="BananaPlex"
DB_USER="Grupo3"
DB_PASSWORD="gestiongrupo3"
BACKUP_PATH="/backups"
REMOTE_USER="fabian"
REMOTE_HOST="172.30.102.119"
REMOTE_PATH="/home/fabian/backups"

# Fecha actual
DATE=$(date +"%Y%m%d%H%M")

# Archivo de backup
BACKUP_FILE="$BACKUP_PATH/$DB_NAME-$DATE.sql"

# Crear el backup de PostgreSQL
export PGPASSWORD=$DB_PASSWORD
pg_dump -U $DB_USER -d $DB_NAME > $BACKUP_FILE

# Transferir el backup al servidor remoto
scp $BACKUP_FILE $REMOTE_USER@$REMOTE_HOST:$REMOTE_PATH

# Eliminar el archivo de backup local después de transferirlo
rm $BACKUP_FILE
