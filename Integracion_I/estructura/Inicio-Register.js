document.addEventListener('DOMContentLoaded', function () {

    // Selecciona el botón de "Iniciar Sesión" por su id
    const loginBtn = document.getElementById('loginBtn');
    
    // Selecciona el botón de "Registrarse" por su id
    const registerBtn = document.getElementById('registerBtn');
    
    // Selecciona el modal de "Iniciar Sesión" por su id
    const loginModal = document.getElementById('loginModal');
    
    // Selecciona el modal de "Registrarse" por su id
    const registerModal = document.getElementById('registerModal');
    
    // Selecciona todos los botones con la clase 'close' (los botones de cierre de los modales)
    const closeModalButtons = document.querySelectorAll('.close');

    // Abrir el modal de "Iniciar Sesión" cuando se hace clic en el botón de iniciar sesión
    loginBtn.addEventListener('click', function () {
        loginModal.style.display = 'flex';
    });

    // Abrir el modal de "Registrarse" cuando se hace clic en el botón de registrarse
    registerBtn.addEventListener('click', function () {
        registerModal.style.display = 'flex';
    });

    // Cierra los modales cuando se hace clic en el botón de cierre
    closeModalButtons.forEach(button => {
        button.addEventListener('click', function () {
            loginModal.style.display = 'none';
            registerModal.style.display = 'none';
        });
    });

    // Cierra los modales cuando se hace clic fuera del área del modal
    window.addEventListener('click', function (e) {
        if (e.target == loginModal) {
            loginModal.style.display = 'none';
        } else if (e.target == registerModal) {
            registerModal.style.display = 'none';
        }
    });

    // Manejo del formulario de registro de usuarios
    const registerForm = document.getElementById('registerForm');
    registerForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(registerForm);

        fetch('./registrar_user.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            if (data === "Registro exitoso") {
                registerModal.style.display = 'none';
                registerForm.reset();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un problema al registrar el usuario.');
        });
    });

    // Manejo del formulario de inicio de sesión
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(loginForm);

        fetch('./procesar_inicio.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                window.location.href = 'pag_inicio.php';
            } else {
                alert('Usuario o contraseña incorrectos');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Hubo un problema al iniciar sesión.');
        });
    });
});
