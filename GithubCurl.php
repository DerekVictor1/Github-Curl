<?php

 

    $servername = "localhost";

    $username = "root";

    $password = "";

    $dbname = "store_data";

 

    // Create connection

 

    $conn = new mysqli($servername, $username, $password, $dbname); //variables can be used

 

    // Check connection

 

    if ($conn->connect_error) {

        die("Connection failed: " . $conn->connect_error);

    } else {

        echo "connected succesfully and echoed as well " . "<br/>";

    }


    $check = "CREATE TABLE planets (ID int NOT NULL AUTO_INCREMENT, Name text, Rotation_period text,	Orbital_period text, Diameter text,
    	Climate text, Gravity text,	Terrain text, Surface_water text, Population text, Edited text,	Created text, Url text, PRIMARY KEY (ID))";

 

    if ($conn->query($check) === TRUE) {

        echo "planets created successfully<br>";

 

    } else {

        echo $conn->error;

    }


    // Create a new cURL resource and set the file URL to fetch through cURL

 

    $curl = curl_init('https://swapi.dev/api/planets/');

 

    if (!$curl) {

        die("Couldn't initialize a cURL handle");

    };

 

    //This option will return data as a string instead of direct output

 

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

 

    // carry out the request

 

    $results = curl_exec($curl);

 

    // check for any errors

 

    if (curl_errno($curl)) {

        echo (curl_error($curl));

        die();

    };

 

    // close cURL resource to free up system resources

 

    curl_close($curl);

 

    //Convert data into a JSON format, with Arrays

 

    $response_data = json_decode($results, true);

 


    //Print out the array format of the data from the Star Wars API

 

    echo('<pre>');

    print_r($response_data);

    echo('</pre>');

    echo('<br>');

    foreach ($response_data['results'] as $data) {
        $name = $data['name'];
        $rotation_period = $data['rotation_period'];
        $orbital_period = $data['orbital_period'];
        $Diameter = $data['diameter'];
        $Climate = $data['climate'];
        $Gravity = $data['gravity'];
        $Terrain = $data['terrain'];
        $Surface_water = $data['surface_water'];
        $Population = $data['population'];
        $Created = $data['created'];
        $Edited = $data['edited'];
        $Url = $data['url'];

        $query = "INSERT INTO planets (Name, Rotation_period, Orbital_period, Diameter,	Climate, Gravity, Terrain, Surface_water, Population, Created, Edited, Url) 
        VALUES (\"".$name."\", \"".$rotation_period."\", \"".$orbital_period."\", \"".$Diameter."\", \"".$Climate."\",
         \"".$Gravity."\", \"".$Terrain."\", \"".$Surface_water."\", \"".$Population."\", \"".$Created."\", \"".$Edited."\",
         \"".$Url."\")";
                $conn->query($query);
            if ($conn->errno){    
                echo($conn->error); die();

            }
    };
 

?>