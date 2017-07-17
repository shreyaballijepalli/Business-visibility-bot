**WORK IN PROGRESS**

A chatbot with conversation and personalization using IBM API.

For running the application go to the directory and run the command node app.

If the database is updated run the command node update and import the chat.json file in the workspace.

For convinience I have currently included my username,password and workspace id in the .env file. 

But later you need to create your own service and include those details in the .env file.

You will have to include the mysql database password in the following files:

In sql.php file line number 461,
   app.js line number 95

In users.js in routes folder line number 15

Currently as no users were logged in yet the suggestions box will be empty.

 
