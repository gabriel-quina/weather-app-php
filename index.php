<html>
<body>
    <h1>Consultar Clima</h1>
<?php
if ( 'post' === strtolower($_SERVER['REQUEST_METHOD'])) {
    ?><h2><?php
    $xml = new SimpleXMLElement('https://api.openweathermap.org/data/2.5/weather?mode=xml&units=metric&q='.$_POST['city'].'&appid="API-KEY"', 0, true);
    echo $xml->temperature['value'];
    ?></h2>
<?php
} else {
    ?>
    <form method="post">
        <label for="city">Selecione a cidade</label>
        <select name="city" id="city">
            <option value="Juiz de Fora">Juiz de Fora</option>
            <option value="Rio de Janeiro">Rio de Janeiro</option>
            <option value="Muriae">Muriaé</option>
            <option value="Nova Serrana">Nova Serrana</option>
        </select>
        <input type="submit" value="Consultar temperatura da cidade">
    </form>
<?php
}?>
</body>
</html>
