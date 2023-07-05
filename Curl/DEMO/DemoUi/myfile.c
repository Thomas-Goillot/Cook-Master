#include <gtk/gtk.h>
#include <stdio.h>

GtkWidget *window; // main window
GtkLabel *mylabel; // label

G_MODULE_EXPORT void exit_app(); // exit app
G_MODULE_EXPORT void button_clicked(); // button clicked

int main(int argc, char *argv[])
{
    GtkBuilder *builder; // builder
    gtk_init(&argc, &argv); // init gtk

    builder = gtk_builder_new(); // create new builder
    gtk_builder_add_from_file(builder, "myui.glade", NULL); // load glade file

    window = GTK_WIDGET(gtk_builder_get_object(builder, "MyWindow")); // get main window
    mylabel = GTK_LABEL(gtk_builder_get_object(builder, "MyLabel")); // get label

    gtk_builder_connect_signals(builder, NULL); // connect signals
    g_object_unref(builder); // free builder

    gtk_widget_show_all(window); // show window
    gtk_main(); // main loop

    return 0;
}

void exit_app(){
    printf("Exit\n");
    gtk_main_quit();
}

void button_clicked(){
    printf("Button clicked\n");
    gtk_label_set_text(mylabel, "Hello World!");
}