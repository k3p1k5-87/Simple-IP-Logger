
<?php
include("geoloc/geoipcity.inc");
include("geoloc/geoipregionvars.php");


$broswer= "";
$ip = NULL;

$ip = fopen('ip.txt', 'a+');
if($ip != NULL)
{
    fputs($ip, 'ip : ' . $_SERVER['REMOTE_ADDR']);
    fputs($ip, PHP_EOL);
    fputs($ip,'PORT :  ' . $_SERVER['REMOTE_PORT'] . PHP_EOL);
    fputs($ip, PHP_EOL);

    if(isset($_SERVER['HTTP_REFERER']))
    {
        $LAST_URL = $_SERVER['HTTP_REFERER'];
        fputs($ip, 'referer : ');
        fputs($ip, $LAST_URL . PHP_EOL);
    }
    else
    {
        fputs($ip, "Does not send the referer !" .PHP_EOL);

    }
    $remote_ip = $_SERVER['REMOTE_ADDR'];
    fputs($ip, 'host : ');
    fputs($ip, gethostbyaddr($remote_ip) .PHP_EOL);
    fputs($ip, 'Navigateur / OS : ' . $_SERVER['HTTP_USER_AGENT'] . PHP_EOL);
    fputs($ip, PHP_EOL);

    $gi = geoip_open(realpath("geoloc/GeoLiteCity.dat"),GEOIP_STANDARD);
    $record = geoip_record_by_addr($gi,$_SERVER['REMOTE_ADDR']);

    fputs($ip, "Pays : ");
    fputs($ip, $record->country_name .PHP_EOL);
    fputs($ip, "Region : ");
    fputs($ip, $GEOIP_REGION_NAME[$record->country_code][$record->region] .PHP_EOL);
    fputs($ip, "Ville : ");
    fputs($ip, $record->city .PHP_EOL);
    fputs($ip, "Code Postal : ");
    fputs($ip, $record->postal_code .PHP_EOL);
    fputs($ip, "Latitude : ");
    fputs($ip, $record->latitude .PHP_EOL);
    fputs($ip, "Longitude : ");
    fputs($ip, $record->longitude .PHP_EOL);

    geoip_close($gi);

    fputs($ip, "*********************************************************************************************************\n") .PHP_EOL;
}

fclose($ip);
?> 

<!DOCTYPE html>

<html>

    <head>
    </head>


    <body>

        <header>
        </header>

    </body>

</html>