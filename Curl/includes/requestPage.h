#ifndef DEF_HEADER_REQUESTPAGE
#define DEF_HEADER_REQUESTPAGE

#include <gtk/gtk.h>
#include <curl/curl.h>
#include <jansson.h>
#include <string.h>

#include "ui.h"
#include "../includes/json.h"

void handle_request(GtkButton *button, gpointer content);

void make_request_page(GtkButton *button, gpointer content);

#endif