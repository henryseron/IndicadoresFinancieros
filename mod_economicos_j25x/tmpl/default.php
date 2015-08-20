<?php
    defined('_JEXEC') or die('Restricted access');
    
    // estilo 0 == valores en tabla
    if($estilo == "0" && $mostrar_borde_tabla == "1"){
        $td = "table#mod_economicos_table tr td{border-bottom: 1px solid black;}";
        $doc =& JFactory::getDocument();
        $doc->addStyleDeclaration($td);
    }
?>
<div id="mod_economicos">
    <?php if($estilo == "0"){ ?>
    <table style="width: 100%;" id="mod_economicos_table">
        <tbody>
            <?php
            if($valor_uf != ""){
            ?>
            <tr>
                <td>U.F.</td>
                <td><?php if($mostrar_moneda_cambio == "1"){ echo "CLP";} ?>$ <?php echo $valor_uf; ?></td>
            </tr>
            <?php 
            }
            
            if($valor_dolar != ""){
            ?>
            <tr>
                <td>Dólar Obs.</td>
                <td><?php if($mostrar_moneda_cambio == "1"){ echo "CLP";} ?>$ <?php echo $valor_dolar; ?></td>
            </tr>
            <?php 
            }
            
            if($valor_euro != ""){
            ?>
            <tr>
                <td>Euro</td>
                <td><?php if($mostrar_moneda_cambio == "1"){ echo "CLP";} ?>$ <?php echo $valor_euro; ?></td>
            </tr>
            <?php 
            }
            if($valor_utm != ""){
            ?>
            <tr>
                <td>U.T.M.</td>
                <td><?php if($mostrar_moneda_cambio == "1"){ echo "CLP";} ?>$ <?php echo $valor_utm; ?></td>
            </tr>
            <?php 
            }
            
            if($valor_ipc != ""){
            ?>
            <tr>
                <td>I.P.C.</td>
                <td>% <?php echo $valor_ipc; ?></td>
            </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
    <?php
    }
    else{
    ?>
    <marquee behavior="scroll" scrollamount="5" direction="<?php echo ($direccion_marquee == "1") ? "left" : "right"; ?>">
        <?php if($valor_uf != ""){echo "U.F.: ";if($mostrar_moneda_cambio == "1"){ echo "CLP";}echo "$ ".$valor_uf."  -  ";}?>
        <?php if($valor_dolar != ""){echo "Dólar Obs.: ";if($mostrar_moneda_cambio == "1"){ echo "CLP";}echo "$ ".$valor_dolar."  -  ";}?>
        <?php if($valor_euro != ""){echo "Euro: ";if($mostrar_moneda_cambio == "1"){ echo "CLP";}echo "$ ".$valor_euro."  -  ";}?>
        <?php if($valor_utm != ""){echo "U.T.M.: ";if($mostrar_moneda_cambio == "1"){ echo "CLP";}echo "$ ".$valor_utm."  -  ";}?>
        <?php if($valor_ipc != ""){echo "I.P.C.: % ".$valor_ipc;}?>
    </marquee>
    <?php
    }
    ?>
    <br />
    <?php echo "<a href=\"http://si3.bcentral.cl/Indicadoressiete/secure/Indicadoresdiarios.aspx\" target=\"_blank\">Banco Central de Chile</a>" ?>
    <?php if($mostrar_creditos == "1"){
    ?>
    <br/>
    by <a href="http://www.shakingweb.com" target="_blank">Shaking Web</a>
    <?php
    }
    ?>
</div>