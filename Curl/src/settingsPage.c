#include "../includes/settingsPage.h"

void setting_page(GtkButton *button, gpointer content)
{
    clear_container(content);

    create_title(content, "Enregistrer une nouvelle API");

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
    gtk_widget_set_margin_start(hbox, 15);
    gtk_widget_set_margin_end(hbox, 15);
    gtk_container_add(GTK_CONTAINER(content), hbox);

    GtkWidget *url = gtk_entry_new();
    gtk_entry_set_placeholder_text(GTK_ENTRY(url), "Enter url API");
    set_margin(url, 5);
    gtk_widget_set_name(url, "url");
    gtk_widget_set_margin_start(url, 20);
    gtk_widget_set_margin_end(url, 20);
    gtk_container_add(GTK_CONTAINER(content), url);

    GtkWidget *api_key = gtk_entry_new();
    gtk_entry_set_placeholder_text(GTK_ENTRY(api_key), "Enter Api key (optional if specified in url)");
    set_margin(api_key, 5);
    gtk_widget_set_name(api_key, "api_key");
    gtk_widget_set_margin_start(api_key, 20);
    gtk_widget_set_margin_end(api_key, 20);
    gtk_container_add(GTK_CONTAINER(content), api_key);

    // add a button on the right
    GtkWidget *send_request_button = gtk_button_new_with_label("Enregistrer");
    gtk_widget_set_halign(send_request_button, GTK_ALIGN_END);
    gtk_widget_set_valign(send_request_button, GTK_ALIGN_END);
    gtk_widget_set_margin_start(send_request_button, 20);
    gtk_widget_set_margin_end(send_request_button, 20);
    gtk_container_add(GTK_CONTAINER(content), send_request_button);

    g_signal_connect(send_request_button, "clicked", G_CALLBACK(check_input), content);

    gtk_widget_show_all(content);
}

void check_input(GtkButton *button, gpointer content)
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

    
    if (strlen(api_name_entry) == 0)
    {
        send_popup(content, "Le nom de l'api ne peut pas être vide", "Erreur");
        return;
    }

    if (strlen(api_name_entry) > 100)
    {
        send_popup(content, "Le nom de l'api ne peut pas dépasser 100 caractères", "Erreur");
        return;
    }

    if (strlen(url_entry) == 0)
    {
        send_popup(content, "L'url ne peut pas être vide", "Erreur");
        return;
    }

    if (strlen(url_entry) > 255)
    {
        send_popup(content, "L'url ne peut pas dépasser 255 caractères", "Erreur");
        return;
    }

    if (strlen(api_key_entry) > 255)
    {
        send_popup(content, "La clé d'api ne peut pas dépasser 255 caractères", "Erreur");
        return;
    }

    if (method_entry == NULL)
    {
        send_popup(content, "Vous devez choisir une méthode", "Erreur");
        return;
    }

    save_api(api_name_entry, method_entry, url_entry, api_key_entry, content);
}

void save_api(char *name, char *method, char *url, char *api_key, gpointer content){
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

    char *query = malloc(255 * sizeof(char));
    sprintf(query, "INSERT INTO api (name, http_method, url, api_key) VALUES ('%s', '%s', '%s', '%s')", name, method, url, api_key);
    if (mysql_query(conn, query))
    {
        fprintf(stderr, "%s\n", mysql_error(conn));
    }

    unsigned long id_api = mysql_insert_id(conn);

    addLog(conn, id_api, "Nouvelle API");

    send_popup(content, "L'api a bien été enregistrée", "Succès");

    free(query);

    mysql_close(conn);

    return;
}