function goToPage(url_adres) {
    window.location.href = url_adres;
}

function kontrolUsername(str) {
    if (str == "") {
        document.getElementById("usName").innerHTML = "";
        return;
    } else {
        const xmlhttp = getXmlHttp();
        xmlhttp.onreadystatechange = function () {
            if(this.readyState == 4 && this.status == 200){
                document.getElementById("usName").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "ajax-server.php?username="+str, true);
        xmlhttp.send();
    }
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
