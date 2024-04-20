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

var isFirstCall = true;

function formula(stringValue, columnResult, projetado, inputID) {
  var hiddenInputResult = document.getElementById(projetado[inputID]);
  
  if (isFirstCall || !hiddenInputResult) {
    isFirstCall = false
    return ((stringValue / columnResult) - 1) * 100;
  } else {
    var formulaResult = ((stringValue / parseFloat(hiddenInputResult.value)) - 1) * 100;
  
    return formulaResult;
  }
}

function projetado(stringValue, hiddenInput) {
  var result;

  switch (hiddenInput.id) {
    case 'hidden_input_10':
    case 'hidden_input_20':
    case 'hidden_input_25':
      result = (stringValue * (17.5 / 100)) + stringValue;
      break;
    case 'hidden_input_30':
      result = (stringValue * (35 / 100)) + stringValue;
      break;
    case 'hidden_input_35':
      result = (stringValue * (38 / 100)) + stringValue;
      break;
    default:
      result = 0;
  }
  return hiddenInput.value = result;
}

function intermediateCalc(stringValue, columnResult, intermediate) {
  var result =  ((stringValue / columnResult) - 1) * 100
  intermediate.textContent = result.toFixed(2);
  
  if (result <= -7) {
    intermediate.style.color = 'green';
  } else if (result > -7) {
    intermediate.style.color = 'black';
  } else {
    intermediate.style.color = '';
  }
}

// TABELA DE BAIXO
function calcularInput(stringValue, inputID, projetado_hash){
  var splitResult = inputID.split('_');
  var lastValue = splitResult[splitResult.length - 1];
  var resultInput = document.getElementById('result_input_' + lastValue);
  var hiddenInput = document.getElementById('hidden_input_' + lastValue);
  var intermediate = document.getElementById('intermediate_result' + lastValue);
  hiddenInput.value = projetado(stringValue, hiddenInput);
  
  if (resultInput) {
    if (stringValue) {
      var columnID = document.getElementById('resultado_' + lastValue);
      var columnResult = parseFloat(columnID.textContent.replace(',', '.'));
      var result = formula(stringValue, columnResult, projetado_hash, inputID).toFixed(2);
      resultInput.textContent = result;
      
      if (result <= -7) {
        resultInput.style.color = 'green';
      } else if (result > -7) {
        resultInput.style.color = 'black';
      }else {
        resultInput.style.color = '';
      }
      
      intermediateCalc(stringValue, columnResult, intermediate);
    } else {
      resultInput.textContent = 0;
    }
  }
}

function updateTableDown(inputID, projetado_hash) {
  var inputDown = document.getElementById(inputID);
  var inputValue = parseFloat(inputDown.value.replace(',', '.'));
  
  calcularInput(inputValue, inputID, projetado_hash);
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
  var projetado_hash = {
    'inputValue_20': 'hidden_input_10',
    'inputValue_25': 'hidden_input_20',
    'inputValue_30': 'hidden_input_25',
    'inputValue_35': 'hidden_input_30',
    'inputValue_40': 'hidden_input_35'
  };
  var inputIDs = ['inputValue_10', 'inputValue_20', 'inputValue_25', 'inputValue_30', 'inputValue_35', 'inputValue_40'];
  
  inputIDs.forEach(function(id) {
    var input = document.getElementById(id);
    
    if (input) {
      input.addEventListener('change', function() {
        updateTableDown(id, projetado_hash);
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
