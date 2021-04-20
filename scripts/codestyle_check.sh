#!/bin/bash

source=$1
target=$2

if test -z "$source" || test -z "$target"
then
      echo "Need to specify target and source destinations to get changed files and calculate git diff"
      exit 1
fi

changed_files=$(git diff --name-only --line-prefix=`git rev-parse --show-toplevel`/ $source..$target)

./vendor/squizlabs/php_codesniffer/bin/phpcs --standard=PSR12 $changed_files