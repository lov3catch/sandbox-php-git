#!/bin/bash

source=$1
target=$2

changed_files=$(git diff --name-only --line-prefix=`git rev-parse --show-toplevel`/ $source..$target)

echo $changed_files
echo "${GITHUB_WORKSPACE}/.github/workflows/scripts/codestyle.sh"

#${GITHUB_WORKSPACE}/vendor/squizlabs/php_codesniffer/bin/phpcs $changed_files
