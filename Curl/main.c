#include <gtk/gtk.h>
#include <curl/curl.h>
#include <jansson.h>
#include <string.h>

void set_margin(GtkWidget *widget, int value)
{
    gtk_widget_set_margin_top(widget, value);
    gtk_widget_set_margin_bottom(widget, value);
    gtk_widget_set_margin_start(widget, value);
    gtk_widget_set_margin_end(widget, value);
}

void handle_request(GtkButton *button, gpointer content);

void on_button1_clicked(GtkButton *button, gpointer content)
{
    GtkWidget *api_name = gtk_entry_new();
    gtk_entry_set_placeholder_text(GTK_ENTRY(api_name), "Enter Api name");
    gtk_widget_set_name(api_name, "api_name");
    set_margin(api_name, 5);

    GtkWidget *select_box = gtk_combo_box_text_new();
    gtk_combo_box_text_append_text(GTK_COMBO_BOX_TEXT(select_box), "GET");
    gtk_combo_box_text_append_text(GTK_COMBO_BOX_TEXT(select_box), "POST");
    gtk_widget_set_name(select_box, "select_box");
    set_margin(select_box, 5);

    //create a horizontal box to hold the widgets
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

    //add a button on the right 
    GtkWidget *send_request_button = gtk_button_new_with_label("Envoyer la requête");
    gtk_widget_set_halign(send_request_button, GTK_ALIGN_END);
    gtk_widget_set_valign(send_request_button, GTK_ALIGN_END);
    set_margin(send_request_button, 5);
    gtk_container_add(GTK_CONTAINER(content), send_request_button);

    g_signal_connect(send_request_button, "clicked", G_CALLBACK(handle_request), content);

    gtk_widget_show_all(content);
}

size_t writeCallback(char *ptr, size_t size, size_t nmemb, void *userdata)
{

    // Calculer la taille réelle des données
    size_t realSize = size * nmemb;

    char *responseStr = (char *)userdata;

    // Ajouter les nouvelles données à la fin de la chaîne
    strcat(responseStr, ptr);

    return realSize;
}

