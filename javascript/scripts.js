function kPosouzeni(url_adres) {
    window.location.href = "index.php?page=editPosud&&id_recenze="+id_rec;
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
    const txt = document.getElementsByTagName("button")[i+2].innerText;
    if(txt == "Zobrazit obsah"){
        document.getElementsByTagName("button")[i+2].innerText = "Skryt";
    }else if(txt == "Skryt"){
        document.getElementsByTagName("button")[i+2].innerText = "Zobrazit obsah";
    }
}
