<?php

use Illuminate\Support\Str;

require './vendor/autoload.php';

// Assuming 'endpoints.json' is your JSON file name
$jsonFile = 'api.json';
$jsonData = file_get_contents($jsonFile);

// Decode JSON data into PHP array
$endpoints = json_decode($jsonData, true);

foreach ($endpoints as $endpoint) {
    $className = ucfirst($endpoint['id']) . 'Request';
    $method = strtoupper($endpoint['method']);
    $url = $endpoint['endpoint'];
    $parameters = $endpoint['inputParameters'];

    // Start generating the class content
    $classContent = "<?php\n\n";
    $classContent .= "use Saloon\Enums\Method;\n";
    $classContent .= "use Saloon\Http\Request;\n";
    $classContent .= "use Saloon\Http\Response;\n";
    $classContent .= "use Saloon\Traits\Body\HasJsonBody;\n";
    $classContent .= "class $className extends Request\n{\n";
    $classContent .= "use HasJsonBody;\n";
    $classContent .= 'protected Method $method = Method::' . strtoupper($endpoint["method"]) . ";\n\n";

    // Constructor and properties
    $constructorParams = [];
    $constructorComments = [];
    foreach ($parameters as $param) {
        $constructorParams[] = "protected mixed \$" . (Str::camel($param['name']));
        $constructorComments[] = "@var mixed \$" . ($param['name']) . " " . addslashes($param['description']);

    }

    $classContent .= "/**\n";
    $classContent .= implode("\n * ", $constructorComments);
    $classContent .= " **/\n\n";
    $classContent .= "public function __construct(\n" . implode(", \n", $constructorParams) . "\n) {}\n";
    $classContent .= "public function resolveEndpoint(): string\n";
    $classContent .= "{\n return '$url'; }\n";

    $classContent .= "public function defaultBody(): array\n    {\n";
    $classContent .= "return array_filter([\n";

    foreach ($parameters as $param) {
        $classContent .= "'" . ($param['name']) . "' => \$this->" . Str::camel($param['name']) . ",\n";
    }

    $classContent .= "        ]);\n    }\n";
    $classContent .= "}\n";


    $filename = "$className.php";

    echo $filename . "\n";

//    continue;
    // Save class to a .php file
    if (file_exists("$className.php")) {

        unlink("$className.php");
    }

    if (!file_exists("codegen")) {

        mkdir("codegen");
    }
    file_put_contents("codegen/$className.php", $classContent);
}

