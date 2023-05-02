#!/usr/bin/env bash

export CODACY_PROJECT_TOKEN=baf947a3de8641cfa4405f6997109e76
curl -Ls https://coverage.codacy.com/get.sh report -r tests-report/build/coverage/clover/clover.xml | bash