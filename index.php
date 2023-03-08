<?php declare(strict_types=1);

$error = NULL;
$currencyFromOption = NULL;
$currencyToOption = NULL;
$currencyRates = array("euro"=>"1.05", "dollar"=>"0.95");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currencyFromOption = $_REQUEST["CurrencyFrom"];
    $currencyToOption = $_REQUEST["CurrencyTo"];

    if (array_key_exists("SwitchCurrency", $_POST)) {
        $currencyFromOption = $_REQUEST["CurrencyTo"];
        $currencyToOption = $_REQUEST["CurrencyFrom"];
    }

    $currencyFrom = validateInput($_REQUEST["CurrencyFromInput"]);
    $currencyFrom = (float)$currencyFrom;

    if ($currencyFrom == 0) {
        $error = "&lt;&lt; Please give an amount to convert!";
    } elseif ($currencyFromOption == $currencyToOption) {
        $convertedCurrency = $currencyFrom;
    } else {
        $currencyTo = $currencyRates[$currencyToOption];
        $convertedCurrency = round($currencyFrom * $currencyTo, 2);
    }
}

function validateInput($inputData) {
    $inputData = trim($inputData);
    $inputData = stripslashes($inputData);
    $inputData = htmlspecialchars($inputData);
    $inputData = str_replace(',', '.', $inputData);
    return $inputData;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Valuta Converter</title>
</head>
<body>
<h1>Valuta Converter</h1>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="CurrencyFrom">From:</label>
    <input  type="text" 
            name="CurrencyFromInput" 
            id="CurrencyFromInput" 
            style="text-align: right" 
            value="<?php echo !isset($currencyFrom)? '' : $currencyFrom ?>">
    <?php echo $error ?>
    <select name="CurrencyFrom" id="CurrencyFrom" onChange="this.form.submit()">
        <?php
        foreach ($currencyRates as $key => $value) {
            echo "<option value='" . $key . "'", ($currencyFromOption == $key) ? "selected" : '', ">" . ucfirst($key) . "</option>";
        }
        ?>
    </select>
    <button name="SwitchCurrency" id="SwitchCurrency" value="<->">&lt;-&gt;</button>
    <label for="CurrencyTo">To:</label>
    <input  type="text" 
            name="CurrencyToDisplay" 
            id="CurrencyToDisplay" 
            style="text-align: right" 
            value="<?php echo !isset($convertedCurrency) ? '' : $convertedCurrency ?>" disabled />
    <select name="CurrencyTo" id="CurrencyTo" onChange="this.form.submit()">
        <?php
        foreach ($currencyRates as $key => $value) {
            echo "<option value='" . $key . "'", ($currencyToOption == $key) ? "selected" : '', ">" . ucfirst($key) . "</option>";
        }
        ?>
    </select>
    <input type="submit" value="Convert" />
</form> 
</body>
</html>