#ifndef DEF_HEADER_SETTINGPAGE
#define DEF_HEADER_SETTINGPAGE

#include <gtk/gtk.h>
#include <curl/curl.h>
#include <jansson.h>
#include <string.h>
#include <mysql.h>

#include "ui.h"
#include "json.h"

void check_input(GtkButton *button, gpointer content);

void setting_page(GtkButton *button, gpointer content);

void save_api(char *name, char *method, char *url, char *api_key, gpointer content);

#endif