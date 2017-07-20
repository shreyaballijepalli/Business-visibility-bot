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
    shell.exec('curl -H "Content-Type: application/json" -X POST -u "59e64644-72af-4bc3-a4e9-af6b9ff01ff2":"lHXAV0sMiGea" --data-binary @chat.json "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/3d4cfeef-e925-4de7-aca2-d403030eceb6?version=2017-05-26"');
});


