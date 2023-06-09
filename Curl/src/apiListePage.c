#include "../includes/apiListePage.h"

void api_list_page(GtkButton *button, gpointer content)
{

    clear_container(content);

    create_title(content, "Listes des APIs");

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

    GtkListStore *store = gtk_list_store_new(4, G_TYPE_INT, G_TYPE_STRING, G_TYPE_STRING, G_TYPE_STRING);

    GtkTreeIter iter;

    while ((row = mysql_fetch_row(res)) != NULL)
    {
        int id = atoi(row[0]);
        char *name = row[1];
        char *url = row[2];
        char *method = row[3];

        gtk_list_store_append(store, &iter);
        gtk_list_store_set(store, &iter, 0, id, 1, name, 2, url, 3, method, -1);
    }

    // Création d'un widget GtkTreeView pour afficher le modèle de données
    GtkWidget *treeview = gtk_tree_view_new_with_model(GTK_TREE_MODEL(store));

    // Création des colonnes avec leurs titres
    GtkTreeViewColumn *id_column = gtk_tree_view_column_new_with_attributes("ID", gtk_cell_renderer_text_new(), "text", 0, NULL);
    GtkTreeViewColumn *name_column = gtk_tree_view_column_new_with_attributes("Nom", gtk_cell_renderer_text_new(), "text", 1, NULL);
    GtkTreeViewColumn *http_method_column = gtk_tree_view_column_new_with_attributes("Methode HTTP", gtk_cell_renderer_text_new(), "text", 2, NULL);
    GtkTreeViewColumn *url_column = gtk_tree_view_column_new_with_attributes("Url", gtk_cell_renderer_text_new(), "text", 3, NULL);

    // Ajout des colonnes au tableau
    gtk_tree_view_append_column(GTK_TREE_VIEW(treeview), id_column);
    gtk_tree_view_append_column(GTK_TREE_VIEW(treeview), name_column);
    gtk_tree_view_append_column(GTK_TREE_VIEW(treeview), http_method_column);
    gtk_tree_view_append_column(GTK_TREE_VIEW(treeview), url_column);

    // Ajout du tableau à un conteneur parent
    // Ici, nous utilisons un conteneur de type GtkScrolledWindow pour pouvoir faire défiler les entrées du tableau
    GtkWidget *scroll = gtk_scrolled_window_new(NULL, NULL);
    gtk_widget_set_size_request(scroll, -1, 600);
    gtk_container_add(GTK_CONTAINER(scroll), treeview);
    gtk_container_add(GTK_CONTAINER(content), scroll);

    // Affichage du conteneur parent
    gtk_widget_show_all(content);

    mysql_free_result(res);
    mysql_close(conn);
}