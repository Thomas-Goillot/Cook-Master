#ifndef DEF_HEADER_APILISTEPAGE
#define DEF_HEADER_APILISTEPAGE

#include <gtk/gtk.h>
#include <curl/curl.h>
#include <jansson.h>
#include <string.h>
#include <mysql.h>

#include "ui.h"
#include "json.h"

void api_list_page(GtkButton *button, gpointer content);

#endif