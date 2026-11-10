document.querySelectorAll('[data-password-toggle]').forEach((toggle) => {
    const target = document.getElementById(toggle.dataset.passwordTarget);

    if (!target) {
        return;
    }

    const showIcon = toggle.querySelector('[data-password-icon="show"]');
    const hideIcon = toggle.querySelector('[data-password-icon="hide"]');

    const updatePasswordVisibility = (isVisible) => {
        target.type = isVisible ? 'text' : 'password';
        toggle.setAttribute('aria-label', isVisible ? 'Hide password' : 'Show password');
        toggle.setAttribute('title', isVisible ? 'Hide password' : 'Show password');

        showIcon?.classList.toggle('scale-100', isVisible);
        showIcon?.classList.toggle('scale-75', !isVisible);
        showIcon?.classList.toggle('rotate-0', isVisible);
        showIcon?.classList.toggle('rotate-12', !isVisible);
        showIcon?.classList.toggle('opacity-100', isVisible);
        showIcon?.classList.toggle('opacity-0', !isVisible);

        hideIcon?.classList.toggle('scale-100', !isVisible);
        hideIcon?.classList.toggle('scale-75', isVisible);
        hideIcon?.classList.toggle('rotate-0', !isVisible);
        hideIcon?.classList.toggle('-rotate-12', isVisible);
        hideIcon?.classList.toggle('opacity-100', !isVisible);
        hideIcon?.classList.toggle('opacity-0', isVisible);
    };

    updatePasswordVisibility(false);

    toggle.addEventListener('click', () => {
        updatePasswordVisibility(target.type !== 'text');
    });
});