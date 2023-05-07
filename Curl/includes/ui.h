#ifndef DEF_HEADER_UI
#define DEF_HEADER_UI

#include <gtk/gtk.h>

#include "../includes/requestPage.h"
#include "../includes/apiListePage.h"
#include "../includes/requestHistoryPage.h"
#include "../includes/settingsPage.h"

void generate_sidebar(GtkWidget *grid, GtkWidget *content, GtkWidget *sidebar, GtkWidget *title);

void set_margin(GtkWidget *widget, int value);

void clear_container(GtkWidget *container);

void create_title(GtkWidget *content, char *title_text);

void send_popup(GtkWidget *content, char *message, char *title);

void params_destroy_notify(gpointer data, GClosure *closure);

#endif