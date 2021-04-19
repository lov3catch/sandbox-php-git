#!/bin/bash

source='master'
target='develop'

changed_files=$(git diff --name-only --line-prefix=`git rev-parse --show-toplevel`/ master..develop)

echo $changed_files

../vendor/squizlabs/php_codesniffer/bin/phpcs $changed_files
