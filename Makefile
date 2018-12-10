#!/usr/bin/make -f
build:
	@echo ">>> Build Services ......"
	docker-compose build
start:
	@echo ">>> Starting Container ......"
	docker-compose up -d
status:
	@echo ">>> Disply Docker Container Status......"
	docker ps
stop:
	@echo ">>> Stop container......"
	docker-compose stop
cleanup: stop
	@echo ">>> Remove existing container......"
ssh:
	@echo ">>> Dive into the container......"

restart:    stop start
	@echo ">>> Dive into the container......"

pack:
	@echo ">>> TravisCI: packing the files......"
	zip -r code.zip /www

upload:
	@echo ">>> TravisCI: upload