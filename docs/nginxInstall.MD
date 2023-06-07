server {

  listen 80;
  server_name cookmaster.ovh www.cookmaster.ovh;

  root /var/www/html;
  index index.php index.html index.nginx-debian.html;
  access_log /var/log/nginx/example_access.log;
  error_log /var/log/nginx/example_error.log;

  location / {
    try_files $uri $uri/ /index.php$is_args$args;
  }

  location ~ \.php$ {
    try_files $uri =404;
    fastcgi_index index.php;
    include fastcgi_params;
    fastcgi_pass unix:/run/php/php8.2-fpm.sock;
    fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
  }

}

https://chat.openai.com/share/f99b2c31-04ff-41cc-8fcf-db3dc02eaa42

https://www.vultr.com/docs/how-to-install-nginx-mariadb--php-lemp-on-debian-11-99568/