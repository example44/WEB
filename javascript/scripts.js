function goToPage(url_adres) {
    window.location.href = url_adres;
}

function getXmlHttp() {
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function chan(i) {
    const txt = document.getElementsByTagName("button")[i+1].innerText;
    if(txt == "Zobrazit obsah"){
        document.getElementsByTagName("button")[i+1].innerText = "Skryt";
    }else if(txt == "Skryt"){
        document.getElementsByTagName("button")[i+1].innerText = "Zobrazit obsah";
    }
}