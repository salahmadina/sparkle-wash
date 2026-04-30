function showForm(which) {
    document.getElementById('login-form').style.display = which === 'login' ? '' : 'none';
    document.getElementById('signup-form').style.display = which === 'signup' ? '' : 'none';
}

function validateForm() {
    const pw = document.getElementById("su-password").value;
    const cpw = document.getElementById("su-confirm").value;
    const msg = document.getElementById("msg");
    if (pw !== cpw) {
        msg.textContent = "Passwords doesn't match";
        msg.style.color = "red";
        return false;
    }
    return true;
}


