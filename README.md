## Invite New User "ProjectInvitation" to Kanboard
Siehe [Gitlab](https://gitlab.com/ipunkt/officetools/kanboard/projectinvitation)
### Neue Plugin aufbauen
* Gitlab Project anlegen -> siehe die Bilder Local
* Clone Projekt
* Offene Projekt
* PhpStorm  file -> setting -> languages & framworks -> php -> include path dann wähle Kanboard 
 Kanboard runterladen [here](https://kanboard.org).
* `docker-compose.php` vom anderen Plugin in deinem Proj hinzufügen
 Anpassungen:
  ```
  version: '2'
  services:
    kanboard:
      image: kanboard/kanboard:latest
      ports:
        - "80:80"
      volumes:
        - .:/var/www/app/plugins/projectinvitation
      environment:
        DATABASE_URL: mysql://kb:kb-secret@db/kanboard
    pma:
      image: phpmyadmin/phpmyadmin
      ports:
        - "8000:80"
      environment:
        PMA_HOST: db
        PMA_USER: kb
        PMA_PASSWORD: kb-secret
    db:
      image: mariadb:latest
      command: --default-authentication-plugin=mysql_native_password
      environment:
        MYSQL_ROOT_PASSWORD: secret
        MYSQL_DATABASE: kanboard
        MYSQL_USER: kb
        MYSQL_PASSWORD: kb-secret
    rights:
      image: busybox
      command: sh -c 'while true ; do chown -R $${USER_ID}.$${GROUP_ID} /target ; sleep 2s ; done'
      volumes:
        - .:/target
      environment:
        - USER_ID=xxxxx
        - GROUP_ID=xxxxx

  ```

* starte `docker-compose up` und warte 1m dann gehe auf `localhost`

* melde dish Username/ Password ist `admin`

* Neue Projekt anlegen.

*  `Plugin.pnp` vom anderen Proj hinzufügen
  
   ```
    <?php
       
       namespace Kanboard\Plugin\ProjectInvitation;
       
       use Kanboard\Core\Plugin\Base;
       
       class Plugin extends Base
       {
           public function initialize()
           {
                 //@ TODO ADD INIT
           }
       
           public function onStartup()
           {
                //@ TODO ADD TRANSLATION
           }
           public function getPluginName()
           {
                //@ TODO ADD PROJEKT NAME
           }
       
           public function getPluginDescription()
           {
               //@ TODO ADD DESCRIPTION
           }
       
           public function getPluginAuthor()
           {
               //@ TODO ADD INFO
           }
       
           public function getPluginVersion()
           {
               //@ TODO ADD VERSION
           }
       
           public function getPluginHomepage()
           {
                //@ TODO ADD URL
           }
       }
   ```

* In `kanboard/docker/etc/php7/conf.d/local.ini` sollte man `opcache.validate_timestamps = On` änderen und/oder
in Container `docker exec -it CONTAINER_ID bash => cd /etc/php7/conf.d/local.ini` ebenfalls.
