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
    $temp = "@client_name:".$data_array[$i]['Account_Name'];
   if ((search($data_array[$i]['Ticket_Number'],$ticket_num)==0) && strcmp($c,$temp)==0)
{
    if(strcmp($data_array[$i]['Status'],"Closed")==0)
{
    $sum_time=$sum_time+$data_array[$i]['Time_Spent'];
    $sum_count++;

}


}

}

if($sum_count==0)
return 0;

else
{
$avg1 = $sum_time/$sum_count;
$avg2 = number_format($avg1,2);
return (float)$avg2;

}


}


function search($temp,$array)
{
   for($i=0;$i<sizeof($array);$i++)
{
   if(strcmp($array[$i],$temp)==0)
{
    return 1;
}
    

}

return 0;

}



function find_parent_requests($data_array,$c)
{
    $count = 0;
    $ticket = array();

    for($i=0;$i<sizeof($data_array);$i++)
{

     $temp = "@client_name:".$data_array[$i]['Account_Name'];

    if (strcmp($c,$temp)==0)
{
    if(strcmp($data_array[$i]['Category'],"S - PER - parent request")==0 && search($data_array[$i]['Ticket_Number'],$ticket)==0)
{
    $ticket[$count]=$data_array[$i]['Ticket_Number'];
    $count++;

}

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

    $temp = "@client_name:".$data_array[$i]['Account_Name'];
    if (strcmp($c,$temp)==0)
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
   $temp1 = $time[$i]-$mean;
   $variance=$variance+$temp1*$temp1;
} 

$dev1 = sqrt($variance/$count);
$dev2 = number_format($dev1, 2);

return (float)$dev2;

}

function find_closed_cases($data_array,$c)
{
    $count = 0;
    for($i=0;$i<sizeof($data_array);$i++)
{
     $temp = "@client_name:".$data_array[$i]['Account_Name'];
    if (strcmp($c,$temp)==0 && ((strpos($data_array[$i]['Assigned_To'],"NAM")!=false)|| (strpos($data_array[$i]['Assigned_To'],"RSC")!=false)) )
{
    if(strcmp($data_array[$i]['Status'],"Closed")==0)
    $count++;

}


}
    

return $count;
   

}

function find_new_partners($data_array,$c)
{
   $count = 0;
   $ticket = array();

    for($i=0;$i<sizeof($data_array);$i++)
{

      $temp = "@client_name:".$data_array[$i]['Account_Name'];
     if (strcmp($c,$temp)==0)
{
    if(strcmp($data_array[$i]['Category'],"S - PER - New TP")==0 && search($data_array[$i]['Ticket_Number'],$ticket)==0 )
{
    $ticket[$count] = $data_array[$i]['Ticket_Number'];
    $count++;
}

}


}
    

return $count;

}


function find_map_changes($data_array,$c)
{
    $count = 0;
    $ticket = array();

    for($i=0;$i<sizeof($data_array);$i++)
{
     $temp = "@client_name:".$data_array[$i]['Account_Name'];
    if (strcmp($c,$temp)==0)
{
    if(strcmp($data_array[$i]['Category'],"S - PER - Map Change")==0 && search($data_array[$i]['Ticket_Number'],$ticket)==0 )
{
    $ticket[$count] = $data_array[$i]['Ticket_Number'];
    $count++;

}

}


}
    

return $count;

}


function find_new_maps($data_array,$c)
{
   $count = 0;
   $ticket = array();

    for($i=0;$i<sizeof($data_array);$i++)
{
     $temp = "@client_name:".$data_array[$i]['Account_Name'];
    if (strcmp($c,$temp)==0)
{
    if(strcmp($data_array[$i]['Category'],"S - PER - New Map")==0 && search($data_array[$i]['Ticket_Number'],$ticket)==0)
{
    $ticket[$count] = $data_array[$i]['Ticket_Number'];
    $count++;
}


}


}


    

return $count;


}


function find_communication_requests($data_array,$c)
{
    $count = 0;
    $ticket = array();

    for($i=0;$i<sizeof($data_array);$i++)
{

    $temp = "@client_name:".$data_array[$i]['Account_Name'];
    if (strcmp($c,$temp)==0)
{
    if(strcmp($data_array[$i]['Category'],"S - PER - Communication")==0 && search($data_array[$i]['Ticket_Number'],$ticket)==0)
{
   $ticket[$count] = $data_array[$i]['Ticket_Number'];
    $count++;

}

}


}


    

return $count;

}



function find_other($data_array,$c)
{
    $count = 0;
    $other = array("Other","S - Administration","S - Code List Update","S - Communication problem","S - Communications change","S - Configuration changes","S - Data Tracking/Restart","S - Enhancement Request Implementation","S - FYI/Other","S - IBM Outage/instability","S - Info/Question/How To","S - Internal IBM","S - Map Change","S - Map Research","S - Mapping Request","S - Outage non-IBM","S - Proactive Notification","S - Project","S - Reporting","S - Service Request","S - Set up","S - Testing","S - Troubleshoot","");
    $ticket = array();

    for($i=0;$i<sizeof($data_array);$i++)
{
     $temp = "@client_name:".$data_array[$i]['Account_Name'];
    if (strcmp($c,$temp)==0)
{
     for($j=0;$j<sizeof($other);$j++)
{
    if(strcmp($data_array[$i]['Category'],$other[$j])==0 && search($data_array[$i]['Ticket_Number'],$ticket)==0)
{
   $ticket[$count] = $data_array[$i]['Ticket_Number'];
    $count++;

}

}
    
    
}


}
    

return $count;

}


function find_tp_contact($data_array,$c)
{
    $count = 0;
    $ticket = array();

    for($i=0;$i<sizeof($data_array);$i++)
{
     $temp = "@client_name:".$data_array[$i]['Account_Name'];
    if (strcmp($c,$temp)==0)
{
    if(strcmp($data_array[$i]['Category'],"S - PER TP Contact List Update")==0 && search($data_array[$i]['Ticket_Number'],$ticket)==0)
{
   $ticket[$count] = $data_array[$i]['Ticket_Number'];
    $count++;

}

}


}
    

return $count;

}


function find_internal_tickets($data_array,$c)
{
    $count = 0;
    $ticket = array();

    for($i=0;$i<sizeof($data_array);$i++)
{ 
     $temp = "@client_name:".$data_array[$i]['Account_Name'];
    if (strcmp($c,$temp)==0)
{
    if(strcmp($data_array[$i]['Category'],"S - PER - Other")==0 && search($data_array[$i]['Ticket_Number'],$ticket)==0)
{
    $ticket[$count] = $data_array[$i]['Ticket_Number'];
    $count++;
}

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
    $ticket = array();

    for($i=0;$i<sizeof($data_array);$i++)
{
     $temp = "@client_name:".$data_array[$i]['Account_Name'];
    if (strcmp($c,$temp)==0)
{
    if(strcmp($data_array[$i]['Status'],"Closed")==0 && search($data_array[$i]['Ticket_Number'],$ticket)==0)
{
   
    $ticket[$count] = $data_array[$i]['Ticket_Number'];
    $count++;

}

}


}
    

return $count;


}

$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = 'Shreya@98';



$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die('Database Not Connected. Please Fix the Issue! ' . mysql_error()); 


mysql_select_db("USERS",$connect);

$query = "SELECT * FROM sql_table";
 
$res = mysql_query($query,$connect) or die("Query Not Executed " .mysql_error($connect)); 

$data_array = array();

while($rows =mysql_fetch_assoc($res)) 
{ 
   $data_array[] = $rows;                      //data_array for mysql database values
} 


$jsonCont = file_get_contents('data.json');

$content = json_decode($jsonCont,true);          //content for json values




$customer_database = array();
$count = 0;

for($i=0;$i<sizeof($data_array);$i++)
{
   if(search($data_array[$i]['Account_Name'],$customer_database)==0)
{
   $customer_database[$count] = $data_array[$i]['Account_Name'];  
   $count++;
}



}



$intents = array ("average time","parent requests","standard deviation","closed cases","new partners","map changes","new maps","communication requests","tickets","tickets total","tickets category","tickets closed");

for($i=0;$i<$count;$i++)
{

$content['entities'][0]['values'][$i]['value'] = $customer_database[$i];
$content['entities'][0]['values'][$i]['created'] = "2017-07-02T14:05:55.127Z";
$content['entities'][0]['values'][$i]['updated'] = "2017-07-02T14:05:55.127Z";
$content['entities'][0]['values'][$i]['metadata'] = null;
$content['entities'][0]['values'][$i]['synonyms'] = [];

}


$count_node = 0;

for($j=0;$j<12;$j++)
{


 for($i=0;$i<$count+1;$i++)
{
   $content['dialog_nodes'][$count_node+16]['type']= "response_condition";
   $content['dialog_nodes'][$count_node+16]['go_to']= null;
   $content['dialog_nodes'][$count_node+16]['title']= null;
   $content['dialog_nodes'][$count_node+16]['output']['text']['values'][0]= "";
   $content['dialog_nodes'][$count_node+16]['output']['text']['selection_policy']= "sequential";
   $content['dialog_nodes'][$count_node+16]['parent']= $intents[$j];
   $content['dialog_nodes'][$count_node+16]['context']=null;
   $content['dialog_nodes'][$count_node+16]['created']="2017-07-03T08:28:18.340Z";
   $content['dialog_nodes'][$count_node+16]['updated']="2017-07-02T14:05:55.127Z";
   $content['dialog_nodes'][$count_node+16]['metadata']=null;
   if($i==$count)
   $content['dialog_nodes'][$count_node+16]['conditions']=null;
   else
   $content['dialog_nodes'][$count_node+16]['conditions']="@client_name:".$customer_database[$i];
   $content['dialog_nodes'][$count_node+16]['description']=null;
   $content['dialog_nodes'][$count_node+16]['dialog_node']="node".($count_node+1);
   if($i==0)
   $content['dialog_nodes'][$count_node+16]['previous_sibling']=null;
   else
   $content['dialog_nodes'][$count_node+16]['previous_sibling']="node".($count_node);
   
   $count_node++;


}
   


}

$json = json_encode($content);

file_put_contents('chat.json', $json);





$jsonCont = file_get_contents('chat.json');

$content = json_decode($jsonCont,true);          //content for json values





$customer = array();


for($i=0;$i<12*($count+1);$i++)
{
   $customer[$i]= $content['dialog_nodes'][$i+16]['conditions'];
}


$question = array();



for($i=0;$i<12*($count+1);$i++)
{
$question[$i] = $content['dialog_nodes'][$i+16]['parent'];
}



// if you are adding extra intents then add the number added to 10 must also add values to 40


for($i=0;$i<12*($count+1);$i++)
{
   
if (strcmp($question[$i],"average time")==0)
{
    if(is_null($customer[$i]))
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]="You need to mention the correct name of the client";

    else
{
    $t= find_time($data_array,$customer[$i]);
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]=json_encode($t);
}
     //echo $t;

}

else if (strcmp($question[$i],"parent requests")==0)
{
    if(is_null($customer[$i]))
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]="You need to mention the correct name of the client";

    else
{
    $p=find_parent_requests($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]=json_encode($p);
}
    
     
}

else if (strcmp($question[$i],"standard deviation")==0)
{
    if(is_null($customer[$i]))
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]="You need to mention the correct name of the client";

    else
{
   $p=find_standard_deviation($data_array,$customer[$i]); 
   $content['dialog_nodes'][$i+16]['output']['text']['values'][0]=json_encode($p);
}
     
}


 else if (strcmp($question[$i],"closed cases")==0)
{
    if(is_null($customer[$i]))
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]="You need to mention the correct name of the client";

    else
{  
    $p=find_closed_cases($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]=json_encode($p);
}
    
     
}

