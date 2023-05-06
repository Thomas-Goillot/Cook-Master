#include <gtk/gtk.h>
#include <curl/curl.h>
#include <jansson.h>
#include <string.h>
#include <mysql.h>

#include "../includes/ui.h"
#include "../includes/json.h"

#include "../includes/requestPage.h"
#include "../includes/apiListePage.h"



void on_button3_clicked(GtkButton *button, gpointer user_data)
{
    g_print("Button 3 clicked\n");
}

void on_button4_clicked(GtkButton *button, gpointer user_data)
{
    g_print("Button 4 clicked\n");
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