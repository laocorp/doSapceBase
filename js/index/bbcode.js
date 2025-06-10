var focusedTextarea=false;
function bbcode(textarea,bbcode,e){
        switch (bbcode){
                case 'url':
                case 'img':
                case 'b':
                case 'i':
                case 'u':
                case 'center':
                case 'right':
                case 'code':
                case 'quote':
                        applyBBCode(textarea,bbcode,bbcode,'');
                        break;
                case 'mewetube':
                        applyBBCode(textarea,bbcode,bbcode,'ID');
                        break;
                case 'mewetdb':
                        applyBBCode(textarea,bbcode,bbcode,'item=ID');
                        break;
                case 'spoiler':
                        applyBBCode(textarea,bbcode+'=Titulo',bbcode,'Texto oculto');
                        break;
                case 'color':
                        //getMouseCoords(e);
                        if(e=='barter'){
                            getObj('bbcodeUI-color2').style.left='0px';
                            getObj('bbcodeUI-color2').style.top='27px';
                            getObj('bbcodeUI-color2').style.width='200px';
                            ColorMap(textarea,e);
                        }else{
                        getObj('bbcodeUI-color').style.left='0px';
                        getObj('bbcodeUI-color').style.top='27px';
                        getObj('bbcodeUI-color').style.width='200px';
                        ColorMap(textarea);
                        }
                        break;
                case 'size':
                        //getMouseCoords(e);
                        getObj('bbcodeUI-size').style.left='0px';
                        getObj('bbcodeUI-size').style.top='27px';
                        getObj('bbcodeUI-size').style.width='180px';
                        getObj('bbcodeUI-size').style.display='block';
                        break;
        }
        return false;
}
function applyBBCode(textarea,open,close,content){
        var textarea=getObj(textarea);
        if (textarea!=undefined){
                if (navigator.userAgent.toLowerCase().indexOf("msie")!=-1) {
                        var sel=document.selection.createRange();
                        if (sel.text&&focusedTextarea){sel.text='['+open+']'+sel.text+'[/'+close+']';}
                        else{textarea.value+='['+open+']'+((content!='undefined')?content:'')+'[/'+close+']';}
                }else{wrap(textarea,'['+open+']','[/'+close+']',content);}
                textarea.focus();
        }
}
// Sacado de http://www.massless.org/mozedit/ - Modified by Birckin
function wrap(textarea,open,close,content){
        var selLength=textarea.textLength;
        var selStart=textarea.selectionStart;
        var selEnd=textarea.selectionEnd;
        if (selEnd==1||selEnd==2) selEnd=selLength;
        var s1=(textarea.value).substring(0,selStart);
        var s2=(textarea.value).substring(selStart,selEnd);
        if (s2==''){s2=content;}
        if (s2==undefined){s2='';}
        var s3=(textarea.value).substring(selEnd,selLength);
        textarea.value=s1+open+s2+close+s3;
        textarea.selectionStart=selStart;
        textarea.selectionEnd=selStart;
        textarea.selectionStart=selStart+open.length+s2.length+close.length;
}
//based on TinyMce color map plugin - modified by wooya, adapted by Birckin
function ColorMap(elname,e) {
        var html = '';
        var colors = new Array(
                "#000000","#000033","#000066","#000099","#0000cc","#0000ff","#330000","#330033",
                "#330066","#330099","#3300cc","#3300ff","#660000","#660033","#660066","#660099",
                "#6600cc","#6600ff","#990000","#990033","#990066","#990099","#9900cc","#9900ff",
                "#cc0000","#cc0033","#cc0066","#cc0099","#cc00cc","#cc00ff","#ff0000","#ff0033",
                "#ff0066","#ff0099","#ff00cc","#ff00ff","#003300","#003333","#003366","#003399",
                "#0033cc","#0033ff","#333300","#333333","#333366","#333399","#3333cc","#3333ff",
                "#663300","#663333","#663366","#663399","#6633cc","#6633ff","#993300","#993333",
                "#993366","#993399","#9933cc","#9933ff","#cc3300","#cc3333","#cc3366","#cc3399",
                "#cc33cc","#cc33ff","#ff3300","#ff3333","#ff3366","#ff3399","#ff33cc","#ff33ff",
                "#006600","#006633","#006666","#006699","#0066cc","#0066ff","#336600","#336633",
                "#336666","#336699","#3366cc","#3366ff","#666600","#666633","#666666","#666699",
                "#6666cc","#6666ff","#996600","#996633","#996666","#996699","#9966cc","#9966ff",
                "#cc6600","#cc6633","#cc6666","#cc6699","#cc66cc","#cc66ff","#ff6600","#ff6633",
                "#ff6666","#ff6699","#ff66cc","#ff66ff","#009900","#009933","#009966","#009999",
                "#0099cc","#0099ff","#339900","#339933","#339966","#339999","#3399cc","#3399ff",
                "#669900","#669933","#669966","#669999","#6699cc","#6699ff","#999900","#999933",
                "#999966","#999999","#9999cc","#9999ff","#cc9900","#cc9933","#cc9966","#cc9999",
                "#cc99cc","#cc99ff","#ff9900","#ff9933","#ff9966","#ff9999","#ff99cc","#ff99ff",
                "#00cc00","#00cc33","#00cc66","#00cc99","#00cccc","#00ccff","#33cc00","#33cc33",
                "#33cc66","#33cc99","#33cccc","#33ccff","#66cc00","#66cc33","#66cc66","#66cc99",
                "#66cccc","#66ccff","#99cc00","#99cc33","#99cc66","#99cc99","#99cccc","#99ccff",
                "#cccc00","#cccc33","#cccc66","#cccc99","#cccccc","#ccccff","#ffcc00","#ffcc33",
                "#ffcc66","#ffcc99","#ffcccc","#ffccff","#00ff00","#00ff33","#00ff66","#00ff99",
                "#00ffcc","#00ffff","#33ff00","#33ff33","#33ff66","#33ff99","#33ffcc","#33ffff",
                "#66ff00","#66ff33","#66ff66","#66ff99","#66ffcc","#66ffff","#99ff00","#99ff33",
                "#99ff66","#99ff99","#99ffcc","#99ffff","#ccff00","#ccff33","#ccff66","#ccff99",
                "#ccffcc","#ccffff","#ffff00","#ffff33","#ffff66","#ffff99","#ffffcc","#ffffff"
        );
        html += '<table border="0" cellspacing="1" cellpadding="0" class="tbl" style="padding:0 5px 5px;background-color:#222;"><tr>';
        html += '<tr><td colspan="18" class="right"><a href="#" onclick="';
        if(e=='barter'){
            html += 'getObj(\'bbcodeUI-color2\').innerHTML=\'\';';
        }else{
            html += 'getObj(\'bbcodeUI-color\').innerHTML=\'\';';
        }
        html+='return false;" title="Cerrar">Cerrar</a></td></tr>'
        for (var i=0; i<colors.length; i++) {
                html += '<td style="width:10px;height:10px;cursor:crosshair;background-color:' + colors[i] + '" onclick="addText(\'' + elname + '\', \'[color=' + colors[i] + ']\', \'[/color]\');';
                if(e=='barter'){
                    html += 'getObj(\'bbcodeUI-color2\').innerHTML=\'\';';
                }else{
                    html += 'getObj(\'bbcodeUI-color\').innerHTML=\'\';';
                }
                html+='return false;" onfocus="showMapColor(\'' + colors[i] +  '\', \'' + elname + '\');" onmouseover="showMapColor(\'' + colors[i] + '\', \'' + elname + '\');"></td>';
                if ((i+1) % 18 == 0) html += '</tr><tr>';
        }
        html += '<tr><td colspan="18">'
        + '<table width="100%" border="0" cellspacing="0" cellpadding="0">'
        + '<tr><td id="selectedMapColor' + elname + '" width="50%" height="16">'
        + '</td><td width="50%" class="right">'
        + '<input id="selectedMapColorBox' + elname + '" type="text" size="7" maxlength="7" style="text-align:center;width:80px;" class="input" value="" />'
        + '</td></tr>'
        + '</table>'
        + '</td></tr>'
        + '</table>';
        if(e=='barter'){
            getObj('bbcodeUI-color2').innerHTML=html;
        }else{
        getObj('bbcodeUI-color').innerHTML=html;
}
}
//based on TinyMce color map plugin - modified by wooya
function showMapColor(color, mapId) {
        document.getElementById("selectedMapColor" + mapId).style.backgroundColor = color;
        document.getElementById("selectedMapColorBox" + mapId).value = color;
}
