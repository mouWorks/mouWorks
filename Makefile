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

cleanup: stop
	@echo ">>> Remove existing container......"

ssh:
	@echo ">>> Dive into the container......"
