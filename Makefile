#!/usr/bin/make -f
build: container-build vendor
	@echo ">>> Build Container and Vendor"
container-build:
	@echo ">>> Build Services (Docker Container)......"
	docker-compose build --parallel
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
	@echo ">>> Destroy Services ......(Containers && Images)"
	docker-compose down --rmi 'all'
ssh:
	@echo ">>> Dive into the container......"

restart:    stop start
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