let lastClickedButton = null;

const buttons = document.querySelectorAll('.btn-group button');

buttons.forEach(button => {
button.addEventListener('click', function() {
    lastClickedButton = this.name;
    document.getElementById('rating').value = lastClickedButton;
});
});