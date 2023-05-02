#!/usr/bin/env bash

export $(cat .env.local | xargs)

curl -Ls https://coverage.codacy.com/get.sh report -r tests-report/build/coverage/clover/clover.xml | bash