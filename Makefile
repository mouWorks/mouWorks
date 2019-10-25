#!/usr/bin/make -f
include .env
export
BRANCH := $(shell git name-rev --name-only HEAD)

.PHONY: vendor

build: container-build vendor start
	@echo ">>> Build Container and Vendor"
container-build:
	@echo ">>> Build Services (Docker Container)......"
	docker-compose build --parallel
rebuild: stop destroy build start
	@echo ">>> Rebuild the whole process"
start: cp_conf
	@echo ">>> Starting Container ......"
	docker-compose up -d --no-recreate
	@echo ">>> Start: Visit http://localhost:9527 ...."
status:
	@echo ">>> Disply Docker Container Status......"
	docker ps
stop:
	@echo ">>> Stop container......"
	docker-compose stop && rm -r /tmp/default.conf
destroy: vendor-remove
	@echo ">>> Destroy Services ......(Containers)"
	docker-compose down --remove-orphans
cleanup: destroy
	@echo ">>> Destroy Services ......(Images)"
	docker-compose down --rmi 'all'
ssh:
	@echo ">>> Dive into the container......"

restart: stop start
	@echo ">>> Dive into the container......"

pack:
	@echo ">>> TravisCI: packing the files......"
	zip -r code.zip /www

upload:
	@echo ">>> TravisCI: upload

vendor:
	@echo ">>> Getting Composer Vendor pack"
	cd www && composer install

vendor-remove:
	@echo ">>> Remove Vendor package"
	rm -rf www/vendor

cp_conf: |
#	rm -r /tmp/default.conf /tmp/my.cnf
	cp _conf/default.conf /tmp
	cp _conf/my.cnf /tmp

# For checking DB internal IP
get-db-ip:
	@echo ">>> Getting DB IP"
	docker inspect mw_dev_mysql | grep IPAddress

db_backup:
	@echo ">>> backing up the file"
	docker exec mw_dev_mysql /usr/bin/mysqldump -u root --password=${DB_PASS} ${DB_NAME} > ./sql/backup.sql

db_restore:
	@echo ">>> Restoring DB data"
	cat ./sql/backup.sql | docker exec -i mw_dev_mysql /usr/bin/mysql -u root --password=${DB_PASS} ${DB_NAME}

db_init:
	@echo ">>> Init DB Table"

pull:
	@echo ">>> Pull Code on Current branch [$(BRANCH)]"
	git pull origin $(BRANCH) --rebase

push: pull
	@echo ">>> Current branch [$(BRANCH)] Pushing Code"
	git push origin $(BRANCH)
