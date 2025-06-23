document.addEventListener("DOMContentLoaded", function() {
    const borderAnimate = document.getElementById('borderanimate');
    setTimeout(() => {
        borderAnimate.style.animation = 'none'; // Remove animation
        void borderAnimate.offsetWidth; // Trigger reflow
        borderAnimate.style.animation = 'ReverseTimer'; // Re-add animation
    }, 100); // Delay to ensure the animation is restarted
});
function alerter(content) {
    const alertcard = document.getElementById('alertcard');
    const alertcontent = document.getElementById('alertcontent');
    alertcontent.textContent = content;
    setTimeout(() => {
        alertcard.style.transform = "translateX(0)";
    }, 100);
    setTimeout(() => {
        alertcard.style.transform = "translateX(100vw)";
    }, 4100);
}