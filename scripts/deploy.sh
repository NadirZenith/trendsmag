#!/usr/bin/env sh

ssh nzpro "
cd services/arbol/trendsmag/docker/;
docker-compose down;
git pull -X theirs --no-edit origin pre;
docker-compose up --build -d;
exit"
