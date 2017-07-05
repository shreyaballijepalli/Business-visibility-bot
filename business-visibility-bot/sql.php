<?php

class Ticket
{
   public $category;
   public $count;
}

function find_time($data_array,$c)
{

   $sum_time = 0;
   $sum_count = 0;
   $ticket_num = array();
  
    
   for($i=0;$i<sizeof($data_array);$i++)
{
    if(is_null($c))
{
    if((search($data_array[$i]['Ticket_Number'],$ticket_num)==0) && strcmp($data_array[$i]['Status'],"Closed")==0)
{
    $sum_time=$sum_time+$data_array[$i]['Time_Spent'];
    $ticket_num[$sum_count] = $data_array[$i]['Ticket_Number'];
    $sum_count++;

}

   
}
   
   if ((search($data_array[$i]['Ticket_Number'],$ticket_num)==0) && strpos($c,$data_array[$i]['Account_Name'])!=false)
{
    if(strcmp($data_array[$i]['Status'],"Closed")==0)
{
    $sum_time=$sum_time+$data_array[$i]['Time_Spent'];
    $ticket_num[$sum_count] = $data_array[$i]['Ticket_Number'];
    $sum_count++;

}


}

}

if($sum_count==0)
return 0;

else
return $sum_time/$sum_count;

}


function search($temp,$array)
{
   for($i=0;$i<sizeof($array);$i++)
{
   if($array[$i]==$temp)
{
    return 1;
}
    

}

return 0;

}



function find_parent_requests($data_array,$c)
{
    $count = 0;

    for($i=0;$i<sizeof($data_array);$i++)
{

    if(is_null($c))
{
    if(strcmp($data_array[$i]['Category'],"S - PER - parent request")==0)
    $count++;

}
    if (strpos($c,$data_array[$i]['Account_Name'])!=false)
{
    if(strcmp($data_array[$i]['Category'],"S - PER - parent request")==0)
    $count++;

}


}

return $count;

}

function find_standard_deviation($data_array,$c)
{
   $sum = 0;
   $count = 0;
   $time = array();

   for($i=0;$i<sizeof($data_array);$i++)
{

    if(is_null($c))
{
    $time[$count] = $data_array[$i]['Time_Spent'];
    $sum = $sum+$time[$count];
    $count++;
                                                      


}
    if (strpos($c,$data_array[$i]['Account_Name'])!=false)
{
     
    $time[$count] = $data_array[$i]['Time_Spent'];
    $sum = $sum+$time[$count];
    $count++;
                                                      

}


}

$mean = $sum/$count;
$variance = 0;


for($i=0;$i<$count;$i++)
{
   $temp = $time[$i]-$mean;
   $variance=$variance+$temp*$temp;
} 

return sqrt($variance/$count);

}

function find_closed_cases($data_array,$c)
{
   

}

function find_new_partners($data_array,$c)
{
   $count = 0;

    for($i=0;$i<sizeof($data_array);$i++)
{

    if(is_null($c))
{
    if(strcmp($data_array[$i]['Category'],"S - PER - New TP")==0)
    $count++;

}
    if (strpos($c,$data_array[$i]['Account_Name'])!=false)
{
    if(strcmp($data_array[$i]['Category'],"S - PER - New TP")==0)
    $count++;

}


}
    

return $count;

}


function find_map_changes($data_array,$c)
{
    $count = 0;

    for($i=0;$i<sizeof($data_array);$i++)
{

    if(is_null($c))
{
    if(strcmp($data_array[$i]['Category'],"S - PER - Map Change")==0)
    $count++;

}
    if (strpos($c,$data_array[$i]['Account_Name'])!=false)
{
    if(strcmp($data_array[$i]['Category'],"S - PER - Map Change")==0)
    $count++;

}


}
    

return $count;

}


function find_new_maps($data_array,$c)
{
   $count = 0;

    for($i=0;$i<sizeof($data_array);$i++)
{

    if(is_null($c))
{
    if(strcmp($data_array[$i]['Category'],"S - PER - New Map")==0)
    $count++;

}
    if (strpos($c,$data_array[$i]['Account_Name'])!=false)
{
    if(strcmp($data_array[$i]['Category'],"S - PER - New Map")==0)
    $count++;

}


}
    

return $count;


}


function find_communication_requests($data_array,$c)
{
    $count = 0;

    for($i=0;$i<sizeof($data_array);$i++)
{

    if(is_null($c))
{
    if(strcmp($data_array[$i]['Category'],"S - PER - Communication")==0)
    $count++;

}
    if (strpos($c,$data_array[$i]['Account_Name'])!=false)
{
    if(strcmp($data_array[$i]['Category'],"S - PER - Communication")==0)
    $count++;

}


}
    

return $count;

}



