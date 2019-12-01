#!/usr/bin/env sh

git add . && git status && git commit -m fix && git push origin master

ssh nzpro "
cd services/arbol/trendsmag/docker/;
docker-compose down;
git pull;
docker-compose up --build --abort-on-container-exit;
exit"
