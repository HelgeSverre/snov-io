<?php

use Illuminate\Support\Str;

require './vendor/autoload.php';

// Assuming 'endpoints.json' is your JSON file name
$jsonFile = 'api.json';
$jsonData = file_get_contents($jsonFile);

// Decode JSON data into PHP array
$endpoints = json_decode($jsonData, true);

$target = 'src';

$dirs = [
    'Requests',
    'Resources',
];

foreach ($dirs as $dir) {
    if (! file_exists("$target/$dir")) {
        mkdir("$target/$dir");
    }
}

// Request classes
foreach ($endpoints as $endpoint) {
    $className = ucfirst(Str::of($endpoint['title'])->remove(['’', '.'])->camel()).'Request';
    $method = strtoupper($endpoint['method']);
    $url = $endpoint['endpoint'];
    $path = str_replace('https://api.snov.io', '', $url);
    $resource = Str::of($endpoint['group'])->camel()->ucfirst() ?? '';
    $parameters = $endpoint['inputParameters'];

    // Start generating the class content
    $classContent = "<?php\n\n";
    $classContent .= trim('namespace HelgeSverre\Snov\Requests\\'.$resource, '\\').";\n\n";
    $classContent .= "use Saloon\Enums\Method;\n";
    $classContent .= "use Saloon\Http\Request;\n";
    $classContent .= "use Saloon\Http\Response;\n";
    $classContent .= "use Saloon\Traits\Body\HasJsonBody;\n";
    $classContent .= "class $className extends Request\n{\n";
    $classContent .= "use HasJsonBody;\n";
    $classContent .= 'protected Method $method = Method::'.strtoupper($endpoint['method']).";\n\n";

    // Constructor and properties
    $constructorParams = [];
    $constructorComments = [];
    foreach ($parameters as $param) {
        $constructorParams[] = 'protected mixed $'.(Str::of($param['name'])->before('[')->trim()->camel());
        $constructorComments[] = '@var mixed $'.($param['name']).' '.addslashes($param['description']);

    }

    $classContent .= "/**\n";
    $classContent .= implode("\n * ", $constructorComments);
    $classContent .= "\n **/\n";
    $classContent .= "public function __construct(\n".implode(", \n", $constructorParams)."\n) {}\n";
    $classContent .= "public function resolveEndpoint(): string\n";
    $classContent .= "{\n return '$path'; }\n";

    $classContent .= "public function defaultBody(): array\n    {\n";
    $classContent .= "return array_filter([\n";

    foreach ($parameters as $param) {
        $classContent .= "'".($param['name'])."' => \$this->".Str::camel($param['name']).",\n";
    }

    $classContent .= "]);\n";
    $classContent .= "}}\n";

    $out = "$target/Requests/$resource/$className.php";

    $dir = dirname($out);

    if (file_exists($out)) {
        unlink($out);
    }

    if (! file_exists($dir)) {
        echo "Creating directory $dir\n";
        mkdir($dir);
    }

    file_put_contents($out, $classContent);
}

// Resource classes

$groups = collect($endpoints)->groupBy('group');

foreach ($groups as $group => $endpoints) {
    $resourceName = Str::of($group)->camel()->ucfirst();
    $namespace = 'HelgeSverre\\Snov\\Resources';
    $classContent = "<?php\n\nnamespace $namespace;\n\n";
    $classContent .= "use Saloon\\Http\\BaseResource;\n";
    $classContent .= "use Saloon\\Http\\Response;\n\n";

    $classContent .= "class {$resourceName} extends BaseResource\n{\n";

    foreach ($endpoints as $endpoint) {
        $methodName = Str::of($endpoint['title'])->remove(['’', '.'])->camel();
        $requestClassName = ucfirst($methodName).'Request';
        $requestNamespace = "\\HelgeSverre\\Snov\\Requests\\$resourceName\\$requestClassName";

        // Generate method for the endpoint
        $classContent .= "    /**\n";
        $classContent .= '     * '.$endpoint['description']."\n";
        $classContent .= "     *\n";
        $classContent .= "     * @return Response\n";
        $classContent .= "     */\n";
        $classContent .= "    public function $methodName(array \$data): Response\n";
        $classContent .= "    {\n";
        $classContent .= "        return \$this->connector->send(new $requestNamespace(...\$data));\n";
        $classContent .= "    }\n\n";
    }

    $classContent .= "}\n";

    $out = "$target/Resources/$resourceName.php";

    file_put_contents($out, $classContent);

    echo "Generated resource class for $resourceName\n";
}
