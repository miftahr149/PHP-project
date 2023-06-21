const configureElement = (element, imageArray) => {
    let state = element.value;
    let [hover, unhover] = imageArray;

    const changeImage = (image) => {
        element.style.backgroundImage = image; 
    }

    if (state === 'true') {
        [hover, unhover] = [unhover, hover];
        changeImage(unhover);
    }

    element.onmouseover = () => changeImage(hover);
    element.onmouseout = () => changeImage(unhover);
}

configureElement(
    document.querySelector('.heart-button'),
    [
        "url('../img/heart-on.ico')",
        "url('../img/heart.ico')"
    ]
);

configureElement(
    document.querySelector('.save-button'),
    [
        "url('../img/bookmark-on.ico')",
        "url('../img/bookmark.ico')"
    ]
)