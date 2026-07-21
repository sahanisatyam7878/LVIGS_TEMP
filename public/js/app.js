document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.querySelector('[data-theme-toggle]');

    if (!toggle) {
        return;
    }

    toggle.addEventListener('click', function () {
        var html = document.documentElement;
        var nextTheme = html.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';

        html.setAttribute('data-theme', nextTheme);
        localStorage.setItem('lvigs-theme', nextTheme);
    });
});
