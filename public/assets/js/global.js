/**
 * Configuração global do SweetAlert2 para loading
 */
const SwalModal = Swal.mixin({
    allowOutsideClick: false,
    allowEscapeKey: false,
    allowEnterKey: false,
    showConfirmButton: false,
    showCancelButton: false,
    timerProgressBar: false,
    didOpen: () => {
        Swal.showLoading();
    }
});

/**
 * Função global para exibir loading
 * @param {string} message - Mensagem de loading (opcional)
 */
function showLoading(message = 'Processando...') {
    Swal.fire({
        title: '<div style="font-size: 1.3rem;">' + message + '</div>',
        didOpen: () => {
            Swal.showLoading(); 
        }
    });
}

/**
 * Função global para esconder loading
 */
function hideLoading() {
    Swal.close();
}

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
                // Mostra loading
                const form = document.getElementById(formId);
                const loadingText = form ? form.getAttribute('data-loading-text') : 'Pesquisando...';
                showLoading(loadingText);
                
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

// Interceptar Fetch API para mostrar loading automático
const originalFetch = window.fetch;
window.fetch = function(...args) {
    showLoading('Carregando...');
    return originalFetch.apply(this, args)
        .then(response => {
            hideLoading();
            return response;
        })
        .catch(error => {
            hideLoading();
            throw error;
        });
};

// Interceptar Axios se estiver disponível
if (typeof axios !== 'undefined') {
    axios.interceptors.request.use(function (config) {
        showLoading('Carregando...');
        return config;
    });

    axios.interceptors.response.use(function (response) {
        hideLoading();
        return response;
    }, function (error) {
        hideLoading();
        return Promise.reject(error);
    });
}

//Apresenta mensagem de erro no lado superior direito da tela
const toast = document.getElementById('toastUser');
if (toast != null){
    var myToast = new bootstrap.Toast(toast);
    myToast.show();
}

document.addEventListener('DOMContentLoaded', function() {
    // Auto-loading em formulários
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const loadingText = this.getAttribute('data-loading-text') || 'Pesquisando...';
            showLoading(loadingText);
        });
    });

    // Auto-loading em links com data-loading
    document.querySelectorAll('a[data-loading]').forEach(link => {
        link.addEventListener('click', function() {
            const loadingText = this.getAttribute('data-loading-text') || 'Carregando...';
            showLoading(loadingText);
        });
    });

    // Confirmação de ações
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

    // Barras de progresso
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

    // Esconder loading em caso de erro
    window.addEventListener('error', hideLoading);
    window.addEventListener('unhandledrejection', hideLoading);

    // ==============================================
    // IMPLEMENTAÇÃO ESPECÍFICA PARA PAGINAÇÃO
    // ==============================================
    
    // Verifica se a função showLoading existe
    const showLoadingExists = typeof showLoading === 'function';
    const hideLoadingExists = typeof hideLoading === 'function';
    
    // Cria funções específicas para paginação se as globais não existirem
    if (!showLoadingExists) {
        window.showPaginationLoading = function(message) {
            // Remove loading existente
            if (typeof hidePaginationLoading === 'function') {
                hidePaginationLoading();
            }
            
            const loadingHtml = `
                <div id="paginationLoading" style="position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(255,255,255,0.95);z-index:9999;display:flex;justify-content:center;align-items:center;flex-direction:column;">
                    <div class="spinner-border text-primary mb-3" style="width:3rem;height:3rem;"></div>
                    <p class="text-primary fw-bold">${message}</p>
                </div>
            `;
            
            document.body.insertAdjacentHTML('beforeend', loadingHtml);
        };
        
        window.hidePaginationLoading = function() {
            const loading = document.getElementById('paginationLoading');
            if (loading) loading.remove();
        };
    }

    // Adiciona eventos aos links de paginação
    document.querySelectorAll('.pagination a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const url = new URL(this.href);
            const page = url.searchParams.get('page') || '1';
            const loadingText = `Carregando página ${page}...`;
            
            // Usa a função apropriada
            if (showLoadingExists) {
                showLoading(loadingText);
            } else {
                showPaginationLoading(loadingText);
            }
            
            setTimeout(() => {
                window.location.href = this.href;
                
                // Esconde o loading após um tempo (fallback)
                setTimeout(() => {
                    if (hideLoadingExists) {
                        hideLoading();
                    } else if (typeof hidePaginationLoading === 'function') {
                        hidePaginationLoading();
                    }
                }, 3000);
            }, 300);
        });
    });

    // ==============================================
    // IMPLEMENTAÇÃO PARA ORDENAÇÃO (SORTING)
    // ==============================================
    
    // Loading para ordenação (sorting)
    document.querySelectorAll('.sortable-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Extrai o título da coluna do texto do link (remove setas ↑↓)
            const linkText = this.textContent.trim();
            const title = linkText.replace(/[↑↓]/g, '').trim();
            
            const loadingText = `Ordenando por ${title}...`;
            
            // Usa a função showLoading existente (se disponível)
            if (typeof showLoading === 'function') {
                showLoading(loadingText);
            } else if (typeof showPaginationLoading === 'function') {
                // Fallback para a função de paginação se existir
                showPaginationLoading(loadingText);
            } else {
                // Fallback mínimo se nenhuma função existir
                console.log(loadingText);
            }
            
            // Redireciona após breve delay
            setTimeout(() => {
                window.location.href = this.href;
                
                // Esconde o loading após um tempo (fallback)
                if (typeof hideLoading === 'function') {
                    setTimeout(hideLoading, 3000);
                } else if (typeof hidePaginationLoading === 'function') {
                    setTimeout(hidePaginationLoading, 3000);
                }
            }, 300);
        });
    });
});