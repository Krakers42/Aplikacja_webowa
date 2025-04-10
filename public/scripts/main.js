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
        window.location.href = "login.html";
    }
}

document.addEventListener("DOMContentLoaded", () => {
    new ChangePasswordHandler(".reset-password-form");
});