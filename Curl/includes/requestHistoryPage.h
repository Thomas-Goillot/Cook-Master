#ifndef DEF_HEADER_REQUESTHISTORYPAGE
#define DEF_HEADER_REQUESTHISTORYPAGE

#include <gtk/gtk.h>
#include <curl/curl.h>
#include <jansson.h>
#include <string.h>
#include <mysql.h>

#include "ui.h"
#include "json.h"

void request_history_page(GtkButton *button, gpointer content);

#endif