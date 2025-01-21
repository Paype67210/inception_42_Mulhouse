# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Makefile                                           :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: pdeson <pdeson@student.42mulhouse.fr>      +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2024/12/03 10:09:31 by pdeson            #+#    #+#              #
#    Updated: 2024/12/18 12:41:12 by pdeson           ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

# Definition des variables

NAME		= inception
SRCS		= ./srcs
COMPOSE		= $(SRCS)/docker-compose.yml
HOST_URL	= pdeson.42.fr


all: $(NAME)

$(NAME): up

up: create_dir 
	@sudo hostsed add 127.0.0.1 $(HOST_URL) > $(HIDE) && echo " $(HOST_ADD)"
	@docker compose -p $(NAME) -f $(COMPOSE) up --build || (echo " $(FAIL)" && exit 1)
	@echo " $(UP)"

down:
	@docker compose -p $(NAME) down
	@echo " $(DOWN)"

create_dir:
	@mkdir -p ~/data/wordpress ~/data/mariadb

clean:
	@docker compose -f $(COMPOSE) down -v
	@docker rm -f nginx > $(HIDE) && echo " $(NX_CLN)"
	@docker rm -f wordpress > $(HIDE) && echo " $(WP_CLN)"
	@docker rm -f mariadb > $(HIDE) && echo " $(DB_CLN)"

fclean:
	sudo rm -rf ~/data
	@docker image rm -f $(NAME)-nginx > $(HIDE) && echo " $(NX_FLN)"
	@docker image rm -f $(NAME)-wordpress > $(HIDE) && echo " $(WP_FLN)"
	@docker image rm -f $(NAME)-mariadb > $(HIDE) && echo " $(DB_FLN)"
	@sudo hostsed rm 127.0.0.1 $(HOST_URL) > $(HIDE) && echo " $(HOST_RM)"

prepare:
	@echo "\nPrepare to start with a clean environment..."
	@echo "\nStop containers"
	@docker stop $$(docker ps -qa)

	@echo "\nRemove containers"
	@docker rm $$(docker ps -qa)

	@echo "\nRemove images"
	@docker rmi -f $$(docker images -qa)

	@echo "\nRemove Volumes"
	@docker volume rm $$(docker volume ls -q)

	@echo "\nRemove Network"
	@docker network rm $$(docker network ls -q) 2> /dev/null || true
	echo ""

re: fclean all

# Custom Values

HIDE		= /dev/null 2>&1

RED			= \033[0;31m
GREEN		= \033[0;32m
RESET		= \033[0m

MARK		= $(GREEN)✔$(RESET)
ADDED		= $(GREEN)Added$(RESET)
REMOVED		= $(GREEN)Removed$(RESET)
STARTED		= $(GREEN)Started$(RESET)
STOPPED		= $(GREEN)Stopped$(RESET)
CREATED		= $(GREEN)Created$(RESET)
EXECUTED	= $(GREEN)Executed$(RESET)

# Messages

UP			= $(MARK) $(NAME) $(EXECUTED)
DOWN		= $(MARK) $(NAME) $(STOPPED)
FAIL		= $(RED)✔$(RESET) $(NAME) $(RED)Failed$(RESET)

HOST_ADD	= $(MARK) Host $(HOST_URL) $(ADDED)
HOST_RM		= $(MARK) Host $(HOST_URL) $(REMOVED)

NX_CLN		= $(MARK) Container nginx $(REMOVED)
WP_CLN		= $(MARK) Container wordpress $(REMOVED)
DB_CLN		= $(MARK) Container mariadb $(REMOVED)

NX_FLN		= $(MARK) Image $(NAME)-nginx $(REMOVED)
WP_FLN		= $(MARK) Image $(NAME)-wordpress $(REMOVED)
DB_FLN		= $(MARK) Image $(NAME)-mariadb $(REMOVED)

# Phony

.PHONY: all up down create_dir clean fclean prepare re