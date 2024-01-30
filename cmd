#!/usr/bin/env bash

source './bin/docker'

docker container run                                                                                                   \
    --rm                                                                                                                \
    -it                                                                                                                 \
    -v ".":/data                                                                                                       \
    -w "/data"                                                                                                         \
    --network=docker_network_prueba_airzone                                                                               \
    syntetizado/images:php-8.2-cli-xdebug-dev php artisan "$@"
