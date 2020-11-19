#!/bin/sh

if [ "$1" = "travis" ]; then
    psql -U postgres -c "CREATE DATABASE yiido_test;"
    psql -U postgres -c "CREATE USER yiido PASSWORD 'yiido' SUPERUSER;"
else
    sudo -u postgres dropdb --if-exists yiido
    sudo -u postgres dropdb --if-exists yiido_test
    sudo -u postgres dropuser --if-exists yiido
    sudo -u postgres psql -c "CREATE USER yiido PASSWORD 'yiido' SUPERUSER;"
    sudo -u postgres createdb -O yiido yiido
    sudo -u postgres psql -d yiido -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    sudo -u postgres createdb -O yiido yiido_test
    sudo -u postgres psql -d yiido_test -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    LINE="localhost:5432:*:yiido:yiido"
    FILE=~/.pgpass
    if [ ! -f $FILE ]; then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE; then
        echo "$LINE" >> $FILE
    fi
fi
