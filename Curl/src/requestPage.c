#include "../includes/requestPage.h"

void make_request_page(GtkButton *button, gpointer content)
{
    clear_container(content);

    create_title(content, "Faire une requête");

    // Création d'un champ de saisie invisible
    GtkWidget *id_api = gtk_entry_new();
    gtk_entry_set_visibility(GTK_ENTRY(id_api), FALSE);
    gtk_container_add(GTK_CONTAINER(content), id_api);

    GtkWidget *api_name = gtk_entry_new();
    gtk_entry_set_placeholder_text(GTK_ENTRY(api_name), "Enter Api name");
    gtk_widget_set_name(api_name, "api_name");
    set_margin(api_name, 5);

    GtkWidget *select_box = gtk_combo_box_text_new();
    gtk_combo_box_text_append_text(GTK_COMBO_BOX_TEXT(select_box), "GET");
    gtk_combo_box_text_append_text(GTK_COMBO_BOX_TEXT(select_box), "POST");
    gtk_widget_set_name(select_box, "select_box");
    set_margin(select_box, 5);

    GtkWidget *load_api_popup_button = gtk_button_new_with_label("Charger une API");
    set_margin(load_api_popup_button, 5);
    gtk_container_add(GTK_CONTAINER(content), load_api_popup_button);
    g_signal_connect(load_api_popup_button, "clicked", G_CALLBACK(open_load_api_popup), content);

    // create a horizontal box to hold the widgets
    GtkWidget *hbox = gtk_box_new(GTK_ORIENTATION_HORIZONTAL, 0);
    gtk_box_pack_start(GTK_BOX(hbox), api_name, TRUE, TRUE, 0);
    gtk_box_pack_start(GTK_BOX(hbox), select_box, TRUE, TRUE, 0);
    gtk_container_add(GTK_CONTAINER(content), hbox);

    GtkWidget *url = gtk_entry_new();
    gtk_entry_set_placeholder_text(GTK_ENTRY(url), "Enter url API");
    set_margin(url, 5);
    gtk_widget_set_name(url, "url");
    gtk_container_add(GTK_CONTAINER(content), url);

    GtkWidget *api_key = gtk_entry_new();
    gtk_entry_set_placeholder_text(GTK_ENTRY(api_key), "Enter Api key (optional if specified in url)");
    set_margin(api_key, 5);
    gtk_widget_set_name(api_key, "api_key");
    gtk_container_add(GTK_CONTAINER(content), api_key);

    GtkWidget *send_request_button = gtk_button_new_with_label("Envoyer la requête");
    gtk_widget_set_halign(send_request_button, GTK_ALIGN_END);
    gtk_widget_set_valign(send_request_button, GTK_ALIGN_END);
    set_margin(send_request_button, 5);
    gtk_container_add(GTK_CONTAINER(content), send_request_button);
    g_signal_connect(send_request_button, "clicked", G_CALLBACK(handle_request), content);

    gtk_widget_show_all(content);
    gtk_widget_hide(id_api);
}

void open_load_api_popup(GtkButton *button, gpointer content){

    GtkWidget *popup = gtk_window_new(GTK_WINDOW_TOPLEVEL);
    gtk_window_set_title(GTK_WINDOW(popup), "Charger une API");
    gtk_window_set_default_size(GTK_WINDOW(popup), 400, 200);
    gtk_window_set_position(GTK_WINDOW(popup), GTK_WIN_POS_CENTER);
    gtk_container_set_border_width(GTK_CONTAINER(popup), 10);
    
    GtkWidget *grid = gtk_grid_new();
    gtk_grid_set_row_spacing(GTK_GRID(grid), 5);
    gtk_grid_set_column_spacing(GTK_GRID(grid), 5);
    gtk_container_add(GTK_CONTAINER(popup), grid);
    
    GtkWidget *api_name_label = gtk_label_new("Nom de l'API");
    gtk_grid_attach(GTK_GRID(grid), api_name_label, 0, 0, 1, 1);

    GtkWidget *api_name_combo_box = gtk_combo_box_text_new();
    gtk_grid_attach(GTK_GRID(grid), api_name_combo_box, 1, 0, 1, 1);

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
    }

    if (mysql_query(conn, "SELECT * FROM api"))
    {
        fprintf(stderr, "%s\n", mysql_error(conn));
    }

    res = mysql_use_result(conn);

    while ((row = mysql_fetch_row(res)) != NULL)
    {
        char *id = row[0];
        char *name = row[1];
        char *id_name = malloc(strlen(id) + strlen(name) + 4);
        strcpy(id_name, id);
        strcat(id_name, " - ");
        strcat(id_name, name);
        gtk_combo_box_text_append_text(GTK_COMBO_BOX_TEXT(api_name_combo_box), id_name);
    }

    mysql_free_result(res);
    mysql_close(conn);

    LoadApiParams *params = malloc(sizeof(LoadApiParams));
    params->content = content; 
    params->combo_box = api_name_combo_box;

    GtkWidget *load_api_button = gtk_button_new_with_label("Charger l'API");
    gtk_grid_attach(GTK_GRID(grid), load_api_button, 1, 1, 1, 1);
    g_signal_connect_data(load_api_button, "clicked", G_CALLBACK(load_api), params, params_destroy_notify, 0);

    gtk_widget_show_all(popup);
}

