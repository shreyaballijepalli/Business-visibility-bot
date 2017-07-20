**WORK IN PROGRESS**

A chatbot with conversation and personalization using IBM API.

Creating database and tables:

Login into mysql using mysql -u root -p

Then give the following commands:

CREATE DATABASE IF NOT EXISTS REPORT_FINAL;                   -- for creating database REPORT_FINAL;

CREATE DATABASE IF NOT EXISTS USERS;         -- for creating database USERS;


use REPORT_FINAL;

CREATE TABLE sql_table(
             Number INT, 
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

use USERS;

CREATE TABLE IF NOT EXISTS sql_customers( 
         id INT, 
         Question VARCHAR(100) ); 

You will have to include the mysql database password in the following files:

In sql.php file line number 461, app.js line number 95

In users.js in routes folder line number 15

Currently as no users were logged in yet the suggestions box will be empty.

You can run app.js to run the application.
Run update.js to update the workspace whenever you are updating the database.

Date and natural language understanding will be updated soon. 
