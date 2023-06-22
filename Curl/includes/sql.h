#ifndef DEF_HEADER_SQL
#define DEF_HEADER_SQL

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include <mysql.h>

void addLog(MYSQL *conn, int id_api, char *type);

#endif