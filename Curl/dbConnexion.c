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



/*

    //create a new request
    CURL *curl = curl_easy_init();
    CURLcode res;
    char responseStr[4096] = { 0 };

    if (curl) {
        curl_easy_setopt(curl, CURLOPT_URL, url);

        // On définit la fonction de rappel qui sera appelée avec les données de la réponse
        curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, writeCallback);

        // On définit où les données de la réponse seront écrites
        curl_easy_setopt(curl, CURLOPT_WRITEDATA, responseStr);

        res = curl_easy_perform(curl);

        if (res != CURLE_OK) {
            fprintf(stderr, "Erreur lors de la requête CURL: %s\n", curl_easy_strerror(res));
        }
        else {

            // Si la requête a réussi, on analyse la réponse JSON
            json_error_t error;
            json_t *root = json_loads(responseStr, 0, &error);
            if (root) {

                // Si l'analyse a réussi, on extrait les clés demandées
                for (size_t i = 0; i < keysSize; i++) {
                    json_t *value = getValueFromJson(root, keys[i]);

                    if (value) {
                        // On affiche la valeur de la clé
                        const char *valueStr = json_string_value(value);
                        if (valueStr) {
                            gtk_text_buffer_insert_at_cursor(buffer, valueStr, -1);
                        }
                        else {
                            gtk_text_buffer_insert_at_cursor(buffer, "null", -1);
                        }
                    }
                    else {
                        gtk_text_buffer_insert_at_cursor(buffer, "null", -1);
                    }

                    gtk_text_buffer_insert_at_cursor(buffer, "\n", -1);
                }

                // On libère la mémoire allouée pour l'analyse de la réponse JSON
                json_decref(root);
            }
            else {
                fprintf(stderr, "Erreur lors de l'analyse JSON: %s\n", error.text);
            }
        }

        // On libère la mémoire allouée pour la requête CURL
        curl_easy_cleanup(curl);
    }
    else {
        fprintf(stderr, "Erreur lors de l'initialisation de CURL\n");
    }

    gtk_widget_show_all(window);

    //free the memory
    g_free(api_name);
    g_free(method);
    g_free(url);
    g_free(api_key);

 */