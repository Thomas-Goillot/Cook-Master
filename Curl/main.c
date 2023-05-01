#include <gtk/gtk.h>



void on_button1_clicked(GtkButton *button, gpointer content)
{
    //create an entry widget with a label and add it to the content
    GtkWidget *entry = gtk_entry_new();
    gtk_entry_set_placeholder_text(GTK_ENTRY(entry), "Enter your name");
    gtk_container_add(GTK_CONTAINER(content), entry);
    gtk_widget_show_all(content);
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
    GtkWidget *button2 = gtk_button_new_with_label("Paramètres");
    GtkWidget *button3 = gtk_button_new_with_label("Listes des APIs");
    GtkWidget *button4 = gtk_button_new_with_label("Historique des requêtes");
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
