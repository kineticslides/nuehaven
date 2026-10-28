document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('[data-password-toggle]');
    const password = document.getElementById('password');

    if (!toggle || !password) {
        return;
    }

    toggle.addEventListener('click', () => {
        const isVisible = password.type === 'text';

        password.type = isVisible ? 'password' : 'text';
        toggle.textContent = isVisible ? 'Show' : 'Hide';
        toggle.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');
    });
});
