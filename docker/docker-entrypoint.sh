#!/bin/bash
set -e

# Enable Laravel queue workers
cp -f /etc/supervisor.d/worker.conf.default /etc/supervisor.d/worker.conf

exec "$@"
