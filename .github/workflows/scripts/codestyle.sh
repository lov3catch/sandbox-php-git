#!/bin/bash

source='master'
target='develop'

changed_files=$(git diff --name-only --line-prefix=`git rev-parse --show-toplevel`/ master..develop)

echo $changed_files
echo "${GITHUB_WORKSPACE}/.github/workflows/scripts/codestyle.sh"

../../../vendor/squizlabs/php_codesniffer/bin/phpcs $changed_files
