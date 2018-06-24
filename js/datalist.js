if(window.location.href.indexOf("bestaand") > -1) {
  document.querySelector('input[list]').addEventListener('input', function(e) {
    var input = e.target,
        list = input.getAttribute('list'),
        options = document.querySelectorAll('#' + list + ' option'),
        hiddenInput = document.getElementById(input.id + '-hidden'),
        inputValue = input.value;

    hiddenInput.value = inputValue;

    for(var i = 0; i < options.length; i++) {
        var option = options[i];

        console.log(option.innerText + " " + inputValue);
        if(option.innerText.trim() == inputValue.trim()) {
            hiddenInput.value = option.getAttribute('data-value');
            break;
        }
    }
  });
  }
