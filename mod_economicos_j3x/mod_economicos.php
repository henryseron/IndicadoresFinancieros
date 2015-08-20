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

// get a parameter from the module's configuration
$mostrar_uf = $params->get('mostrar_uf');
$mostrar_dolar = $params->get('mostrar_dolar');
$mostrar_euro = $params->get('mostrar_euro');
$mostrar_utm = $params->get('mostrar_utm');
$mostrar_ipc = $params->get('mostrar_ipc');

$estilo = $params->get('estilo');
$direccion_marquee = $params->get('direccion_marquee');
$mostrar_borde_tabla = $params->get('mostrar_borde_tabla');
$mostrar_moneda_cambio = $params->get('mostrar_moneda_cambio');
$mostrar_creditos = $params->get('mostrar_creditos');

// include the template for display
require(JModuleHelper::getLayoutPath('mod_economicos'));

