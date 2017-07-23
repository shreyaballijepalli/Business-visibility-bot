**WORK IN PROGRESS**

A chatbot with conversation and personalization using IBM API.

Creating database and tables:

Login into mysql using mysql -u root -p

Then give the following commands:

CREATE DATABASE IF NOT EXISTS USERS;                   -- for creating database USERS;

use USERS;

CREATE TABLE sql_table(
             Ticket_Number VARCHAR(100),
             Assigned_To   VARCHAR(100) , 
             Account_Name  VARCHAR(100) , 
             Severity VARCHAR(100), 
             Service_Offering VARCHAR(100), 
             Additional_Info1 VARCHAR(100), 
             Additional_Info2 VARCHAR(100), 
             Category  VARCHAR(100), 
             Status  VARCHAR(100), 
             Last_Status_Modified  VARCHAR(100), 
             Date_Created_Format  VARCHAR(100), 
            Date_Last_Modified_Format  VARCHAR(100), 
            Response_Date_Format  VARCHAR(100), 
            Date_Closed_Format  VARCHAR(100), 
            PER_Phase_Date_Format  VARCHAR(100), 
            Parent_Ticket_Number  VARCHAR(100), 
            Child_Ticket_Number  VARCHAR(100), 
            PER_Phase  VARCHAR(100), 
            Production_Implementation_Tracking  VARCHAR(100), 
            Summary  VARCHAR(100), 
            Time_Spent  INT, 
             Age INT); 

LOAD DATA LOCAL INFILE 'report.csv' INTO TABLE sql_table FIELDS TERMINATED BY ',' ENCLOSED BY '"'  LINES TERMINATED BY '\n' IGNORE 4 LINES;
You need to mention the complete path of your .csv file or .txt file that you are importing into the database.

Make sure that the csv file doesnot have any extra spaces.

CREATE TABLE IF NOT EXISTS sql_customers( 
         id INT, 
         Question VARCHAR(100) ); 

CREATING THE CONVERSATION SERVICE:
You can create a workspace in any existing instance of the conversation service.Otherwise run the following commands:

cf login

cf create-service conversation free my-conversation-service

Navigate to your Bluemix console https://console.ng.bluemix.net/dashboard/services.

Select the newly created conversation-service.

On Service Details page select Launch Tool.

Then create a workspace.

Configuring the app environment:

Create a service key  in the format cf create-service-key <service_instance> <service_key>. For example:

cf create-service-key my-conversation-service myKey

Retrieve the credentials from the service key using the command cf service-key <service_instance> <service_key>. For example:

cf service-key my-conversation-service myKey

The output from this command is a JSON object, as in this example:

{
  "password": "87iT7aqpvU7l",
  "url": "https://gateway.watsonplatform.net/conversation/api",
  "username": "ca2905e6-7b5d-4408-9192-e4d54d83e604"
}

Paste the password and username values (without quotation marks) from the JSON into the CONVERSATION_PASSWORD and CONVERSATION_USERNAME variables in the .env file. For example:

CONVERSATION_USERNAME=ca2905e6-7b5d-4408-9192-e4d54d83e604
CONVERSATION_PASSWORD=87iT7aqpvU7l

Now get the workspace id of the newly created workspace and paste it into  WORKSPACE_ID variable in the .env file.

You need to paste the username,password and workspace id in the update.js file also.

Line number : 22
curl -H "Content-Type: application/json" -X POST -u "USERNAME":"PASSWORD" --data-binary @chat.json "https://gateway.watsonplatform.net/conversation/api/v1/workspaces/WORKSPACE_ID?version=2017-05-26"

You can run app.js to run the application.
Run update.js to update the workspace whenever you are updating the database.

You can change the time of the timeout in the views/index.handlebars.



 
