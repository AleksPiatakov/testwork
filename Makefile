# HELP
# This will output the help for each task
# thanks to https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help

help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

include .env
dc := docker-compose

CURRENT_UID=$(shell id -u)
CURRENT_GID=$(shell id -g)
ARGS = $(filter-out $@,$(MAKECMDGOALS))
MYSQL_DUMP=docker/dump/demo_demo.sql

.SILENT: ;               # no need for @
.EXPORT_ALL_VARIABLES: ; # send all vars to shell

check:
ifeq ($(APP_NAME),)
	$(error Missed APP_NAME argument.)
endif

build: check ## Build containers
	$(dc) build --force-rm

code-sniff: ## Run code sniff
	$(dc) exec -T app ./vendor/bin/phpcs $(git diff --name-only)

up: ## Run containers
	$(dc) up -d --remove-orphans

down: ## Remove docker containers
	@$(dc) down

composer-install: up ## Install php dependencies
	@$(dc) exec -T app composer install

bash: ## Bash to app container
	@$(dc) exec app bash

logs: ## Docker logs
	@$(dc) logs $(ARGS)

config: ## Show container config
	@$(dc) config

clean: ## Remove *.log from storage folder
	@find storage -name "*.log" -delete

mysql-dump: ## Make Mysql dump to $(MYSQL_DUMP)
	@$(dc) exec db mysqldump --extended-insert=FALSE -u"$(DB_USERNAME)" -p"$(DB_PASSWORD)" $(DB_DATABASE) > "$(MYSQL_DUMP)"

mysql-restore: ## Restore mysqlDB from $(MYSQL_DUMP)
	@$(dc) exec -T db mysql -u"$(DB_USERNAME)" -p"$(DB_PASSWORD)" $(DB_DATABASE) < $(MYSQL_DUMP)
