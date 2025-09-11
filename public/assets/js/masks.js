// public/js/masks.js

/**
 * Aplica máscara de CEP
 */
function applyCepMask(input) {
    input.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 8) value = value.slice(0, 8);
        if (value.length > 5) {
            value = value.replace(/(\d{5})(\d{0,3})/, '$1-$2');
        }
        e.target.value = value;
    });
}

/**
 * Aplica máscara de telefone
 */
function applyPhoneMask(input) {
    input.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        if (value.length > 11) value = value.slice(0, 11);
        
        if (value.length > 10) {
            value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        } else if (value.length > 6) {
            value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
        } else if (value.length > 2) {
            value = value.replace(/(\d{2})(\d{0,5})/, '($1) $2');
        }
        e.target.value = value;
    });
}

/**
 * Aplica máscara de CPF/CNPJ baseado no tipo
 */
function applyDocumentMask(input, tipoPessoaSelect) {
    const updateMask = function() {
        const tipo = tipoPessoaSelect ? tipoPessoaSelect.value : 'F';
        let value = input.value.replace(/\D/g, '');
        
        if (tipo === 'J') {
            // CNPJ
            if (value.length > 14) value = value.slice(0, 14);
            if (value.length > 12) {
                value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{0,2})/, '$1.$2.$3/$4-$5');
            }
            input.placeholder = '00.000.000/0000-00';
        } else {
            // CPF
            if (value.length > 11) value = value.slice(0, 11);
            if (value.length > 9) {
                value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{0,2})/, '$1.$2.$3-$4');
            }
            input.placeholder = '000.000.000-00';
        }
        
        input.value = value;
    };

    // Aplicar máscara inicial
    updateMask();
    
    // Atualizar quando o tipo mudar
    if (tipoPessoaSelect) {
        tipoPessoaSelect.addEventListener('change', updateMask);
    }
    
    // Aplicar máscara durante a digitação
    input.addEventListener('input', updateMask);
}

/**
 * Inicializa todas as máscaras da página
 */
function initMasks() {
    // Máscara de CEP
    document.querySelectorAll('input[placeholder*="00000-000"], input[name="cep"]').forEach(applyCepMask);
    
    // Máscara de Telefone
    document.querySelectorAll('input[placeholder*="(27)"], input[name="telefone"]').forEach(applyPhoneMask);
    
    // Máscara de documento (CPF/CNPJ)
    const docInput = document.getElementById('txtDocumento');
    const tipoSelect = document.getElementById('tipoPessoa');
    
    if (docInput) {
        applyDocumentMask(docInput, tipoSelect);
    }
}

// Inicializar quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', initMasks);