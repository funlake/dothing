#!/bin/sh
find /funlake/www/dothing -name '*.php' | xargs grep -i -b "\bfunction\s*[a-zA-Z]*\s*(" | awk -F: '{print $3}'