void load_api(GtkButton *button, gpointer data)
{
    LoadApiParams *params = (LoadApiParams *)data;
    GtkWidget *content = params->content;
    GtkWidget *combo_box = params->combo_box;

    gchar *api_name = gtk_combo_box_text_get_active_text(GTK_COMBO_BOX_TEXT(combo_box));
    char *api_id = strtok(api_name, " - ");

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
    }

    char query[100] = "SELECT * FROM api WHERE id_api = ";
    strcat(query, api_id);

    if (mysql_query(conn, query))
    {
        fprintf(stderr, "%s\n", mysql_error(conn));
    }

    res = mysql_use_result(conn);

    row = mysql_fetch_row(res);

    char *api_id_db = row[0];
    char *api_name_db = row[1];
    char *api_method = row[2];
    char *api_url = row[3];
    char *api_key = row[4];

    GtkWidget *id_api = gtk_container_get_children(GTK_CONTAINER(content))->next->data;
    GtkWidget *api_name_parent = gtk_container_get_children(GTK_CONTAINER(content))->next->next->next->data;
    GtkWidget *api_name_widget = gtk_container_get_children(GTK_CONTAINER(api_name_parent))->data;
    GtkWidget *select_box_parent = gtk_container_get_children(GTK_CONTAINER(content))->next->next->next->data;
    GtkWidget *select_box_widget = gtk_container_get_children(GTK_CONTAINER(select_box_parent))->next->data;
    GtkWidget *url_widget = gtk_container_get_children(GTK_CONTAINER(content))->next->next->next->next->data;
    GtkWidget *api_key_widget = gtk_container_get_children(GTK_CONTAINER(content))->next->next->next->next->next->data;

    gtk_entry_set_text(GTK_ENTRY(id_api), api_id_db);
    gtk_entry_set_text(GTK_ENTRY(api_name_widget), api_name_db);
    gtk_combo_box_set_active(GTK_COMBO_BOX(select_box_widget), atoi(api_method));
    gtk_entry_set_text(GTK_ENTRY(url_widget), api_url);

    if (api_key == NULL)
    {
        api_key = "";
    }
    gtk_entry_set_text(GTK_ENTRY(api_key_widget), api_key);

    mysql_free_result(res);
    mysql_close(conn);

    gtk_widget_destroy(gtk_widget_get_parent(gtk_widget_get_parent(button)));
}

