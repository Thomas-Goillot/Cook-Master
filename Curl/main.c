#include <stdio.h>
#include <Curl/curlLib/include/curl/curl.h>

int main(void)
{
    CURL *curl;
    CURLcode res;

    // Initialisation de la bibliothèque cURL
    curl_global_init(CURL_GLOBAL_DEFAULT);

    // Création de l'objet cURL
    curl = curl_easy_init();
    if (curl)
    {
        // Configuration de l'URL à requêter
        curl_easy_setopt(curl, CURLOPT_URL, "https://example.com");

        // Exécution de la requête HTTP GET
        res = curl_easy_perform(curl);
        if (res != CURLE_OK)
            fprintf(stderr, "Erreur cURL: %s\n", curl_easy_strerror(res));

        // Libération de l'objet cURL
        curl_easy_cleanup(curl);
    }

    // Nettoyage de la bibliothèque cURL
    curl_global_cleanup();

    return 0;
}
