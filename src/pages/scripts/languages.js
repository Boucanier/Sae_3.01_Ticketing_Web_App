window.onload = init;

function init() {
    change_fr = document.getElementById("change_fr");
    change_en = document.getElementById("change_en");

    change_fr.onmouseover = mouseInFr;
    change_fr.onmouseout = mouseOutFr;

    change_en.onmouseover = mouseInEn;
    change_en.onmouseout = mouseOutEn;
}

function mouseInFr() {
    fr_text = document.getElementById("fr_text");
    fr_text.appendChild(document.createTextNode("Passer en français"));
}

function mouseOutFr() {
    fr_text = document.getElementById("fr_text");
    fr_text.removeChild(fr_text.lastChild);
}

function mouseInEn() {
    en_text = document.getElementById("en_text");
    en_text.appendChild(document.createTextNode("Switch to english"));
}

function mouseOutEn() {
    en_text = document.getElementById("en_text");
    en_text.removeChild(en_text.lastChild);
}