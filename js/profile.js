const showFunction = (selector) => {
    const blackScreen = document.querySelector(selector);
    blackScreen.classList.toggle("none");
}

const background = document.querySelector('#backgroundEdit');
const topValue = document.querySelector("#topBackground");
let isDragging = false;
let startMouseY = 0;
let startBackgroundY = 0;

background.addEventListener('mousedown', function (event) {
    isDragging = true;
    startMouseY = event.clientY;
    startBackgroundY = background.offsetTop;
});

document.addEventListener('mousemove', function (event) {
    if (isDragging) {
        const offsetY = event.clientY - startMouseY;
        const newBackgroundY = startBackgroundY + offsetY;

        let value = `${newBackgroundY}px`;

        if (newBackgroundY <= -background.clientHeight * (1 - .35)) {
            value = `${-background.clientHeight * (1 - .35)}px`;
        }

        if (newBackgroundY >= 0) {
            value = "0px";
        }

        background.style.top = value;
        topValue.value = value;
        console.log(topValue.value)
    }
});

document.addEventListener('mouseup', function () {
    isDragging = false;
});