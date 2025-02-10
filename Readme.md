# Faceoff Statistics

FO Stats is a website dedicated to tracking the performance of the faceoff specialists on the Florida State University Mens club lacrosse team.

## Features

### Home:
- Quickly and easily view recent and upcoming games.
- View statistics leaders for total faceoff wins, win percentage, and ground balls.

### Players:
- View list of all faceoff designated players and their running total statistics.
- Selecting a player brings you to a breakdown of all their game perforamnces and associated statistics.

### Games:
- View list of all previous and upcoming games for the season and the overall faceoff statistics for each.
- Selecting a game brings you to a breakdown of every player performance from that game and their associated statistics.

### Admin:
Provides a content management system to easily create, edit, and remove:
- Faceoff players
- Game performances
- Game events
- Seasons

## Installation

### Dependecies
* [Apache](https://httpd.apache.org/) (Webserver)
* [MariaDB](https://mariadb.org/) or [MySQL](https://www.mysql.com/) (Database)

### Clone the repository
```bash
git clone https://github.com/wcouture/FO-Stats-PHP.git
```

### Configure Apache 
Modify the <i>httpd.conf</i> apache configuration file to set the root directory to the cloned respository. ("{<i>PATH_TO_CLONED_REPOSITORY</i>}/FO-Stats-PHP/")<br>

<i>If installed through a package manager, httpd.conf will likely be in one of the following locations:</i>
* /etc/apache2/httpd.conf
* /etc/apache2/apache2.conf
* /etc/httpd/httpd.conf
* /etc/httpd/conf/httpd.conf

Additionally configure your domain name within httpd.conf and SSL certificates within ssl.conf, located within the conf.d directory within the httpd or apache2 directory, if desired.

### Initialize Database
Use the following command to execute an SQL script that will configure all necessary users, databases, and tables.
```bash
mariadb < {PATH_TO_REPOSITORY}/FO-Stats-PHP/docs/sql_table_declarations.sql
```
or
```bash
mysql < {PATH_TO_REPOSITORY}/FO-Stats-PHP/docs/sql_table_declarations.sql
```

### Start Apache Server
<i>The following commands demonstrate how to start, stop, and restart the webserver on a linux distribution.</i><br>

Start:
```bash
sudo systemctl start httpd
```
Stop:
```bash
sudo systemctl stop httpd
```
Restart:
```bash
sudo systemctl restart httpd
```

## Usage
Navigate to http(s)://localhost or http(s)://{YOUR_DOMAIN} if a domain is configured to access the website.

### Access Admin CMS
To reach the admin cms panel, navigate to http(s)://localhost/admin or http(s)://{YOUR_DOMAIN}/admin where you will view a login form.<br>The default admin username is "admin" and the default admin password is "fogo". These can both be modified within the admin panel.

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)