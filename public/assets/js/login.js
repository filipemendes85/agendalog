// Toggle de visibilidade da senha
const senhaInput = document.getElementById("inputSenha");
const toggleBtn = document.getElementById("toggleSenha");
const icon = toggleBtn.querySelector("i");

toggleBtn.addEventListener("click", () => {
    const isPassword = senhaInput.type === "password";
    senhaInput.type = isPassword ? "text" : "password";
    
    // Alternar ícones (usando classes do Bootstrap Icons)
    if (isPassword) {
    icon.classList.remove("ti-eye");
    icon.classList.add("ti-eye-off");
    } else {
    icon.classList.remove("ti-eye-off");
    icon.classList.add("ti-eye");
    }
});

// Toast de erro
const toast = document.getElementById('toastLoginErro');
if (toast) {
    const myToast = new bootstrap.Toast(toast);
    myToast.show();
    
    // Auto-dismiss após 5 segundos
    setTimeout(() => {
    myToast.hide();
    }, 5000);
}

// Validação básica do formulário
document.querySelector('form').addEventListener('submit', function(e) {
    const email = document.getElementById('inputEmail').value;
    const password = document.getElementById('inputSenha').value;
    
    if (!email || !password) {
        e.preventDefault();
        alert('Por favor, preencha todos os campos obrigatórios.');
    }
});

// Ajustar altura do container em dispositivos móveis
function adjustContainerHeight() {
    const container = document.querySelector('.login-container');
    const windowHeight = window.innerHeight;
    const headerHeight = document.querySelector('.toast-container')?.offsetHeight || 0;
    
    if (container) {
    container.style.minHeight = `${windowHeight - headerHeight}px`;
    }
}

// Executar ao carregar e redimensionar a janela
window.addEventListener('load', adjustContainerHeight);
window.addEventListener('resize', adjustContainerHeight);