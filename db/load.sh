#!/bin/sh

BASE_DIR=$(dirname "$(readlink -f "$0")")
if [ "$1" != "test" ]; then
    psql -h localhost -U yiido -d yiido < $BASE_DIR/yiido.sql
fi
psql -h localhost -U yiido -d yiido_test < $BASE_DIR/yiido.sql
