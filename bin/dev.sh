#!/bin/sh

docker-compose build --no-cache && docker-compose up -d #--env-file ./src/laravel/.env up -d