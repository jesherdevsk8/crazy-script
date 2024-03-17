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
    <link href="../public/css/trap.css" rel="stylesheet">
    <!-- <meta http-equiv="refresh" content="5 ;url=http://localhost/Components/real_time.php"> -->
<style>
    td, th {
        padding: .5em;
        margin: 0;
        /*border: 1px solid #ccc;*/
        text-align: center;
    }

    th{
        background-color: #EEE;
    }

    td{
        font-weight:bold;
        background-color: #EEE;
    }

    table{
        width: 100%;
        margin-bottom : .5em;
        table-layout: fixed;
        text-align: center;
    }

    .inputValue {
        width: 100%;
        box-sizing: border-box;
        margin-top: 0px;
    }
</style>
<script>
    function updateTable(input) {
        // TABELA DE CIMA
        var inicial = parseFloat(input);
        
        if (inicial) {
            // Inicio 10
            var inicial_porc_11 = (inicial / 100) * 17.5;
            var inicial_porc_10 = inicial_porc_11 + inicial;
            var Result_10 = inicial_porc_10.toFixed(3).replace('.', ',');

            // Inicio 20
            var inicial_porc_21 = (inicial_porc_10 / 100) * 17.5;
            var inicial_porc_20 = inicial_porc_21 + inicial_porc_10;
            var Result_20 = inicial_porc_20.toFixed(3).replace('.', ',');
            
            // Inicio 25
            var inicial_porc_26 = (inicial_porc_20 / 100) * 17.5;
            var inicial_porc_25 = inicial_porc_26 + inicial_porc_20;
            var Result_25 = inicial_porc_25.toFixed(3).replace('.', ',');
            
            // Inicio 30
            var inicial_porc_31 = (inicial_porc_25 / 100) * 17.5;
            var inicial_porc_30 = inicial_porc_31 + inicial_porc_25;
            var Result_30 = inicial_porc_30.toFixed(3).replace('.', ',');
            
            // Inicio 35
            var inicial_porc_36 = (inicial_porc_30 / 100) * 35;
            var inicial_porc_35 = inicial_porc_36 + inicial_porc_30;
            var Result_35 = inicial_porc_35.toFixed(3).replace('.', ',');
            
            // Inicio 40
            var inicial_porc_41 = (inicial_porc_35 / 100) * 38;
            var inicial_porc_40 = inicial_porc_41 + inicial_porc_35;
            var Result_40 = inicial_porc_40.toFixed(3).replace('.', ',');


            document.getElementById('resultado_10').textContent = Result_10;
            document.getElementById('resultado_20').textContent = Result_20;
            document.getElementById('resultado_25').textContent = Result_25;
            document.getElementById('resultado_30').textContent = Result_30;
            document.getElementById('resultado_35').textContent = Result_35;
            document.getElementById('resultado_40').textContent = Result_40;
        } else {
            document.getElementById('resultado_10').textContent = 0;
            document.getElementById('resultado_20').textContent = 0;
            document.getElementById('resultado_25').textContent = 0;
            document.getElementById('resultado_30').textContent = 0;
            document.getElementById('resultado_35').textContent = 0;
            document.getElementById('resultado_40').textContent = 0;
        }
    }

    var cacheHiddenInput = []
    var isFirstCall = true;

    function formula(stringValue, columnResult, resultInput, hiddenInput) {
        cacheHiddenInput.push(hiddenInput);

        if (isFirstCall) {
            isFirstCall = false
            return ((stringValue / columnResult) - 1) * 100;
        } else {
            var lastElement = cacheHiddenInput[cacheHiddenInput.length - 1]
            cacheHiddenInput.shift();
            return ((stringValue / parseFloat(lastElement.value.replace(',', '.'))) - 1) * 100;
        }
    }


    // TABELA DE BAIXO
    function calcularInput(stringValue, inputID){
        var splitResult = inputID.split('_');
        var lastValue = splitResult[splitResult.length - 1];
        var resultInput = document.getElementById('result_input_' + lastValue);
        var hiddenInput = document.getElementById('hidden_input_' + lastValue);

        if (resultInput) {
            if (stringValue) {
                var columnID = document.getElementById('resultado_' + lastValue);
                var columnResult = parseFloat(columnID.textContent.replace(',', '.'));
                var result = formula(stringValue, columnResult, resultInput, hiddenInput)
        
                resultInput.textContent = result.toFixed(2).replace('.', ',');
            } else {
                resultInput.textContent = 0;
            }
        }
    }

    function updateTableDown(inputID) {
        var inputDown = document.getElementById(inputID);
        var inputValue = parseFloat(inputDown.value.replace(',', '.'));

        calcularInput(inputValue, inputID);
    }


    // ATUALIZAÇÃO DAS TABELAS
    document.addEventListener('DOMContentLoaded', function() {
        // TABELA DE CIMA
        var input = document.getElementById('inicial');

        if (input) {
            input.addEventListener('change', function() {
                updateTable(input.value);
                toggleInputs(input.value);
            });
        }

        // TABELA DE BAIXO
        var inputIDs = ['inputValue_10', 'inputValue_20', 'inputValue_25', 'inputValue_30', 'inputValue_35', 'inputValue_40'];
        
        inputIDs.forEach(function(id) {
            var input = document.getElementById(id);
            
            if (input) {
                input.addEventListener('change', function() {
                    updateTableDown(id);
                });
            };
        });

        // Função para habilitar ou desabilitar os inputs da tabela abaixo
        function toggleInputs(value) {
            var inputs = document.querySelectorAll('.inputValue');
            inputs.forEach(function(input) {
                input.disabled = !value;
                input.value = '';
            });
        }
    });
