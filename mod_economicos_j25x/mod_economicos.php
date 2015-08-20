<?php
/**
* @title		Indicadores Económicos
* @package		Joomla
* @website		http://www.shakingweb.com
* @copyleft             Copyleft () 2014
* @license		GNU/GPLv2, see LICENSE.txt
*/

// no direct access
defined('_JEXEC') or die('Restricted access');
// include the helper file
require_once(dirname(__FILE__).DS.'helper.php');
// get a parameter from the module's configuration
$mostrar_uf = $params->get('mostrar_uf');
$mostrar_dolar = $params->get('mostrar_dolar');
$mostrar_euro = $params->get('mostrar_euro');
$mostrar_utm = $params->get('mostrar_utm');
$mostrar_ipc = $params->get('mostrar_ipc');

// get the items to display from the helper
$archivo = "";
if($mostrar_uf == "1" && $mostrar_dolar == "1" && $mostrar_euro == "1"){
    $archivo = ModEconomicosHelper::getIndicadores();
}

$valor_uf = "";
if($mostrar_uf == "1"){
    $valor_uf = ModEconomicosHelper::getUF($archivo);
}

$valor_dolar = "";
if($mostrar_dolar == "1"){
    $valor_dolar = ModEconomicosHelper::getDolar($archivo);
}

$valor_euro = "";
if($mostrar_euro == "1"){
    $valor_euro = ModEconomicosHelper::getEuro($archivo);
}

$valor_utm = "";
if($mostrar_utm == "1"){
    $valor_utm = ModEconomicosHelper::getUtm();
}

$valor_ipc = "";
if($mostrar_ipc == "1"){
    $valor_ipc = ModEconomicosHelper::getIpc();
}

$estilo = $params->get('estilo');
$direccion_marquee = $params->get('direccion_marquee');
$mostrar_borde_tabla = $params->get('mostrar_borde_tabla');
$mostrar_moneda_cambio = $params->get('mostrar_moneda_cambio');
$mostrar_creditos = $params->get('mostrar_creditos');

// include the template for display
require(JModuleHelper::getLayoutPath('mod_economicos'));

