// public/js/app.js

/**
 * Funções globais utilitárias
 */
const App = {
    /**
     * Formata telefone
     */
    formatPhone: function(phone) {
        if (!phone) return 'N/A';
        const numbers = phone.replace(/\D/g, '');
        
        if (numbers.length === 11) {
            return numbers.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        }
        if (numbers.length === 10) {
            return numbers.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        }
        return phone;
    },

    /**
     * Formata CPF/CNPJ
     */
    formatDocument: function(document) {
        if (!document) return 'N/A';
        const numbers = document.replace(/\D/g, '');
        
        if (numbers.length === 11) {
            return numbers.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        }
        if (numbers.length === 14) {
            return numbers.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
        }
        return document;
    },

    /**
     * Mostra mensagem de alerta
     */
    showAlert: function(message, type = 'success') {
        // Implementação de alertas
        alert(`${type.toUpperCase()}: ${message}`);
    }
};

// Torna global
window.App = App;