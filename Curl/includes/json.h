#ifndef DEF_HEADER_JSON
#define DEF_HEADER_JSON
#include <jansson.h>
#include <string.h>

size_t writeCallback(char *ptr, size_t size, size_t nmemb, void *userdata);

json_t *getValueFromJson(json_t *root, const char *key);

#endif