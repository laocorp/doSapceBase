var mousePosition;
var offset = [0,0];
var div;
var isDown = false;

var elementt = document.getElementById("resizable");
if(elementt)
{
    elementt.addEventListener("click", posCheck);
}

function posCheck(){
    var w = document.getElementById("resizable").offsetWidth + 'px';
    var h = document.getElementById("resizable").offsetHeight + 'px';

    if (w != "0px" && h != "0px"){
        sessionStorage.setItem("ww", w);
        sessionStorage.setItem("hh", h);
    }

    scrollToBottom();

}

div = document.getElementsByClassName("ui-draggable")[0];
div2 = document.getElementsByClassName("chatheader")[0];
var topp = sessionStorage.getItem("topp")==""?null:sessionStorage.getItem("topp");
var left = sessionStorage.getItem("left")==""?null:sessionStorage.getItem("left");
var ww = sessionStorage.getItem("ww")==""?null:sessionStorage.getItem("ww");
var hh = sessionStorage.getItem("hh")==""?null:sessionStorage.getItem("hh");
var ii = sessionStorage.getItem("ii")==""?0:sessionStorage.getItem("ii");
var oo = sessionStorage.getItem("oo")==""?0:sessionStorage.getItem("oo");

if (topp != null && left != null && ww != null && hh != null){
    document.getElementsByClassName("chatWindow")[0].style = "position: relative; top: "+topp+"; left: "+left+"; width: "+ww+"; height: "+hh+"; display: none;";

    var topOption = (parseInt(topp.replace(/px/,""))+110)+"px";
    var leftOption = (parseInt(left.replace(/px/,""))+190)+"px";

    document.getElementById("userMenu").style = "top: "+topOption+"; left: "+leftOption+";";
}

if (ii){ openChat(ii); }
if (oo){ activeTransparency(oo); }

div2.addEventListener('mousedown', function(e) {
    isDown = true;
    offset = [
        div.offsetLeft - e.clientX,
        div.offsetTop - e.clientY
    ];
}, true);

document.addEventListener('mouseup', function() {
    isDown = false;
}, true);

document.addEventListener('mousemove', function(event) {
    if (isDown) {
        event.preventDefault();

        mousePosition = {
    
            x : event.clientX,
            y : event.clientY
    
        };
        div.style.left = (mousePosition.x + offset[0]) + 'px';
        div.style.top  = (mousePosition.y + offset[1]) + 'px';

        sessionStorage.setItem("topp", div.style.top);
        sessionStorage.setItem("left", div.style.left);

        var topOptionn = (parseInt(div.style.top.replace(/px/,""))+110)+"px";
        var leftOptionn = (parseInt(div.style.left.replace(/px/,""))+190)+"px";

        document.getElementById("userMenu").style = "top: "+topOptionn+"; left: "+leftOptionn+";";
    }
}, true);

function openChat(state){

    if (state == 1 || state == 2){
        $('.chatWindow').toggle('slow');
        document.getElementsByClassName("chatWindow")[0].style.display = "inline-flex";
        document.getElementsByClassName('chatButton')[0].setAttribute('onclick','openChat(0)');
        document.getElementsByClassName('chaticon')[0].setAttribute('onclick','openChat(0)');
        sessionStorage.setItem("ii", 2);

        $('.chatButton').toggle('slow');
    }

    if (state == 0){
        $('.chatWindow').toggle('slow');
        document.getElementsByClassName('chatButton')[0].setAttribute('onclick','openChat(1)');
        document.getElementsByClassName('chaticon')[0].setAttribute('onclick','openChat(0)');
        sessionStorage.setItem("ii", -1);

        $('.chatButton').toggle('slow');
    }

    if (state == -1){
        document.getElementsByClassName("chatWindow")[0].style.display = "none";
        document.getElementsByClassName('chatButton')[0].setAttribute('onclick','openChat(1)');
        document.getElementsByClassName('chaticon')[0].setAttribute('onclick','openChat(0)');
    }

}

