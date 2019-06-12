#!/usr/bin/make -f
include .env
export
BRANCH := $(shell git name-rev --name-only HEAD)

build: container-build vendor start
	@echo ">>> Build Container and Vendor"
container-build:
	@echo ">>> Build Services (Docker Container)......"
	docker-compose build --parallel
rebuild: stop destroy build start
	@echo ">>> Rebuild the whole process"
start:
	@echo ">>> Starting Container ......"
	docker-compose up -d --no-recreate
status:
	@echo ">>> Disply Docker Container Status......"
	docker ps
stop:
	@echo ">>> Stop container......"
	docker-compose stop
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

# For checking DB internal IP
get-db-ip:
	@echo ">>> Getting DB IP"
	docker inspect mouworks_mariadb_1 | grep IPAddress

db_backup:
	@echo ">>> backing up the file"
	docker exec mouworks_mariadb_1 /usr/bin/mysqldump -u root --password=${DB_PASS} ${DB_NAME} > ./sql/backup.sql

db_restore:
	@echo ">>> Restoring DB data"
	cat ./sql/backup.sql | docker exec -i mouworks_mariadb_1 /usr/bin/mysql -u root --password=${DB_PASS} ${DB_NAME}

pull:
	@echo ">>> Pull Code on Current branch [$(BRANCH)]"
	git pull origin $(BRANCH) --rebase

push: pull
	@echo ">>> Current branch [$(BRANCH)] Pushing Code"
	git push origin $(BRANCH)