json_t *getValueFromJson(json_t *root, const char *key)
{
    if (!json_is_object(root))
    {
        fprintf(stderr, "Le JSON fourni n'est pas un objet.\n");
        return NULL;
    }

    json_t *value = NULL;
    const char *objKey;

    json_object_foreach(root, objKey, value)
    {
        if (strcmp(key, objKey) == 0)
        {
            return value;
        }
        else if (json_is_object(value))
        {
            json_t *innerValue = getValueFromJson(value, key);
            if (innerValue != NULL)
            {
                return innerValue;
            }
        }
        else if (json_is_array(value))
        {
            size_t arrSize = json_array_size(value);
            for (size_t i = 0; i < arrSize; i++)
            {
                json_t *innerValue = getValueFromJson(json_array_get(value, i), key);
                if (innerValue != NULL)
                {
                    return innerValue;
                }
            }
        }
    }

    return NULL;
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

        //change the method
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

            //ajouter la reponse dans le treeview
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

void on_button2_clicked(GtkButton *button, gpointer user_data)
{
    g_print("Button 2 clicked\n");
}

void on_button3_clicked(GtkButton *button, gpointer user_data)
{
    g_print("Button 3 clicked\n");
}

void on_button4_clicked(GtkButton *button, gpointer user_data)
{
    g_print("Button 4 clicked\n");
}

void generate_sidebar(GtkWidget *grid, GtkWidget *content, GtkWidget *sidebar, GtkWidget *title)
{
    /* Create a new sidebar */
    sidebar = gtk_button_box_new(GTK_ORIENTATION_VERTICAL);
    gtk_widget_set_hexpand(sidebar, FALSE);
    gtk_widget_set_vexpand(sidebar, TRUE);
    gtk_widget_set_margin_start(sidebar, 10);
    gtk_widget_set_margin_end(sidebar, 10);
    gtk_widget_set_margin_top(sidebar, 10);
    gtk_widget_set_margin_bottom(sidebar, 10);
    gtk_grid_attach(GTK_GRID(grid), sidebar, 0, 0, 1, 1);

    /* Create a new title */
    title = gtk_label_new("Cook Master");
    gtk_widget_set_halign(title, GTK_ALIGN_CENTER);
    gtk_widget_set_valign(title, GTK_ALIGN_CENTER);
    gtk_widget_set_hexpand(title, TRUE);
    gtk_widget_set_vexpand(title, FALSE);
    gtk_widget_set_margin_start(title, 10);
    gtk_widget_set_margin_end(title, 10);
    gtk_widget_set_margin_top(title, 10);
    gtk_widget_set_margin_bottom(title, 10);
    PangoFontDescription *font_desc = pango_font_description_from_string("Arial Bold 30");
    gtk_widget_override_font(title, font_desc);
    pango_font_description_free(font_desc);
    gtk_container_add(GTK_CONTAINER(sidebar), title);

    /* Create three buttons in the sidebar */
    GtkWidget *button1 = gtk_button_new_with_label("Faire une requête");
    GtkWidget *button2 = gtk_button_new_with_label("Listes des APIs");
    GtkWidget *button3 = gtk_button_new_with_label("Historique des requêtes");
    GtkWidget *button4 = gtk_button_new_with_label("Paramètres");
    GtkWidget *button5 = gtk_button_new_with_label("Quitter");
    gtk_container_add(GTK_CONTAINER(sidebar), button1);
    gtk_container_add(GTK_CONTAINER(sidebar), button2);
    gtk_container_add(GTK_CONTAINER(sidebar), button3);
    gtk_container_add(GTK_CONTAINER(sidebar), button4);
    gtk_container_add(GTK_CONTAINER(sidebar), button5);

    /* Connect button signals */
    g_signal_connect(button1, "clicked", G_CALLBACK(on_button1_clicked), content);
    g_signal_connect(button2, "clicked", G_CALLBACK(on_button2_clicked), NULL);
    g_signal_connect(button3, "clicked", G_CALLBACK(on_button3_clicked), NULL);
    g_signal_connect(button4, "clicked", G_CALLBACK(on_button4_clicked), NULL);
    g_signal_connect(button5, "clicked", G_CALLBACK(gtk_main_quit), NULL);
}

int main(int argc, char *argv[])
{
    GtkWidget *window;
    GtkWidget *grid;
    GtkWidget *sidebar;
    GtkWidget *title;
    GtkWidget *content;

    /* Initialize GTK */
    gtk_init(&argc, &argv);

    /* Create a new window */
    window = gtk_window_new(GTK_WINDOW_TOPLEVEL);
    gtk_window_set_title(GTK_WINDOW(window), "Cook Master Request Api");
    gtk_window_set_default_size(GTK_WINDOW(window), 1500, 800);
    g_signal_connect(G_OBJECT(window), "destroy", G_CALLBACK(gtk_main_quit), NULL);

    /* Load the image file */
    GError *error = NULL;
    GdkPixbuf *icon = gdk_pixbuf_new_from_file("assets/images/logo.png", &error);

    /* Set the window icon */
    gtk_window_set_icon(GTK_WINDOW(window), icon);

    /* Create a new grid */
    grid = gtk_grid_new();
    gtk_container_add(GTK_CONTAINER(window), grid);
    gtk_container_set_border_width(GTK_CONTAINER(grid), 20);

    /* Create a new content area */
    content = gtk_box_new(GTK_ORIENTATION_VERTICAL, 0);
    gtk_widget_set_hexpand(content, TRUE);
    gtk_widget_set_vexpand(content, TRUE);
    gtk_widget_set_margin_start(content, 10);
    gtk_widget_set_margin_end(content, 10);
    gtk_widget_set_margin_top(content, 10);
    gtk_widget_set_margin_bottom(content, 10);
    gtk_grid_attach(GTK_GRID(grid), content, 1, 0, 1, 1);


    GtkWidget *label = gtk_label_new("Bienvenue sur l'application Cook Master Request Api");
    gtk_container_add(GTK_CONTAINER(content), label);

    /* Create a new sidebar */
    generate_sidebar(grid, content, sidebar, title);

    /* Show window and all child widgets */
    gtk_widget_show_all(window);

    /* Start main loop */
    gtk_main();

    return 0;
}