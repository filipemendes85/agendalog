/**
 * Função global para exibir diálogos de confirmação personalizados usando SweetAlert2, com suporte a múltiplos tipos de ações (submissão de formulários, redirecionamentos URL ou callbacks personalizados).
 * @param {string} mensagem - Mensagem de confirmação a ser exibida ao usuário
 * @param {string} formId - ID do formulário a ser submetido se o usuário confirmar
 * @param {string | function} urlSim - URL para redirecionamento ou função a ser executada na confirmação
 * @param {string | function} urlNao - URL para redirecionamento ou função a ser executada no cancelamento
 * @param {string} title - Título do diálogo de confirmação
 */
function confirmAction(mensagem, formId = '', urlSim = '', urlNao = '', title = 'Confirmação') {
    const mensagemFormatada = mensagem.replace(/\n/g, '<br>');

    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: title,
            html: mensagemFormatada,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6', 
            cancelButtonColor: '#d33', 
            confirmButtonText: 'Sim, confirmo!',
            cancelButtonText: 'Não',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: true,
        }).then((result) => {
            if (result.isConfirmed) {
                // Se formId for fornecido, submete o formulário
                if (formId) {
                    document.getElementById(formId).submit();
                } else if (urlSim) {
                    if (typeof urlSim === 'function') {
                        urlSim();
                    } else {
                        window.location.href = urlSim;
                    }
                }
            } else if (urlNao) {
                if (typeof urlNao === 'function') {
                    urlNao();
                } else {
                    window.location.href = urlNao;
                }
            }
        });
    } else {
        if (confirm(mensagem)) {
            if (typeof urlSim === 'function') {
                urlSim();
            } else {
               window.location.href = urlSim;
            }
        } else if (urlNao) {
            if (typeof urlNao === 'function') {
                urlNao();
            } else {
                window.location.href = urlNao;
            }
        }
    }
}

/**
 * Inicializa a barra de progresso para formulários
 * @param {string} formId - ID do formulário
 * @param {string} progressBarId - ID da barra de progresso
 * @param {Object} options - Opções personalizadas (opcional)
 */
function initFormProgress(formId, progressBarId, options = {}) {
    const defaults = {
        requiredSelector: '[required]',
        showPercentage: true,
        percentageElementId: null,
        updateOnInput: true,
        updateOnChange: true
    };
    
    const config = { ...defaults, ...options };
    
    const form = document.getElementById(formId);
    const progressBar = document.getElementById(progressBarId);
    
    if (!form || !progressBar) {
        console.warn('Formulário ou barra de progresso não encontrado');
        return;
    }
    
    function updateProgress() {
        const requiredFields = form.querySelectorAll(config.requiredSelector);
        let filledFields = 0;
        
        if (requiredFields.length === 0) {
            progressBar.style.width = '100%';
            if (config.showPercentage && config.percentageElementId) {
                document.getElementById(config.percentageElementId).textContent = '100%';
            }
            return;
        }

        requiredFields.forEach(field => {
            if (field.type === 'checkbox' || field.type === 'radio') {
                if (field.checked) filledFields++;
            } else if (field.type === 'select-multiple') {
                if (field.selectedOptions.length > 0) filledFields++;
            } else if (field.value.trim() !== '') {
                filledFields++;
            }
        });

        const progress = Math.round((filledFields / requiredFields.length) * 100);
        progressBar.style.width = `${progress}%`;
        
        // Atualiza texto de porcentagem se configurado
        if (config.showPercentage && config.percentageElementId) {
            document.getElementById(config.percentageElementId).textContent = `${progress}%`;
        }
    }
    
    // Adiciona event listeners
    if (config.updateOnInput) {
        form.addEventListener('input', updateProgress);
    }
    
    if (config.updateOnChange) {
        form.addEventListener('change', updateProgress);
    }
    
    // Atualiza inicialmente
    updateProgress();
    
    // Retorna função para atualização manual se necessário
    return updateProgress;
}

//Apresenta mensagem de erro no lado superior direito da tela
const toast = document.getElementById('toastUser');
if (toast != null){
    var myToast = new bootstrap.Toast(toast);
    myToast.show();
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('button.confirm-action, a.confirm-action').forEach(element => {
        element.addEventListener('click', function(e) {
            e.preventDefault();

            const message = this.getAttribute('data-confirm-message') || 'Tem certeza que deseja realizar esta ação?';

            confirmAction(message, function() {
                // Se for um link, redireciona
                if (this.tagName === 'A') {
                    window.location.href = this.href;
                } 
                // Se for um botão dentro de formulário, submete o formulário
                else if (this.form) {
                    this.form.submit();
                }
            }.bind(this));
        });
    });

    document.querySelectorAll('[data-progress-bar]').forEach(form => {
        const formId = form.id;
        const progressBarId = form.getAttribute('data-progress-bar');
        const percentageElementId = form.getAttribute('data-percentage-element');
        
        if (formId && progressBarId) {
            initFormProgress(formId, progressBarId, {
                showPercentage: percentageElementId !== null,
                percentageElementId: percentageElementId
            });
        }
    });
});
