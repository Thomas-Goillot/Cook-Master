#include <curl/curl.h>
#include <stdio.h>
#include <string.h>

int main(int argc, char *argv[])
{
    CURL *curl;
    CURLcode res;


    char url[300];
    printf("Enter the url: ");
    scanf("%s", url);

    // if the url == "exit" then break the loop
    // https://api.spoonacular.com/food/ingredients/9266/information?apiKey=7c54efd616d54ef88364d744339b3601

    while (strcmp(url, "exit") != 0)
    {
        curl = curl_easy_init();
        if (curl)
        {

            curl_easy_setopt(curl, CURLOPT_URL, url);
            /* example.com is redirected, so we tell libcurl to follow redirection */
            curl_easy_setopt(curl, CURLOPT_FOLLOWLOCATION, 1L);

            /* Perform the request, res will get the return code */
            res = curl_easy_perform(curl);

            /* Check for errors */
            if (res != CURLE_OK){
                fprintf(stderr, "curl_easy_perform() failed: %s\n", curl_easy_strerror(res));
            }

            curl_easy_cleanup(curl);
        }

        printf("\nEnter the url: ");
        scanf("%s", url);
    }
        
    return 0;
}