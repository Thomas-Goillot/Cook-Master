#include "../includes/sql.h"

void addLog(MYSQL *conn, int id_api, char *type)
{
    char query[1000];
    sprintf(query, "INSERT INTO logs (id_api, type) VALUES (%d, '%s')", id_api, type);
    if (mysql_query(conn, query))
    {
        fprintf(stderr, "%s\n", mysql_error(conn));
    }

}
