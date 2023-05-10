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

start: down up vendor create_dbs

create_dbs: create_db_body_tracker create_db_mind_tracker create_db_hydration_tracker create_db_activity_tracker load_fixtures

create_db_body_tracker:
	$(SF_CONSOLE) app:mysql-wait -c body_tracker --env=$(APP_ENV)
	$(SF_CONSOLE) doctrine:database:drop --force --if-exists --env=$(APP_ENV) --connection=body_tracker
	$(SF_CONSOLE) doctrine:database:create --env=$(APP_ENV) --connection=body_tracker
	$(SF_CONSOLE) doctrine:schema:drop --env=dev --em=body_tracker
	$(SF_CONSOLE) doctrine:schema:update --env=dev --force --em=body_tracker

create_db_mind_tracker:
	$(SF_CONSOLE) app:mysql-wait -c mind_tracker --env=$(APP_ENV)
	$(SF_CONSOLE) doctrine:database:drop --force --if-exists --env=$(APP_ENV) --connection=mind_tracker
	$(SF_CONSOLE) doctrine:database:create --env=$(APP_ENV) --connection=mind_tracker
	$(SF_CONSOLE) doctrine:schema:drop --env=dev --em=mind_tracker
	$(SF_CONSOLE) doctrine:schema:update --env=dev --force --em=mind_tracker

create_db_hydration_tracker:
	$(SF_CONSOLE) app:mysql-wait -c hydration_tracker --env=$(APP_ENV)
	$(SF_CONSOLE) doctrine:database:drop --force --if-exists --env=$(APP_ENV) --connection=hydration_tracker
	$(SF_CONSOLE) doctrine:database:create --env=$(APP_ENV) --connection=hydration_tracker
	$(SF_CONSOLE) doctrine:schema:drop --env=dev --em=hydration_tracker
	$(SF_CONSOLE) doctrine:schema:update --env=dev --force --em=hydration_tracker

create_db_activity_tracker:
	$(SF_CONSOLE) app:mysql-wait -c activity_tracker --env=$(APP_ENV)
	$(SF_CONSOLE) doctrine:database:drop --force --if-exists --env=$(APP_ENV) --connection=activity_tracker
	$(SF_CONSOLE) doctrine:database:create --env=$(APP_ENV) --connection=activity_tracker
	$(SF_CONSOLE) doctrine:schema:drop --env=dev --em=activity_tracker
	$(SF_CONSOLE) doctrine:schema:update --env=dev --force --em=activity_tracker

load_fixtures:
	$(SF_CONSOLE) hautelook:fixtures:load --manager=mind_tracker --no-interaction
	$(SF_CONSOLE) hautelook:fixtures:load --manager=hydration_tracker --no-interaction
	$(SF_CONSOLE) hautelook:fixtures:load --manager=activity_tracker --no-interaction
	$(SF_CONSOLE) hautelook:fixtures:load --manager=body_tracker --no-interaction

vendor: up
	@$(DOCKER_EXEC) php composer install

up:
	@$(DOCKER) up -d

down:
	@$(DOCKER) down --remove-orphan

mysql.connect.body-tracker:
	@$(DOCKER_EXEC) mysql-body-tracker /bin/bash -c 'mysql -u$$MYSQL_USER -p$$MYSQL_PASSWORD'

mysql.connect.mind-tracker:
	@$(DOCKER_EXEC) mysql-mind-tracker /bin/bash -c 'mysql -u$$MYSQL_USER -p$$MYSQL_PASSWORD'

mysql.connect.hydration-tracker:
	@$(DOCKER_EXEC) mysql-hydration-tracker /bin/bash -c 'mysql -u$$MYSQL_USER -p$$MYSQL_PASSWORD'

mysql.connect.activity-tracker:
	@$(DOCKER_EXEC) mysql-activity-tracker /bin/bash -c 'mysql -u$$MYSQL_USER -p$$MYSQL_PASSWORD'



unit_tests:
	@XDEBUG_MODE=coverage $(DOCKER_EXEC) php bin/phpunit --colors=never  --testsuite unit
	sh ./export-report.sh