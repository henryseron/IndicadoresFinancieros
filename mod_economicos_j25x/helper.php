<?php
    // no direct access
    defined('_JEXEC') or die('Restricted access');
    
    class ModEconomicosHelper
    {                
        public function getIndicadores() {
            // banco central de chile
            $url = "http://si3.bcentral.cl/Indicadoressiete/secure/Indicadoresdiarios.aspx";
            
            $archivo = fopen($url, "r");
            if (!$archivo){
                $archivo = "";
            }
            
            return $archivo;
        }
        
        /**
        * Obtiene el valor de la UF
        * 
        * @return $UF
        */
        public function getUF($archivo){
            $uf = "";

            while (!feof($archivo))
            {
                $linea = fgets($archivo, 1024);
                // obtengo el valor de la uf
                if (preg_match("/id=\"lblValor1_1\"/i", $linea)){
                    $uf = $linea;
                }
        
                // cuando obtengo el valor de la UF termino la ejecucion del ciclo
                if($uf != ""){
                    break;
                }
            }
        
            return strip_tags($uf);
        }
        
        /**
        * Obtiene el valor del dolar
        * 
        * @return $dolar
        */
        public function getDolar($archivo){
            $dolar = "";
            while (!feof($archivo))
            {
                $linea = fgets($archivo, 1024);
                // obtengo el valor del dolar observado
                if (preg_match("/id=\"lblValor1_3\"/i", $linea)){
                    $dolar = $linea;
                }
        
                // cuando obtengo el valor del dolar termino la ejecucion del ciclo
                if($dolar != ""){
                    break;
                }
            }
        
            return strip_tags($dolar);
        }
        
        /**
        * Obtiene el valor del euro
        * 
        * @return $euro
        */
        public function getEuro($archivo){
            $euro = "";
            while (!feof($archivo))
            {
                $linea = fgets($archivo, 1024);
                // obtengo el valor del dolar observado
                if (preg_match("/id=\"lblValor1_5\"/i", $linea)){
                    $euro = $linea;
                }
        
                // cuando obtengo el valor del dolar termino la ejecucion del ciclo
                if($euro != ""){
                    break;
                }
            }
        
            return strip_tags($euro);
        }
        
        /**
         * Obtiene e valo de la utm
         * 
         * @return $utm
         */
        public function getUtm(){
            // banco central de chile
            $url = "http://si3.bcentral.cl/Indicadoressiete/secure/Serie.aspx?gcode=PRE_UTM&param=cgBnAE8AOQBlAGcAIwBiAFUALQBsAEcAYgBOAEkASQBCAEcAegBFAFkAeABkADgASAA2AG8AdgB2AFMAUgBYADIAQwBzAEEARQBEAG8AdgBpAFoATABGAE4AagB1AFQAeQAyAEIAcAAzAHgAVABKAFEAagAxAHoAQQBfAEsAJAAzAFQARQBOAHgAQwB3AFgAZwA5AHgAdgAwACQATwBZADcAMwAuAGIARwBFAFIASwAuAHQA";
            
            $archivo = fopen($url, "r");
            if (!$archivo){
                $archivo = "";
            }
            
            $utm = "";
            $meses = array("1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4" => "Abril", "5" => "Mayo", "6" => "Junio", "7" => "Julio", "8" => "Agosto", "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");
            $tag = array("2014" => "26", "2015" => "27", "2016" => "28");
            $mes = (int)date("m");
            $label = "gr_ctl".$tag[date("Y")]."_".$meses[$mes];

            while (!feof($archivo))
            {
                $linea = fgets($archivo, 1024);
                // obtengo el valor del dolar observado
                if (preg_match("/id=\"".$label."\"/i", $linea)){
                    $utm = strip_tags($linea);
                }
        
                // cuando obtengo el valor de la utm termino la ejecucion del ciclo
                if($utm != ""){
                    break;
                }
            }
            
            // formula calculada al ojimetro, viendo el codgo fuente del resusltado obtenido
            // en este punto, el valor de la $utm es un string largo que contiene el año y los valores las utm de todos los meses corridos hasta ahora
            // por eso se separan los 9 caracteres que se necesitan, que corresponden al valor de la utm del mes actual.
            // se inicia en 6 para borrar el año de la cadena, 
            // y se multiplica por 9 porque es el largo de la cadena que conforma el valor de la utm, ej: 40.123,00
            return substr($utm, (6 + (9 * ($mes - 1))), 9);
        }
    
        /**
         * Obtiene el valor del IPC
         * 
         * @return $ipc
         */
        public function getIpc(){
            $url = "http://www.banchileinversiones.cl/web/guest/indicadores";
            
            $archivo = fopen($url, "r");
            if (!$archivo){
                $archivo = "";
            }
            
            $ipc = "";
            while (!feof($archivo))
            {
                $linea = fgets($archivo, 1024);
                // obtengo el valor del dolar observado
                if (preg_match("/id=\"_financialIndicators_WAR_portalpublicoindicadoresportlets_INSTANCE_ohX5_parent_IPC_P_HeaderValue\"/i", $linea)){
                    $ipc = $linea;
                }
        
                // cuando obtengo el valor del dolar termino la ejecucion del ciclo
                if($ipc != ""){
                    break;
                }
            }
            $ipc = strip_tags($ipc);
            return trim(substr($ipc, strpos($ipc, "/>") + 2, 12));
            
            /*
            // banco central de chile
            $url = "http://si3.bcentral.cl/Indicadoressiete/secure/Serie.aspx?gcode=IPC&param=RQBxAGsAWgBEAHEAdQA2ADcALQBBAGUANgBIADkAOQBGAGUATwBhAGIAMwBUAE0AbwBwAHIANQA1AHkAOABfAEwASQBmADAAYQBCAHIAZABmAGkAUQBTAEoAVAB6ACMAJABzAEoANABsAE8AUAA0AFEAaAB0AHEAZwB1AEwAMwBuAG0AawB2AEsAVgBqAHEAdQBDAG8AZwA5AHkAaQBjAEoAZwB3ADUAagBSADYAXwBxAE4AcABEAEMATQBWAE4AcwA=";
            
            $archivo = fopen($url, "r");
            if (!$archivo){
                $archivo = "";
            }
            
            $ipc = "";
            $meses = array("1" => "Enero", "2" => "Febrero", "3" => "Marzo", "4" => "Abril", "5" => "Mayo", "6" => "Junio", "7" => "Julio", "8" => "Agosto", "9" => "Septiembre", "10" => "Octubre", "11" => "Noviembre", "12" => "Diciembre");
            $tag = array("2013" => "87", "2014" => "88", "2015" => "89", "2016" => "90");
            $mes = (int)date("m");
            if($mes == 1){
                $label = "gr_ctl".$tag[date("Y") - 1]."_".$meses[12];
            }
            else{
                $label = "gr_ctl".$tag[date("Y")]."_".$meses[$mes - 1];
            }

            while (!feof($archivo))
            {
                $linea = fgets($archivo, 1024);
                // obtengo el valor del dolar observado
                if (preg_match("/id=\"".$label."\"/i", $linea)){
                    $ipc = strip_tags($linea);
                }
        
                // cuando obtengo el valor de la utm termino la ejecucion del ciclo
                if($ipc != ""){
                    break;
                }
            }
            
            // se usa la misma logica que getUtm, pero esta vez la cadena es de largo = 3 caracteres, ej: 1,0
            // y se resta 2 ya que el ipc que se muestra es el del mes anterior, ya que en chile se calcula este valor a fin de mes.
            $ipc = substr($ipc, (6 + (3 * ($mes-2))), 3);
            if(strpos($ipc, ",") !== false){
                return $ipc;
            }
            else{
                return "ND";
            }
             */
        }
    
    }