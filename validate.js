const nasc = document.getElementById('nasc')


function validate(item) {
    item.setCustomValidaty('');
    item.checkValidaty();


    if (item == nasc) {
        let hoje = new Date(); //data atual
        let dnasc = new Date(nasc.value);

        let idade = hoje.getFullYear() - dnasc.getFullYear();
        let m = hoje.getMonth() - dnasc.getMonth();
        if (m < 0 || (m === 0 && hoje.getDate() < dnasc.getDate())) {
            idade--;
        }
        if (idade >= 0) document.getElementById('idade').value = idade + ' anos ';
        else document.getElementById('idade').value = "Essa data não é válida"
    }
}

nasc.addEventListener('input', function () { validate(nasc)});

