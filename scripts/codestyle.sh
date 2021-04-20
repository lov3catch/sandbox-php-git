#!/bin/bash

source=$1
target=$2

changed_files=$(git diff --name-only --line-prefix=`git rev-parse --show-toplevel`/ $source..$target)

./vendor/squizlabs/php_codesniffer/bin/phpcs --standard=PSR12 $changed_files