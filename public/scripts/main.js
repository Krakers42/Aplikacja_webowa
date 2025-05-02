class LoginHandler {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector);
        if (this.form) {
            this.form.addEventListener("submit", this.handleSubmit.bind(this));
        }
    }

    handleSubmit(event) {
        event.preventDefault();
        window.location.href = "dashboard.html";
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new LoginHandler(".login-form");
});



class RegisterHandler {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector);
        if (this.form) {
            this.form.addEventListener("submit", this.handleSubmit.bind(this));
        }
    }

    handleSubmit(event) {
        event.preventDefault();
        window.location.href = "dashboard.html";
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new RegisterHandler(".register-form");
});



class ChangePasswordHandler {
    constructor(formSelector) {
        this.form = document.querySelector(formSelector);
        if (this.form) {
            this.form.addEventListener("submit", this.handleSubmit.bind(this));
        }
    }

    handleSubmit(event) {
        event.preventDefault();
        window.location.href = "login.php";
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new ChangePasswordHandler(".reset-password-form");
});



/*hamburger_menu*/
document.getElementById('hamburger_menu').addEventListener('click',  function() {
    document.querySelector('aside').classList.toggle('open');    
});