function openOptions(name){

    if (name == "System"){ return; }

    var NameOptions = document.getElementById("nameOption").innerHTML;
    
    if (NameOptions == name){
        $('#userMenu').toggle('slow');
    } else {
        document.getElementById("userMenu").style.display = "none";
        $('#userMenu').toggle('slow');
        document.getElementById("nameOption").innerHTML = name;
    }

}

function whisperUser(){
    document.getElementById("userMenu").style.display = "none";
    document.querySelector('input[id="messageInput"]').value = '/w '+document.getElementById("nameOption").innerHTML+' ';
    document.getElementById('messageInput').focus();
}

function activeTransparency(state){

    if (state == 1){

        document.getElementsByClassName('chatTransparencySetting')[0].setAttribute('onclick','activeTransparency(0)');
        document.getElementsByClassName('chatheader')[0].setAttribute('onmouseover','transparencyTemp(0)');
        document.getElementsByClassName('chatheader')[0].setAttribute('onmouseout','transparencyTemp(1)');
        sessionStorage.setItem("oo", 1);

        document.getElementsByClassName("chaticon")[0].classList.add("chaticonTransparency");
        document.getElementsByClassName("chattitle")[0].classList.add("chattitleTransparency");
        document.getElementsByClassName("chatTransparencySetting")[0].classList.add("chatTransparencySettingTransparency");
        document.getElementsByClassName("chatNotification")[0].classList.add("chatNotificationTransparency");
        document.getElementsByClassName("chatcontent")[0].classList.add("chatcontentTransparency");
        document.getElementsByClassName("chattabs")[0].classList.add("chattabsTransparency");
        document.getElementsByClassName("userInput")[0].classList.add("userInputTransparency");

    } else {

        document.getElementsByClassName('chatTransparencySetting')[0].setAttribute('onclick','activeTransparency(1)');
        document.getElementsByClassName('chatheader')[0].removeAttribute('onmouseover');
        document.getElementsByClassName('chatheader')[0].removeAttribute('onmouseout');
        sessionStorage.setItem("oo", 0);

        document.getElementsByClassName("chaticon")[0].classList.remove("chaticonTransparency");
        document.getElementsByClassName("chattitle")[0].classList.remove("chattitleTransparency");
        document.getElementsByClassName("chatTransparencySetting")[0].classList.remove("chatTransparencySettingTransparency");
        document.getElementsByClassName("chatNotification")[0].classList.remove("chatNotificationTransparency");
        document.getElementsByClassName("chatcontent")[0].classList.remove("chatcontentTransparency");
        document.getElementsByClassName("chattabs")[0].classList.remove("chattabsTransparency");
        document.getElementsByClassName("userInput")[0].classList.remove("userInputTransparency");

    }

}

function transparencyTemp(state){

    if (state == 1){

        document.getElementsByClassName("chaticon")[0].classList.add("chaticonTransparency");
        document.getElementsByClassName("chattitle")[0].classList.add("chattitleTransparency");
        document.getElementsByClassName("chatTransparencySetting")[0].classList.add("chatTransparencySettingTransparency");
        document.getElementsByClassName("chatNotification")[0].classList.add("chatNotificationTransparency");
        document.getElementsByClassName("chatcontent")[0].classList.add("chatcontentTransparency");
        document.getElementsByClassName("chattabs")[0].classList.add("chattabsTransparency");
        document.getElementsByClassName("userInput")[0].classList.add("userInputTransparency");

    } else {

        document.getElementsByClassName("chaticon")[0].classList.remove("chaticonTransparency");
        document.getElementsByClassName("chattitle")[0].classList.remove("chattitleTransparency");
        document.getElementsByClassName("chatTransparencySetting")[0].classList.remove("chatTransparencySettingTransparency");
        document.getElementsByClassName("chatNotification")[0].classList.remove("chatNotificationTransparency");
        document.getElementsByClassName("chatcontent")[0].classList.remove("chatcontentTransparency");
        document.getElementsByClassName("chattabs")[0].classList.remove("chattabsTransparency");
        document.getElementsByClassName("userInput")[0].classList.remove("userInputTransparency");

    }

}