else if (strcmp($question[$i],"new partners")==0)
{
    if(is_null($customer[$i]))
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]="You need to mention the correct name of the client";

    else
{
    $p=find_new_partners($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]=json_encode($p);
}
    
     
}

else if (strcmp($question[$i],"map changes")==0)
{
    if(is_null($customer[$i]))
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]="You need to mention the correct name of the client";

    else
{
    $p=find_map_changes($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]=json_encode($p);
}
        
}

else if (strcmp($question[$i],"new maps")==0)
{
    if(is_null($customer[$i]))
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]="You need to mention the correct name of the client";


    else
{
    $p=find_new_maps($data_array,$customer[$i]);
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]=json_encode($p);
}
    
     
}

else if (strcmp($question[$i],"communication requests")==0)
{
    if(is_null($customer[$i]))
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]="You need to mention the correct name of the client";

    else
{
    $p=find_communication_requests($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]=json_encode($p);  
}
   
}

else if (strcmp($question[$i],"tickets")==0)
{
    if(is_null($customer[$i]))
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]="You need to mention the correct name of the client";

    else
{
    $p=find_tickets_total($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]=json_encode($p);  
}
   
}

else if (strcmp($question[$i],"tickets total")==0)
{
    if(is_null($customer[$i]))
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]="You need to mention the correct name of the client";
  
    else
{
    $p=find_tickets_total($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]=json_encode($p);  
}
  
}

else if (strcmp($question[$i],"tickets category")==0)
{
    if(is_null($customer[$i]))
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]="You need to mention the correct name of the client";

    else
{
    $p=find_tickets_category($data_array,$customer[$i]);
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]=json_encode($p); 
}
  
}

else if (strcmp($question[$i],"tickets closed")==0)
{
    if(is_null($customer[$i]))
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]="You need to mention the correct name of the client";

    else
{
    $p=find_tickets_closed($data_array,$customer[$i]); 
    $content['dialog_nodes'][$i+16]['output']['text']['values'][0]=json_encode($p); 
}

   
}



}

$json = json_encode($content);

file_put_contents('chat.json', $json);


mysql_close($connect);





?> 
