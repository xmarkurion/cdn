<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## To make this work you have to do the following steps:

To make this work you have to increase a limit of file upload size in php.ini file.

- Go to the terminal and find  file inside and add / change the following lines:
  - /etc/php/8.2/cli/conf.d# nano 99-custom.ini
    - There add those lines:
    - upload_max_filesize = 1024M 
    - post_max_size = 1024M

- you can check if it works by typing in the terminal:
  - php -i | grep upload_max_filesize
  - php -i | grep post_max_size
- Make sure to add job as the system service
  - sudo nano /etc/systemd/system/queue.service
  - add the following lines:
    - [Unit]
    - Description=Laravel Queue Worker
    - After=network.target
    - [Service]
    - Restart=always
    - ExecStart=/usr/bin/php /var/www/html/artisan queue:work --tries=3
    - [Install]
    - WantedBy=multi-user.target

## License
You can use this as you want, just don't forget to mention me as the author.
