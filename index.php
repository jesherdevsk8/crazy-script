<?php
    ini_set("memory_limit", "-1");
    set_time_limit(0);  
?>      

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <div style="text-align:center" > 
        <?php echo "ABERTURA"; ?>
        <div class="form-group">
            <label for="exampleInputPassword1">Inicial:  </label>
            <input required="required" min="1" max="10" type="text" class="form-control inputValueUp" id="inicial" name="inicial">
        </div>
    </div>
    <table class="table">
        <tr>
            <td class="blue-header align-middle text-center trap-2"><?php echo "10 min" ?></td>
            <td class="blue-header align-middle text-center trap-2"><?php echo "20 min" ?></td>
            <td class="blue-header align-middle text-center trap-2"><?php echo "25 min" ?></td>
            <td class="blue-header align-middle text-center trap-2"><?php echo "30 min" ?></td>
            <td class="blue-header align-middle text-center trap-2"><?php echo "35 min" ?></td>
            <td class="blue-header align-middle text-center trap-2"><?php echo "40 min" ?></td>
        </tr>
        <tr>
            <th style="display: none;" id="resultado_10">0</th>
            <td style="display: none;" id="resultado_20">0</td>
            <td style="display: none;" id="resultado_25">0</td>
            <td style="display: none;" id="resultado_30">0</td>
            <td style="display: none;" id="resultado_35">0</td>
            <td style="display: none;" id="resultado_40">0</td>
        </tr>
    </table>
    <?php echo "<br> <br>"; ?>

    <div style="text-align:center" >
        <?php echo "(Resultado Intermediario) "; ?>
    </div>
    <table class="table">
        <tr>
            <td id="intermediate_result10">0</td>
            <td id="intermediate_result20">0</td>
            <td id="intermediate_result25">0</td>
            <td id="intermediate_result30">0</td>
            <td id="intermediate_result35">0</td>
            <td id="intermediate_result40">0</td>
        </tr>
    </table>

    <?php echo "<br> <br>"; ?>

    <div style="text-align:center" >
        <?php echo "LIVE (Decorrer da partida) "; ?>
    </div>
    <table class="table">
        <tr>
            <td class="blue-header align-middle text-center trap-2">
                <input type="text" class="inputValue" id="inputValue_10" disabled="true">
                <input type="hidden" id="hidden_input_10">
            </td>
            <td class="blue-header align-middle text-center trap-2">
                <input type="text" class="inputValue" id="inputValue_20" disabled="true">
                <input type="hidden" id="hidden_input_20">
            </td>
            <td class="blue-header align-middle text-center trap-2">
                <input type="text" class="inputValue" id="inputValue_25" disabled="true">
                <input type="hidden" id="hidden_input_25">
            </td>
            <td class="blue-header align-middle text-center trap-2">
                <input type="text" class="inputValue" id="inputValue_30" disabled="true">
                <input type="hidden" id="hidden_input_30">
            </td>
            <td class="blue-header align-middle text-center trap-2">
                <input type="text" class="inputValue" id="inputValue_35" disabled="true">
                <input type="hidden" id="hidden_input_35">
            </td>
            <td class="blue-header align-middle text-center trap-2">
                <input type="text" class="inputValue" id="inputValue_40" disabled="true">
                <input type="hidden" id="hidden_input_40">
            </td>
        </tr>
        <tr>
            <td id="result_input_10">0</td>
            <td id="result_input_20">0</td>
            <td id="result_input_25">0</td>
            <td id="result_input_30">0</td>
            <td id="result_input_35">0</td>
            <td id="result_input_40">0</td>
        </tr>
    </table>

    <?php echo "<br> <br>"; ?>
    <script src="script-obfuscator.js" type="module"></script>
</body>
</html>
