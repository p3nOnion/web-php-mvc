function Validate() {
    var password = document.getElementById("passwd").value;
    var confirmPassword = document.getElementById("repasswd").value;
    if (password != confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }
    return true;
}