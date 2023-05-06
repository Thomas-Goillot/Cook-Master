#include "../includes/ui.h"

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
    GtkWidget *make_request_button = gtk_button_new_with_label("Faire une requête");
    GtkWidget *api_list_button = gtk_button_new_with_label("Listes des APIs");
    GtkWidget *button3 = gtk_button_new_with_label("Historique des requêtes");
    GtkWidget *button4 = gtk_button_new_with_label("Paramètres");
    GtkWidget *button5 = gtk_button_new_with_label("Quitter");
    gtk_container_add(GTK_CONTAINER(sidebar), make_request_button);
    gtk_container_add(GTK_CONTAINER(sidebar), api_list_button);
    gtk_container_add(GTK_CONTAINER(sidebar), button3);
    gtk_container_add(GTK_CONTAINER(sidebar), button4);
    gtk_container_add(GTK_CONTAINER(sidebar), button5);

    /* Connect button signals */
    g_signal_connect(make_request_button, "clicked", G_CALLBACK(make_request_page), content);
    g_signal_connect(api_list_button, "clicked", G_CALLBACK(api_list_page), content);
    //g_signal_connect(button3, "clicked", G_CALLBACK(on_button3_clicked), NULL);
    //g_signal_connect(button4, "clicked", G_CALLBACK(on_button4_clicked), NULL);
    g_signal_connect(button5, "clicked", G_CALLBACK(gtk_main_quit), NULL);
}

void set_margin(GtkWidget *widget, int value)
{
    gtk_widget_set_margin_top(widget, value);
    gtk_widget_set_margin_bottom(widget, value);
    gtk_widget_set_margin_start(widget, value);
    gtk_widget_set_margin_end(widget, value);
}

void clear_container(GtkWidget *container)
{
    GList *children, *iter;
    children = gtk_container_get_children(GTK_CONTAINER(container));
    for (iter = children; iter != NULL; iter = g_list_next(iter))
    {
        gtk_widget_destroy(GTK_WIDGET(iter->data));
    }

    gtk_widget_show_all(container);
}

void create_title(GtkWidget *content, char *title_text)
{
    GtkWidget *title = gtk_label_new(title_text);
    gtk_widget_set_halign(title, GTK_ALIGN_CENTER);
    gtk_widget_set_valign(title, GTK_ALIGN_CENTER);
    gtk_widget_set_hexpand(title, TRUE);
    gtk_widget_set_vexpand(title, FALSE);
    gtk_widget_set_margin_start(title, 10);
    gtk_widget_set_margin_end(title, 10);
    gtk_widget_set_margin_top(title, 10);
    gtk_widget_set_margin_bottom(title, 10);
    PangoFontDescription *font_desc = pango_font_description_from_string("Arial Bold 20");
    gtk_widget_override_font(title, font_desc);
    pango_font_description_free(font_desc);
    gtk_container_add(GTK_CONTAINER(content), title);

    gtk_widget_show_all(content);
}