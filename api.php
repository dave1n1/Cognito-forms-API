<?php
    $json_data = file_get_contents("php://input");  
       
    if (empty($json_data)) 
    {  
        echo "No data found";  
        die;  
    }  
    // contact_data as object
    $contact_data = json_decode($json_data);  
    if ($contact_data == null && json_last_error() !== JSON_ERROR_NONE) 
    {  
        echo "Error reading JSON data: " . json_last_error();  
    }  
   
    $conn = new conn("localhost", "myuser", "mypassword", "mydbname");  
    if ($conn->connect_errno) 
    {  
        echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;  
        die;  
    }  
       
    $insert_query = "insert into contact_datas (firstname,lastname,address_line1,address_line2,address_city,address_state,address_postalcode,phone,email,company,comments) values ('".$contact_data->{'Name'}->{'First'}."','".$contact_data->{'Name'}->{'Last'}."','".$contact_data->{'Address'}->{'Line1'}."','".$contact_data->{'Address'}->{'Line2'}."','".$contact_data->{'Address'}->{'City'}."','".$contact_data->{'Address'}->{'State'}."','".$contact_data->{'Address'}->{'PostalCode'}."','".$contact_data->{'Phone'}."','".$contact_data->{'Email'}."','".$contact_data->{'Company'}."','".$contact_data->{'CommentsOrQuestions'}."')"; 
     
    if ($conn->query($insert_query) === TRUE) 
    {
        echo "Cognito forms API using php data successfully updated";
    } 
    else
    {
        echo "Error: "<br>" . $conn->error;
    }

    ?>