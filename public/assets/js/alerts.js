// public/js/alerts.js

/**
 * Mostra alerta SweetAlert2
 */
function showAlert(type, title, message, options = {}) {
    const defaults = {
        icon: type,
        title: title,
        text: message,
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    };

    const config = { ...defaults, ...options };
    
    // Cores customizadas baseadas no tipo
    const colors = {
        success: { background: '#f0f9f0', iconColor: '#28a745', color: '#155724' },
        error: { background: '#fdf2f2', iconColor: '#dc3545', color: '#721c24' },
        warning: { background: '#fff9eb', iconColor: '#ffc107', color: '#856404' },
        info: { background: '#e8f4fd', iconColor: '#17a2b8', color: '#0c5460' }
    };

    if (colors[type]) {
        config.background = colors[type].background;
        config.iconColor = colors[type].iconColor;
        config.color = colors[type].color;
    }

    Swal.fire(config);
}

/**
 * Alertas rápidos
 */
const Alert = {
    success: (message, title = 'Sucesso!') => {
        showAlert('success', title, message);
    },
    
    error: (message, title = 'Erro!') => {
        showAlert('error', title, message);
    },
    
    warning: (message, title = 'Atenção!') => {
        showAlert('warning', title, message);
    },
    
    info: (message, title = 'Informação') => {
        showAlert('info', title, message);
    },
    
    confirm: (message, title = 'Confirmar ação') => {
        return Swal.fire({
            title: title,
            text: message,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, confirmar!',
            cancelButtonText: 'Cancelar'
        });
    }
};

// Torna global
window.Alert = Alert;