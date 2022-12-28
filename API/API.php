<?php

// Set up an array of conversion factors for different units
$conversionFactors = array(
    'C to F' => array(
        'factor' => 1.8,
        'offset' => 32
    ),
    'F to C' => array(
        'factor' => 0.5556,
        'offset' => 0
    ),
    'K to C' => array(
        'factor' => 1,
        'offset' => -273.15
    ),
    'C to K' => array(
        'factor' => 1,
        'offset' => 273.15
    ),
    'K to F' => array(
        'factor' => 1.8,
        'offset' => 459.67
    ),
    'F to K' => array(
        'factor' => 0.5556,
        'offset' => -459.67
    )
);

// Check if the "from" and "to" parameters are set
if (isset($_GET['from']) && isset($_GET['to']) && isset($_GET['value'])) {
    // Get the "from" and "to" parameters
    $from = $_GET['from'];
    $to = $_GET['to'];
    $value = (float) $_GET['value'];

    // Check if a conversion factor exists for the specified units
    if (isset($conversionFactors["$from to $to"])) {
        // Calculate the converted value using the conversion factor
        $conversion = $conversionFactors["$from to $to"];
        $convertedValue = $value * $conversion['factor'] + $conversion['offset'];

        // Return the converted value as a JSON object
        header('Content-Type: application/json');
        echo json_encode(array('value' => $convertedValue));
    } else {
        // Return an error message if the units are not supported
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Unsupported units'));
    }
} else {
    // Return an error message if the required parameters are not set
    header('Content-Type: application/json');
    echo json_encode(array('error' => 'Missing parameters'));
}

