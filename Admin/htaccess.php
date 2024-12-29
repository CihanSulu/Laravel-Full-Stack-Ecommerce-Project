RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]


<IfModule mod_rewrite.c>
   RewriteEngine On 
   RewriteRule ^(.*)$ public/$1 [L]
</IfModule>

# php -- BEGIN cPanel-generated handler, do not edit
# “ea-php73” paketini varsayılan “PHP” programlama dili olarak ayarlayın.
<IfModule mime_module>
  AddHandler application/x-httpd-ea-php73 .php .php7 .phtml
</IfModule>
# php -- END cPanel-generated handler, do not edit