void handle_request(GtkButton *button, gpointer content)
{
    const gchar *id_api_entry, *api_name_entry, *method_entry, *url_entry, *api_key_entry;

    GtkWidget *id_api = gtk_container_get_children(GTK_CONTAINER(content))->next->data;
    GtkWidget *api_name_parent = gtk_container_get_children(GTK_CONTAINER(content))->next->next->next->data;
    GtkWidget *api_name = gtk_container_get_children(GTK_CONTAINER(api_name_parent))->data;
    GtkWidget *select_box_parent = gtk_container_get_children(GTK_CONTAINER(content))->next->next->next->data;
    GtkWidget *select_box = gtk_container_get_children(GTK_CONTAINER(select_box_parent))->next->data;

    GtkWidget *url = gtk_container_get_children(GTK_CONTAINER(content))->next->next->next->next->data;
    GtkWidget *api_key = gtk_container_get_children(GTK_CONTAINER(content))->next->next->next->next->next->data;

    id_api_entry = gtk_entry_get_text(GTK_ENTRY(id_api));
    api_name_entry = gtk_entry_get_text(GTK_ENTRY(api_name));
    method_entry = gtk_combo_box_text_get_active_text(GTK_COMBO_BOX_TEXT(select_box));
    url_entry = gtk_entry_get_text(GTK_ENTRY(url));
    api_key_entry = gtk_entry_get_text(GTK_ENTRY(api_key));

    CURL *curl;
    CURLcode res;
    json_t *root;
    json_error_t error;
    char responseStr[4096] = {0};

    curl = curl_easy_init();
    if (curl)
    {
        curl_easy_setopt(curl, CURLOPT_URL, url_entry);
        curl_easy_setopt(curl, CURLOPT_FOLLOWLOCATION, 1L);
        curl_easy_setopt(curl, CURLOPT_SSL_VERIFYPEER, 0L);
        curl_easy_setopt(curl, CURLOPT_WRITEFUNCTION, writeCallback);
        curl_easy_setopt(curl, CURLOPT_WRITEDATA, responseStr);

        // change the method
        if (strcmp(method_entry, "GET") == 0)
        {
            curl_easy_setopt(curl, CURLOPT_HTTPGET, 1L);
        }
        else if (strcmp(method_entry, "POST") == 0)
        {
            curl_easy_setopt(curl, CURLOPT_POST, 1L);
        }

        res = curl_easy_perform(curl);
        if (res != CURLE_OK)
            fprintf(stderr, "curl_easy_perform() failed: %s\n", curl_easy_strerror(res));
        else
        {

            root = json_loads(responseStr, 0, &error);
            if (!root)
            {
                fprintf(stderr, "error: on line %d: %s\n", error.line, error.text);
                return;
            }

            // ajouter la reponse dans le treeview
            GtkWidget *response_window = gtk_window_new(GTK_WINDOW_TOPLEVEL);
            gtk_window_set_title(GTK_WINDOW(response_window), "Résultat de la requête");
            GError *error = NULL;
            GdkPixbuf *icon = gdk_pixbuf_new_from_file("assets/images/logo.png", &error);
            gtk_window_set_default_size(GTK_WINDOW(response_window), 800, 600);
            gtk_window_set_position(GTK_WINDOW(response_window), GTK_WIN_POS_CENTER);
            gtk_container_set_border_width(GTK_CONTAINER(response_window), 10);

            GtkWidget *response_grid = gtk_grid_new();
            gtk_grid_set_row_spacing(GTK_GRID(response_grid), 5);
            gtk_grid_set_column_spacing(GTK_GRID(response_grid), 5);
            gtk_container_add(GTK_CONTAINER(response_window), response_grid);

            GtkWidget *response_scroll = gtk_scrolled_window_new(NULL, NULL);
            gtk_widget_set_hexpand(response_scroll, TRUE);
            gtk_widget_set_vexpand(response_scroll, TRUE);
            gtk_grid_attach(GTK_GRID(response_grid), response_scroll, 0, 0, 1, 1);

            GtkWidget *response_text = gtk_text_view_new();
            gtk_text_view_set_editable(GTK_TEXT_VIEW(response_text), FALSE);
            gtk_text_view_set_cursor_visible(GTK_TEXT_VIEW(response_text), FALSE);
            gtk_container_add(GTK_CONTAINER(response_scroll), response_text);

            GtkTextBuffer *response_buffer = gtk_text_view_get_buffer(GTK_TEXT_VIEW(response_text));

            GtkTextIter start, end;
            gtk_text_buffer_get_start_iter(response_buffer, &start);
            gtk_text_buffer_get_end_iter(response_buffer, &end);

            gtk_text_buffer_insert(response_buffer, &end, responseStr, -1);

            gtk_widget_show_all(response_window);
        }

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
        }

        addLog(conn, atoi(id_api_entry), "Requete");

        curl_easy_cleanup(curl);
    }
}