</script>

</head>
<body>
    
    <div style="text-align:center" > 
        <?php echo "ABERTURA"; ?>
        <div class="form-group">
            <label for="exampleInputPassword1">Inicial:  </label>
            <input required="required" min="1" max="10" type="text" class="form-control" id="inicial" name="inicial" placeholder="Insira um valor">
        </div>
    </div>

    
        <table border="2" class="table">
            <tr>
                <td class="align-middle text-center trap-2"><?php echo "10 min" ?></td>
                <td class="align-middle text-center trap-2"><?php echo "20 min" ?></td>
                <td class="align-middle text-center trap-2"><?php echo "25 min" ?></td>
                <td class="align-middle text-center trap-2"><?php echo "30 min" ?></td>
                <td class="align-middle text-center trap-2"><?php echo "35 min" ?></td>
                <td class="align-middle text-center trap-2"><?php echo "40 min" ?></td>
            </tr>
            <tr>
                <th id="resultado_10">0</th>
                <td id="resultado_20">0</td>
                <td id="resultado_25">0</td>
                <td id="resultado_30">0</td>
                <td id="resultado_35">0</td>
                <td id="resultado_40">0</td>
            </tr>
        </table>
        <?php echo "<br> <br>"; ?>

        <div style="text-align:center" >
            <?php echo "LIVE (Decorrer da partida) "; ?>
        </div>
        <table border="2" class="table">
            <tr>
                <td class="align-middle text-center trap-2">
                    <input type="text" class="inputValue" id="inputValue_10" placeholder="Insira um valor" disabled="true">
                    <input type="hidden" id="hidden_input_10">
                </td>
                <td class="align-middle text-center trap-2">
                    <input type="text" class="inputValue" id="inputValue_20" placeholder="Insira um valor" disabled="true">
                    <input type="hidden" id="hidden_input_20" value="1,692">
                </td>
                <td class="align-middle text-center trap-2">
                    <input type="text" class="inputValue" id="inputValue_25" placeholder="Insira um valor" disabled="true">
                    <input type="hidden" id="hidden_input_25" value="1,951">
                </td>
                <td class="align-middle text-center trap-2">
                    <input type="text" class="inputValue" id="inputValue_30" placeholder="Insira um valor" disabled="true">
                    <input type="hidden" id="hidden_input_30" value="2,233">
                </td>
                <td class="align-middle text-center trap-2">
                    <input type="text" class="inputValue" id="inputValue_35" placeholder="Insira um valor" disabled="true">
                    <input type="hidden" id="hidden_input_35" value="2,970">
                </td>
                <td class="align-middle text-center trap-2">
                    <input type="text" class="inputValue" id="inputValue_40" placeholder="Insira um valor" disabled="true">
                    <input type="hidden" id="hidden_input_40" value="0,00">
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
</table>
</body>
</html>
