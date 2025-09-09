document.addEventListener('DOMContentLoaded', function() {
 
    const tipoPessoaSelect = document.getElementById('tipoPessoa');
    const documentoInput = document.getElementById('txtDocumento');
    
    if (tipoPessoaSelect && documentoInput) {
        tipoPessoaSelect.addEventListener('change', function() {
        });
    }

    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Validações específicas da criação
        });
    }
});