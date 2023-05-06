#include "../includes/requestPage.h"

void make_request_page(GtkButton *button, gpointer content)
{
    clear_container(content);

    create_title(content, "Faire une requête");

    GtkWidget *api_name = gtk_entry_new();
    gtk_entry_set_placeholder_text(GTK_ENTRY(api_name), "Enter Api name");
    gtk_widget_set_name(api_name, "api_name");
    set_margin(api_name, 5);

    GtkWidget *select_box = gtk_combo_box_text_new();
    gtk_combo_box_text_append_text(GTK_COMBO_BOX_TEXT(select_box), "GET");
    gtk_combo_box_text_append_text(GTK_COMBO_BOX_TEXT(select_box), "POST");
    gtk_widget_set_name(select_box, "select_box");
    set_margin(select_box, 5);

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

    // add a button on the right
    GtkWidget *send_request_button = gtk_button_new_with_label("Envoyer la requête");
    gtk_widget_set_halign(send_request_button, GTK_ALIGN_END);
    gtk_widget_set_valign(send_request_button, GTK_ALIGN_END);
    set_margin(send_request_button, 5);
    gtk_container_add(GTK_CONTAINER(content), send_request_button);

    g_signal_connect(send_request_button, "clicked", G_CALLBACK(handle_request), content);

    gtk_widget_show_all(content);
}

void handle_request(GtkButton *button, gpointer content)
{
    const gchar *api_name_entry, *method_entry, *url_entry, *api_key_entry;

    GtkWidget *api_name_parent = gtk_container_get_children(GTK_CONTAINER(content))->next->data;
    GtkWidget *api_name = gtk_container_get_children(GTK_CONTAINER(api_name_parent))->data;
    GtkWidget *select_box_parent = gtk_container_get_children(GTK_CONTAINER(content))->next->data;
    GtkWidget *select_box = gtk_container_get_children(GTK_CONTAINER(select_box_parent))->next->data;
    GtkWidget *url = gtk_container_get_children(GTK_CONTAINER(content))->next->next->data;
    GtkWidget *api_key = gtk_container_get_children(GTK_CONTAINER(content))->next->next->next->data;

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

        curl_easy_cleanup(curl);
    }
}
