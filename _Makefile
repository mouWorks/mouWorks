#!/usr/bin/make -f
build:
	@echo ">>> Build Services ......"
	docker run -d -p 8080:8080 --name LindyHopperTaipei mjwangtw1/lindyhoppertaipei
start:
	@echo ">>> Starting Container ......"
	docker start LindyHopperTaipei
status:
	@echo ">>> Disply Docker Container Status......"
	docker ps
stop:
	@echo ">>> Stop container......"
	docker stop LindyHopperTaipei
cleanup: stop
	@echo ">>> Remove existing container......"
	docker rm LindyHopperTaipei
ssh:
	@echo ">>> Dive into the container......"
	docker exec -it LindyHopperTaipei zsh

	#	docker run -d -p 8080:8080 mjwangtw1/lindyhoppertaipei -name LindyHopperTaipei