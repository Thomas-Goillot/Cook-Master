#include <mysql.h>
#include <stdio.h>

int main()
{
    MYSQL *conn;
    MYSQL_RES *res;
    MYSQL_ROW row;

    const char *server = "sportplus.ddns.net";
    const char *user = "cookmaster_api_request_dev";
    const char *password = "QGACsfzEvuel0S0b";
    const char *database = "cookmaster_api_request_dev";

    conn = mysql_init(NULL);

    if (!mysql_real_connect(conn, server, user, password, database, 0, NULL, 0))
    {
        fprintf(stderr, "%s\n", mysql_error(conn));
        return 1;
    }

    if (mysql_query(conn, "SELECT * FROM api"))
    {
        fprintf(stderr, "%s\n", mysql_error(conn));
        return 1;
    }

    res = mysql_use_result(conn);

    while ((row = mysql_fetch_row(res)) != NULL)
    {
        //count number of columns
        unsigned int num_fields = mysql_num_fields(res);

        //print column name
        for (int i = 0; i < num_fields; i++)
        {
            printf("%s ", mysql_fetch_field_direct(res, i)->name);
        }
        for(int i = 0; i < num_fields; i++)
        {
            printf("%s \n", row[i] ? row[i] : "NULL");
        }
    }

    mysql_free_result(res);
    mysql_close(conn);

    return 0;
}
