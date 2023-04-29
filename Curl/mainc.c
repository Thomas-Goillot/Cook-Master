#include <gtk/gtk.h>

int main(int argc, char *argv[])
{
    GtkBuilder *builder;
    GtkWidget *window;
    GtkWidget *grid;
    GtkWidget *card1_frame;
    GtkWidget *card1_label;
    GtkWidget *card2_frame;
    GtkWidget *card2_label;
    GtkWidget *card3_frame;
    GtkWidget *card3_label;
    GtkCssProvider *css_provider;

    gtk_init(&argc, &argv);

    // Chargement de l'interface utilisateur à partir d'un fichier Glade
    builder = gtk_builder_new_from_file("interface.glade");

    // Récupération des widgets de la fenêtre
    window = GTK_WIDGET(gtk_builder_get_object(builder, "window"));
    grid = GTK_WIDGET(gtk_builder_get_object(builder, "grid"));
    card1_frame = GTK_WIDGET(gtk_builder_get_object(builder, "card1_frame"));
    card1_label = GTK_WIDGET(gtk_builder_get_object(builder, "card1_label"));
    card2_frame = GTK_WIDGET(gtk_builder_get_object(builder, "card2_frame"));
    card2_label = GTK_WIDGET(gtk_builder_get_object(builder, "card2_label"));
    card3_frame = GTK_WIDGET(gtk_builder_get_object(builder, "card3_frame"));
    card3_label = GTK_WIDGET(gtk_builder_get_object(builder, "card3_label"));

    // Configuration de la classe CSS pour les bords arrondis
    css_provider = gtk_css_provider_new();
    gtk_css_provider_load_from_data(css_provider, ".rounded-frame { border-radius: 10px; }", -1, NULL);
    gtk_style_context_add_provider_for_screen(gdk_screen_get_default(), GTK_STYLE_PROVIDER(css_provider), GTK_STYLE_PROVIDER_PRIORITY_APPLICATION);

    // Configuration des cartes avec du texte
    gtk_label_set_text(GTK_LABEL(card1_label), "Contenu de la carte 1");
    gtk_label_set_text(GTK_LABEL(card2_label), "Contenu de la carte 2");
    gtk_label_set_text(GTK_LABEL(card3_label), "Contenu de la carte 3");

    // Configuration de la carte 1 pour occuper toute la largeur de la fenêtre
    gtk_widget_set_size_request(card1_frame, 600, -1);
    gtk_frame_set_shadow_type(GTK_FRAME(card1_frame), GTK_SHADOW_NONE);

    // Affichage de la fenêtre et boucle principale de GTK
    gtk_widget_show_all(window);
    gtk_main();

    return 0;
}