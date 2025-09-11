document.addEventListener('DOMContentLoaded', function() {
 
    const tipoPessoaSelect = document.getElementById('tipoPessoa');
    const documentoInput = document.getElementById('txtDocumento');
    
    if (tipoPessoaSelect && documentoInput) {
        tipoPessoaSelect.addEventListener('change', function() {
        });
    }

    initFormProgress('clientsForm', 'progressBar');
});