function find_other($data_array,$c)
{
    $count = 0;
    $other = array("Other","S - Administration","S - Code List Update","S - Communication problem","S - Communications change","S - Configuration changes","S - Data Tracking/Restart","S - Enhancement Request Implementation","S - FYI/Other","S - IBM Outage/instability","S - Info/Question/How To","S - Internal IBM","S - Map Change","S - Map Research","S - Mapping Request","S - Outage non-IBM","S - Proactive Notification","S - Project","S - Reporting","S - Service Request","S - Set up","S - Testing","S - Troubleshoot","");
    

    for($i=0;$i<sizeof($data_array);$i++)
{

    if(is_null($c))
{
    for($j=0;$j<sizeof($other);$j++)
{
    if(strcmp($data_array[$i]['Category'],$other[$j])==0)
    $count++;
}
    
}
    if (strpos($c,$data_array[$i]['Account_Name'])!=false)
{
     for($j=0;$j<sizeof($other);$j++)
{
    if(strcmp($data_array[$i]['Category'],$other[$j])==0)
    $count++;
}
    
    
}


}
    

return $count;

}


function find_tp_contact($data_array,$c)
{
    $count = 0;

    for($i=0;$i<sizeof($data_array);$i++)
{

    if(is_null($c))
{
    if(strcmp($data_array[$i]['Category'],"S - PER TP Contact List Update")==0)
    $count++;

}
    if (strpos($c,$data_array[$i]['Account_Name'])!=false)
{
    if(strcmp($data_array[$i]['Category'],"S - PER TP Contact List Update")==0)
    $count++;

}


}
    

return $count;

}


function find_internal_tickets($data_array,$c)
{
    $count = 0;

    for($i=0;$i<sizeof($data_array);$i++)
{

    if(is_null($c))
{
    if(strcmp($data_array[$i]['Category'],"S - PER - Other")==0)
    $count++;

}
    if (strpos($c,$data_array[$i]['Account_Name'])!=false)
{
    if(strcmp($data_array[$i]['Category'],"S - PER - Other")==0)
    $count++;

}


}
    

return $count;

}


function find_tickets_total($data_array,$c)
{
   $sum = find_new_maps($data_array,$c)+find_parent_requests($data_array,$c)+find_map_changes($data_array,$c)+find_new_partners($data_array,$c)+find_tp_contact($data_array,$c)+find_internal_tickets($data_array,$c)+find_other($data_array,$c)+find_communication_requests($data_array,$c);

return $sum;

}

function find_tickets_category($data_array,$c)
{
    $obj = array();
    $obj[0] = new Ticket();
    $obj[0]->category = "New Map";
    $obj[0]->count = find_new_maps($data_array,$c);
    $obj[1] = new Ticket();
    $obj[1]->category = "Parent Request";
    $obj[1]->count = find_parent_requests($data_array,$c);
    $obj[2] = new Ticket();
    $obj[2]->category = "PER Map Change";
    $obj[2]->count = find_map_changes($data_array,$c);
    $obj[3] = new Ticket();
    $obj[3]->category = "New TP";
    $obj[3]->count = find_new_partners($data_array,$c);
    $obj[4] = new Ticket();
    $obj[4]->category = "PER TP Contact";
    $obj[4]->count = find_tp_contact($data_array,$c);
    $obj[5] = new Ticket();
    $obj[5]->category = "Internal Tickets";
    $obj[5]->count = find_internal_tickets($data_array,$c);
    $obj[6] = new Ticket();
    $obj[6]->category = "Other";
    $obj[6]->count = find_other($data_array,$c);
    $obj[7] = new Ticket();
    $obj[7]->category = "Communication";
    $obj[7]->count = find_communication_requests($data_array,$c);
    
    $tickets = array($obj[0],$obj[1],$obj[2],$obj[3],$obj[4],$obj[5],$obj[6],$obj[7]);

    return $tickets;
   

}

function find_tickets_closed($data_array,$c)
{
    $count = 0;

    for($i=0;$i<sizeof($data_array);$i++)
{

    if(is_null($c))
{
    if(strcmp($data_array[$i]['Status'],"Closed")==0)
    $count++;

}
    if (strpos($c,$data_array[$i]['Account_Name'])!=false)
{
    if(strcmp($data_array[$i]['Status'],"Closed")==0)
    $count++;

}


}
    

return $count;


}

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';



$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die('Database Not Connected. Please Fix the Issue! ' . mysql_error()); 

$sql = 'CREATE DATABASE IF NOT EXISTS REPORT_FINAL';
 
$retval = mysql_query( $sql, $connect );

 if(! $retval ) {
            die('Could not create database: ' . mysql_error());
         }
         echo "Database REPORT_FINAL created successfully\n";

$sql1 = "DROP TABLE IF EXISTS sql_table";

mysql_select_db("REPORT_FINAL");

$retval = mysql_query( $sql1, $connect );

