// Simple notification popup
function showNotification(message, type = 'success') {
    const div = document.createElement('div');
    div.className = 'alert ' + (type === 'success' ? 'success' : '');
    div.innerText = message;
    document.body.prepend(div);

    setTimeout(() => {
        div.remove();
    }, 3000);
}

// Simple form validation
function validateForm(formId) {
    const form = document.getElementById(formId);
    const inputs = form.querySelectorAll('input, select, textarea');
    let isValid = true;

    inputs.forEach(input => {
        if (input.hasAttribute('required') && input.value.trim() === '') {
            isValid = false;
            alert(`Please fill ${input.name}`);
            input.focus();
        }
    });

    return isValid;
}
