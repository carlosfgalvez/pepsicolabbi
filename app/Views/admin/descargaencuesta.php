<?php
	header("Pragma: public");
	header("Expires: 0");
	header( "Content-type: application/vnd.ms-excel; charset=UTF-8" );
	header("Content-Disposition: attachment; filename=$filename;");
	header("Pragma: no-cache");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

	echo pack("CCC",0xef,0xbb,0xbf);
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <style>
    table {
        font-family: 'Calibri Light';
        /*BrandonBlack*/
        width: calc(100% - 30px);
        margin-left: 15px;
        border-collapse: collapse;
    }

    th {
        background: #006a5a;
        color: #fff;
        letter-spacing: 1px;
        min-width: 100px;
    }

    td {
        text-align: center;
        line-height: 1;
        padding: 8px;
        /*10px; CG */
        border: 1px solid #c6c6c6;
    }

    .sinborde {
        border-style: hidden !important;
        font-weight: normal;
    }

    .status {
        font-family: 'Calibri Light';
    }

    .aprobado {
        color: #00b34a
    }

    .pendiente {
        color: #0000FF
            /*#ebbc56*/
    }

    .rechazado {
        color: #c42b53
    }

    .ganador {
        color: #FF8C00
    }

    .rechazadoobserva {
        color: #778899;
        font-size: smaller;
    }

    .tablaborder {
        border-collapse: collapse;
    }

    .bgcolormatch {
        background: #c6e0b4;
        color: #006a5a;
    }

    .bgcoloraccazul {
        background: #BDD7EE;
        color: #006a5a;
    }

    .bgcoloracctotal {
        background: #D9D9D9;
        color: #006a5a;
    }

    .bgcoloraccperdida {
        background: #F8CBAD;
        color: #006a5a;
    }

    .bgcoloraccleadsactivos {
        background: #A9D08E;
        color: #006a5a;
    }

    .bgcoloraccleadspascit {
        background: #AEAAAA;
        color: #006a5a;
    }

    .bgcolorhead {
        background: #006a5a;
        color: #fff;
    }

    .titulo {
        font-family: 'Calibri Light';
        font-size: 24px;
        border: none !important;
        text-align: center;
        vertical-align: middle;
    }

    .titulo2 {
        font-family: 'Calibri Light';
        font-size: 18px;
        border: none !important;
        text-align: center;
        vertical-align: middle;
    }

    .sinborde {
        border: none;
        text-align: center;
        vertical-align: middle;
        background: white !important
    }
    </style>
</head>

<body>

    <br />
    <table>
        <tr></tr>
        <tr></tr>
        <tr class="sinborde">
            <th class="sinborde"></th>
            <th class="sinborde" align="center"><img src="<?=$url_base.'/public/ui/images/logo_navbar.png' ?>"
                    alt="Logo" width="70" height="70" align="top"></th>
            <th class="titulo" colspan="6"><?php if (isset($config)) { echo $config['cfg_titulo']; } ?></th>
        </tr>
        <tr class="sinborde">
            <th class="sinborde"></th>
            <th class="sinborde"></th>
            <th class="titulo2" colspan="6"><?=$titulo; ?></th>
        </tr>
				<tr class="sinborde">
						<th class="sinborde"></th>
						<th class="sinborde"></th>
						<th class="titulo2" colspan="6"><?=$year; ?></th>
				</tr>
				<tr class="sinborde">
						<th class="sinborde"></th>
						<th class="sinborde"></th>
						<th class="titulo2" colspan="6"><?=$month; ?></th>
				</tr>
        <tr class="sinborde">
            <th class="sinborde"></th>
            <th class="sinborde"></th>
            <th class="sinborde" colspan="6">Total <?= $count_enviadas ?></th>
        </tr>
        <tr class="sinborde">
            <th class="sinborde"></th>
            <th class="sinborde"></th>
            <th class="sinborde" colspan="6">Fecha <?=$hoy ?></th>
        </tr>
    </table>
    <br />
    <table style='margin-left: auto;  margin-right: auto;'>
        <tr>
            <th style='padding: 5px; color: white; background-color: #28458E'>Fecha</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Hora</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Nombre</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Correo</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Teléfono</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>IP</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 1</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 1</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 2</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 2</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 3</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 3</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 4</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 4</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 5</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 5</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 6</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 6</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 7</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 7</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 8</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 8</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 9</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 9</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 10</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 10</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 11</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 11</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 12</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 12</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 13</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 13</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 14</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 14</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 15</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 15</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 16</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 16</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 17</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 17</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 18</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 18</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 19</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 19</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 20</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 20</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 21</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 21</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Pregunta 22</th>
            <th style='padding: 5px; color: white; background-color: #28458E'>Respuesta 22</th>
        </tr>
        <tbody>
            <?php if (isset($registros)) { echo $registros; }; ?>
        </tbody>
    </table>

</body>

</html>
