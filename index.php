<?php
    use Cmfcmf\OpenWeatherMap;
    use Cmfcmf\OpenWeatherMap\Exception as OWMException;
    use Http\Factory\Guzzle\RequestFactory;
    use Http\Adapter\Guzzle7\Client as GuzzleAdapter;

    require_once 'vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
?>

<html>
<head>
    <title>Open Weather API</title>
</head>
<body>
    <h1>Consultar Clima</h1>
<?php
if ( 'post' === strtolower($_SERVER['REQUEST_METHOD'])) {
    $city = $_POST['city'];

    $owm =new OpenWeatherMap($_ENV['APIKEY'], GuzzleAdapter::createWithConfig([]), new RequestFactory());

    try {
        $weather = $owm->getWeather($city, 'metric', 'en');
        ?><h2><?php echo $weather->temperature; ?></h2 >
        <a href="index.php"><input type="submit" value="Voltar"></a>
        <?php
    } catch (OWMException $e) {
        echo 'OpenWeatherMap exception: ' . $e->getMessage() . ' (code ' . $e->getCode() . ').';
    } catch (\Exception $e){
        echo 'General exception: ' . $e->getMessage() . ' (Code ' . $e->getCode() . ').';
    }
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
