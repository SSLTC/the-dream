<?php declare(strict_types=1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currencyFrom = validateInput($_REQUEST["CurrencyFromInput"]);
    if (empty($currencyFrom)) {
        echo "oeps";
    }
}

function validateInput($inputData) {
    $inputData = trim($inputData);
    $inputData = stripslashes($inputData);
    $inputData = htmlspecialchars($inputData);
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
    <input type="text" name="CurrencyFromInput" id="CurrencyFromInput">
    <select name="CurrencyFrom" id="CurrencyFrom">
        <option value="dollar">Dollar</option>
    </select>
    <button id="SwitchCurrency" value="<->">&lt;-&gt;</button>
    <label for="CurrencyTo">To:</label>
    <input type="text" name="CurrencyToDisplay" id="CurrencyToDisplay">
    <select name="CurrencyTo" id="CurrencyTo">
        <option value="euro">Euro</option>
    </select>
    <input type="submit" value="Convert">
</form>
    
</body>
</html>