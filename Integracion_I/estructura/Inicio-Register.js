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
        // Cambia el estilo del modal para mostrarlo (display: flex)
        loginModal.style.display = 'flex';
    });

    // Abrir el modal de "Registrarse" cuando se hace clic en el botón de registrarse
    registerBtn.addEventListener('click', function () {
        // Cambia el estilo del modal para mostrarlo (display: flex)
        registerModal.style.display = 'flex';
    });

    // Cierra los modales cuando se hace clic en el botón de cierre (ícono "x" en el modal)
    closeModalButtons.forEach(button => {
        button.addEventListener('click', function () {
            // Oculta ambos modales estableciendo display a 'none'
            loginModal.style.display = 'none';
            registerModal.style.display = 'none';
        });
    });

    // Cierra los modales cuando se hace clic fuera del área del modal (en la pantalla, pero fuera del contenido del modal)
    window.addEventListener('click', function (e) {
        // Si el clic es en el fondo del modal de inicio de sesión, lo oculta
        if (e.target == loginModal) {
            loginModal.style.display = 'none';
        // Si el clic es en el fondo del modal de registro, lo oculta
        } else if (e.target == registerModal) {
            registerModal.style.display = 'none';
        }
    });

    // Manejo del formulario de registro de usuarios
    const registerForm = document.getElementById('registerForm');
    registerForm.addEventListener('submit', function (e) {
        // Prevenir que el formulario se envíe normalmente (no se recargará la página)
        e.preventDefault();
        
        // Obtiene los valores de los campos de email y contraseñas
        const email = document.getElementById('registerEmail').value;
        const password = document.getElementById('registerPassword').value;
        const confirmPassword = document.getElementById('registerConfirmPassword').value;

        // Verifica si las contraseñas coinciden
        if (password !== confirmPassword) {
            alert('Las contraseñas no coinciden');
            return; // Detiene la ejecución si las contraseñas no coinciden
        }

        // Recupera los usuarios almacenados en localStorage o crea un arreglo vacío si no hay ninguno
        const users = JSON.parse(localStorage.getItem('users')) || [];
        
        // Verifica si ya existe un usuario con el mismo email
        const userExists = users.some(user => user.email === email);

        // Si el usuario ya existe, muestra una alerta
        if (userExists) {
            alert('El usuario ya existe');
        } else {
            // Si el usuario no existe, lo añade al arreglo y lo guarda en localStorage
            users.push({ email: email, password: password });
            localStorage.setItem('users', JSON.stringify(users));
            alert('Registro exitoso');
            
            // Oculta el modal de registro y reinicia el formulario
            registerModal.style.display = 'none';
            registerForm.reset();
        }
    });

    // Manejo del formulario de inicio de sesión
    const loginForm = document.getElementById('loginForm');
    loginForm.addEventListener('submit', function (e) {
        // Prevenir el envío por defecto del formulario
        e.preventDefault();
        
        // Obtiene los valores de los campos de email y contraseña del formulario de login
        const email = document.getElementById('loginEmail').value;
        const password = document.getElementById('loginPassword').value;

        // Recupera los usuarios almacenados en localStorage
        const users = JSON.parse(localStorage.getItem('users')) || [];
        
        // Busca un usuario que coincida con el email y contraseña ingresados
        const user = users.find(user => user.email === email && user.password === password);

        // Si encuentra un usuario que coincide, muestra un mensaje de bienvenida
        if (user) {
            alert(`¡Bienvenido ${email}!`);
            
            // Oculta el modal de inicio de sesión y reinicia el formulario
            loginModal.style.display = 'none';
            loginForm.reset();
        } else {
            // Si no encuentra un usuario que coincida, muestra una alerta de error
            alert('Email o contraseña incorrectos');
        }
    });
});
