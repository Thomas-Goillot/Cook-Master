#ifndef DEF_HEADER_REQUESTPAGE
#define DEF_HEADER_REQUESTPAGE

#include <gtk/gtk.h>
#include <curl/curl.h>
#include <jansson.h>
#include <string.h>

#include "ui.h"
#include "json.h"
#include "sql.h"

typedef struct
{
    GtkWidget *content;
    GtkWidget *combo_box;
} LoadApiParams;

void handle_request(GtkButton *button, gpointer content);

void make_request_page(GtkButton *button, gpointer content);

void open_load_api_popup(GtkButton *button, gpointer content);

void load_api(GtkButton *button, gpointer data);

#endif