#Setup automatically docker compose variables

include .env
-include .env.local


DOCKER=docker-compose
DOCKER_EXEC= ${DOCKER} exec
SF_CONSOLE := ${DOCKER_EXEC} php bin/console

ifeq ($(APP_ENV),test)
	XDEBUG_MODE	:=coverage
endif

setup: .env.local docker-compose.yaml

.env.local:
	@touch .env.local

docker-compose.yaml: docker-compose.yaml.dist
	@cp docker-compose.yaml.dist docker-compose.yaml
	@sed -i "s/<DOCKER_USER_ID>/$(shell $(shell echo id -u ${USER}))/g" $@
	@sed -i "s/<DOCKER_USER>/$(shell echo ${USER})/g" $@
	@sed -i 's/<REMOTE_HOST>/$(shell hostname -I | grep -Eo "192\.168\.[0-9]{,2}\.[0-9]+" | head -1)/g' $@

start: down up install_vendor migrate_dbs yarn

create_db_life_saver:
	$(SF_CONSOLE) app:mysql-wait -c life_saver --env=$(APP_ENV)
	$(SF_CONSOLE) doctrine:database:drop --force --if-exists --env=$(APP_ENV) --connection=life_saver
	$(SF_CONSOLE) doctrine:database:create --env=$(APP_ENV) --connection=life_saver

migrate_dbs:
	$(SF_CONSOLE) doctrine:migrations:migrate --no-interaction --env=$(APP_ENV)

install_vendor:
	$(DOCKER_EXEC) php composer install

yarn:
	yarn install
	yarn build

open_in_browser:
	firefox https://website.superhuman-factory.com:446/login

up:
	$(DOCKER) up -d

down:
	@$(DOCKER) down --remove-orphan

mysql.connect.life-saver:
	@$(DOCKER_EXEC) mysql-life-saver /bin/bash -c 'mysql -u$$MYSQL_USER -p$$MYSQL_PASSWORD'

unit_tests:
	@XDEBUG_MODE=coverage $(DOCKER_EXEC) php bin/phpunit --colors=never  --testsuite unit
	sh ./export-report.sh
