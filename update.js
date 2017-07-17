var shell = require('shelljs');

if (!shell.which('git')) {
  shell.echo('Sorry, this script requires git');
  shell.exit(1);
}

shell.exec('sudo \cp  sql.php /var/www/html');
shell.exec('sudo \cp  data.json /var/www/html');
shell.exec('sudo \cp  chat.json /var/www/html');
shell.exec('sudo \cp  report.csv /var/www/html');
shell.exec(' sudo service apache2 restart');

shell.exec('sudo chmod 777 /var/www/html/data.json');
shell.exec('sudo chmod 777 /var/www/html/chat.json');

var execPhp = require('exec-php');

execPhp('/var/www/html/sql.php', function(error, php, outprint){
    
    shell.exec('sudo \cp  /var/www/html/chat.json ./');
});