if(! $retval ) {
            die('Could not delete table: ' . mysql_error());
         }
         echo "Table deleted successfully\n";

 $sql2 = "CREATE TABLE sql_table( ".
            "Number INT, ".
            "Ticket_Number VARCHAR(100), ".
            "Assigned_To   VARCHAR(100) , ".
            "Account_Name  VARCHAR(100) , ".
            "Severity VARCHAR(100), ".
            "Service_Offering VARCHAR(100), ".
            "Additional_Info1 VARCHAR(100), ".
            "Additional_Info2 VARCHAR(100), ".
            "Category  VARCHAR(100), ".
            "Status  VARCHAR(100), ".
            "Last_Status_Modified  VARCHAR(100), ".
            "Date_Created_Format  VARCHAR(100), ".
            "Date_Last_Modified_Format  VARCHAR(100), ".
            "Response_Date_Format  VARCHAR(100), ".
            "Date_Closed_Format  VARCHAR(100), ".
            "PER_Phase_Date_Format  VARCHAR(100), ".
            "Parent_Ticket_Number  VARCHAR(100), ".
            "Child_Ticket_Number  VARCHAR(100), ".
            "PER_Phase  VARCHAR(100), ".
            "Production_Implementation_Tracking  VARCHAR(100), ".
            "Summary  VARCHAR(100), ".
            "Time_Spent  INT, ".
            "Age INT); ";

 
mysql_select_db("REPORT_FINAL",$connect);

$retval = mysql_query( $sql2, $connect );


$sql3 = "LOAD DATA LOCAL INFILE 'report.csv' INTO TABLE sql_table FIELDS TERMINATED BY ',' ENCLOSED BY '\"'  LINES TERMINATED BY '\\n' IGNORE 4 LINES ";

$loaddata = mysql_query($sql3,$connect);

$query = "SELECT * FROM sql_table";
 
$res = mysql_query($query,$connect) or die("Query Not Executed " .mysql_error($connect)); 

$data_array = array();

while($rows =mysql_fetch_assoc($res)) 
{ 
   $data_array[] = $rows;                      //data_array for mysql database values
} 

$jsonCont = file_get_contents('test.json');

$content = json_decode($jsonCont,true);          //content for json values

 

$customer = array();


for($i=0;$i<132;$i++)
{
   $customer[$i]= $content['dialog_nodes'][$i+14]['conditions'];
}



$question = array();



for($i=0;$i<132;$i++)
{
$question[$i] = $content['dialog_nodes'][$i+14]['parent'];
}





// if you are adding extra intents then add the number added to 10 must also add values to 40


for($i=0;$i<132;$i++)
{
   
if (strcmp($question[$i],"average time")==0)
{
     $t= find_time($data_array,$customer[$i]);
     $content['dialog_nodes'][$i+14]['output']['text']['values'][0]=json_encode($t);
     //echo $t;

}

else if (strcmp($question[$i],"parent requests")==0)
{
    $p=find_parent_requests($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+14]['output']['text']['values'][0]=json_encode($p);
    
     
}

else if (strcmp($question[$i],"standard deviation")==0)
{
    $p=find_standard_deviation($data_array,$customer[$i]); 
   // echo $p;
    $content['dialog_nodes'][$i+14]['output']['text']['values'][0]=json_encode($p);
    
     
}


/*else if (strcmp($question[$i],"closed cases")==0)
{
    $p=find_closed_cases($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+10]['output']['text']['values'][0]=json_encode($p);
    
     
}*/

else if (strcmp($question[$i],"new partners")==0)
{
    $p=find_new_partners($data_array,$customer[$i]); 
   // echo $p;
    $content['dialog_nodes'][$i+14]['output']['text']['values'][0]=json_encode($p);
    
     
}

else if (strcmp($question[$i],"map changes")==0)
{
    $p=find_map_changes($data_array,$customer[$i]); 
   // echo $p;
    $content['dialog_nodes'][$i+14]['output']['text']['values'][0]=json_encode($p);
    
     
}

else if (strcmp($question[$i],"new maps")==0)
{
    $p=find_new_maps($data_array,$customer[$i]);
    //echo $p; 
    $content['dialog_nodes'][$i+14]['output']['text']['values'][0]=json_encode($p);
    
     
}

else if (strcmp($question[$i],"communication requests")==0)
{
    $p=find_communication_requests($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+14]['output']['text']['values'][0]=json_encode($p);     
}

else if (strcmp($question[$i],"tickets")==0)
{
    $p=find_tickets_total($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+14]['output']['text']['values'][0]=json_encode($p);     
}

else if (strcmp($question[$i],"tickets total")==0)
{
    $p=find_tickets_total($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+14]['output']['text']['values'][0]=json_encode($p);     
}

else if (strcmp($question[$i],"tickets category")==0)
{
    $p=find_tickets_category($data_array,$customer[$i]);
    $content['dialog_nodes'][$i+14]['output']['text']['values'][0]=json_encode($p);     
}

else if (strcmp($question[$i],"tickets closed")==0)
{
    $p=find_tickets_closed($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+14]['output']['text']['values'][0]=json_encode($p);     
}



}

$json = json_encode($content);

file_put_contents('test.json', $json);


mysql_close($connect);





?> 
