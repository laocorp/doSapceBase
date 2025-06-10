function getObj(id){return document.getElementById(id);}
function toggleId(id){
        var obj=getObj(id);
        obj.style.display=(obj.style.display=='none')?'block':'none';
        return false;
}
function createAjax(){
        var xmlhttp=false;
        try { xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); } // No IE
        catch(e) { // IE
                try { xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); }
                catch(e) { xmlhttp=false; }
        }
        if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); }
        return xmlhttp;
}
var mousex=0;
var mousey=0;
function getMouseCoords(e){
        if (!e)e=window.event;
        if (e){
                if (e.pageX||e.pageY){mousex=e.pageX;mousey=e.pageY;}
                else if (e.clientX||e.clientY){
                        mousex=e.clientX+document.documentElement.scrollLeft;
                        mousey=e.clientY+document.documentElement.scrollTop;
                }
        }
}
function getPageSize(){
        var xScroll, yScroll;

        if (window.innerHeight && window.scrollMaxY){
                xScroll=window.innerWidth+window.scrollMaxX;
                yScroll=window.innerHeight+window.scrollMaxY;
        }else if(document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
                xScroll=document.body.scrollWidth;
                yScroll=document.body.scrollHeight;
        }else{ // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
                xScroll=document.body.offsetWidth;
                yScroll=document.body.offsetHeight;
        }
        var windowWidth, windowHeight;
        if (self.innerHeight){ // all except Explorer
                if(document.documentElement.clientWidth){windowWidth=document.documentElement.clientWidth;}
                else{windowWidth=self.innerWidth;}
                windowHeight=self.innerHeight;
        }else if (document.documentElement && document.documentElement.clientHeight){ // Explorer 6 Strict Mode
                windowWidth=document.documentElement.clientWidth;
                windowHeight=document.documentElement.clientHeight;
        }else if (document.body){ // other Explorers
                windowWidth=document.body.clientWidth;
                windowHeight=document.body.clientHeight;
        }
        // for small pages with total height less then height of the viewport
        if(yScroll<windowHeight){pageHeight=windowHeight;}
        else{pageHeight=yScroll;}
        // for small pages with total width less then width of the viewport
        if(xScroll<windowWidth){pageWidth=xScroll;}
        else{pageWidth=windowWidth;}
        return [pageWidth,pageHeight];
}
function get_html_translation_table (table, quote_style) {
    // Returns the internal translation table used by htmlspecialchars and htmlentities
    //
    // version: 1107.2516
    // discuss at: http://phpjs.org/functions/get_html_translation_table
    // +   original by: Philip Peterson
    // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: noname
    // +   bugfixed by: Alex
    // +   bugfixed by: Marco
    // +   bugfixed by: madipta
    // +   improved by: KELAN
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Frank Forte
    // +   bugfixed by: T.Wild
    // +      input by: Ratheous
    // %          note: It has been decided that we're not going to add global
    // %          note: dependencies to php.js, meaning the constants are not
    // %          note: real constants, but strings instead. Integers are also supported if someone
    // %          note: chooses to create the constants themselves.
    // *     example 1: get_html_translation_table('HTML_SPECIALCHARS');
    // *     returns 1: {'"': '&quot;', '&': '&amp;', '<': '&lt;', '>': '&gt;'}
    var entities = {},
        hash_map = {},
        decimal = 0,
        symbol = '';
    var constMappingTable = {},
        constMappingQuoteStyle = {};
    var useTable = {},
    useQuoteStyle = {};

    // Translate arguments
    constMappingTable[0] = 'HTML_SPECIALCHARS';
    constMappingTable[1] = 'HTML_ENTITIES';
    constMappingQuoteStyle[0] = 'ENT_NOQUOTES';
    constMappingQuoteStyle[2] = 'ENT_COMPAT';
    constMappingQuoteStyle[3] = 'ENT_QUOTES';

    useTable = !isNaN(table) ? constMappingTable[table] : table ? table.toUpperCase() : 'HTML_SPECIALCHARS';    useQuoteStyle = !isNaN(quote_style) ? constMappingQuoteStyle[quote_style] : quote_style ? quote_style.toUpperCase() : 'ENT_COMPAT';

    if (useTable !== 'HTML_SPECIALCHARS' && useTable !== 'HTML_ENTITIES') {
        throw new Error("Table: " + useTable + ' not supported');
        // return false;
    }

    entities['38'] = '&amp;';
    if (useTable === 'HTML_ENTITIES') {
        entities['160'] = '&nbsp;';
        entities['161'] = '&iexcl;';
        entities['162'] = '&cent;';
        entities['163'] = '&pound;';
        entities['164'] = '&curren;';
        entities['165'] = '&yen;';
        entities['166'] = '&brvbar;';
        entities['167'] = '&sect;';
        entities['168'] = '&uml;';
        entities['169'] = '&copy;';
        entities['170'] = '&ordf;';
        entities['171'] = '&laquo;';
        entities['172'] = '&not;';
        entities['173'] = '&shy;';
        entities['174'] = '&reg;';
        entities['175'] = '&macr;';
        entities['176'] = '&deg;';
        entities['177'] = '&plusmn;';
        entities['178'] = '&sup2;';
        entities['179'] = '&sup3;';
        entities['180'] = '&acute;';
        entities['181'] = '&micro;';
        entities['182'] = '&para;';
        entities['183'] = '&middot;';
        entities['184'] = '&cedil;';
        entities['185'] = '&sup1;';
        entities['186'] = '&ordm;';
        entities['187'] = '&raquo;';
        entities['188'] = '&frac14;';
        entities['189'] = '&frac12;';
        entities['190'] = '&frac34;';
        entities['191'] = '&iquest;';
        entities['192'] = '&Agrave;';
        entities['193'] = '&Aacute;';
        entities['194'] = '&Acirc;';
        entities['195'] = '&Atilde;';
        entities['196'] = '&Auml;';
        entities['197'] = '&Aring;';
        entities['198'] = '&AElig;';
        entities['199'] = '&Ccedil;';
        entities['200'] = '&Egrave;';
        entities['201'] = '&Eacute;';
        entities['202'] = '&Ecirc;';
        entities['203'] = '&Euml;';
        entities['204'] = '&Igrave;';
        entities['205'] = '&Iacute;';
        entities['206'] = '&Icirc;';
        entities['207'] = '&Iuml;';
        entities['208'] = '&ETH;';
        entities['209'] = '&Ntilde;';
        entities['210'] = '&Ograve;';
        entities['211'] = '&Oacute;';
        entities['212'] = '&Ocirc;';
        entities['213'] = '&Otilde;';
        entities['214'] = '&Ouml;';
        entities['215'] = '&times;';
        entities['216'] = '&Oslash;';
        entities['217'] = '&Ugrave;';
        entities['218'] = '&Uacute;';
        entities['219'] = '&Ucirc;';
        entities['220'] = '&Uuml;';
        entities['221'] = '&Yacute;';
        entities['222'] = '&THORN;';
        entities['223'] = '&szlig;';
        entities['224'] = '&agrave;';
        entities['225'] = '&aacute;';
        entities['226'] = '&acirc;';
        entities['227'] = '&atilde;';
        entities['228'] = '&auml;';
        entities['229'] = '&aring;';
        entities['230'] = '&aelig;';
        entities['231'] = '&ccedil;';
        entities['232'] = '&egrave;';
        entities['233'] = '&eacute;';
        entities['234'] = '&ecirc;';
        entities['235'] = '&euml;';
        entities['236'] = '&igrave;';
        entities['237'] = '&iacute;';
        entities['238'] = '&icirc;';
        entities['239'] = '&iuml;';
        entities['240'] = '&eth;';
        entities['241'] = '&ntilde;';
        entities['242'] = '&ograve;';
        entities['243'] = '&oacute;';
        entities['244'] = '&ocirc;';
        entities['245'] = '&otilde;';
        entities['246'] = '&ouml;';
        entities['247'] = '&divide;';
        entities['248'] = '&oslash;';
        entities['249'] = '&ugrave;';
        entities['250'] = '&uacute;';
        entities['251'] = '&ucirc;';
        entities['252'] = '&uuml;';
        entities['253'] = '&yacute;';
        entities['254'] = '&thorn;';
        entities['255'] = '&yuml;';    }

    if (useQuoteStyle !== 'ENT_NOQUOTES') {
        entities['34'] = '&quot;';
    }    if (useQuoteStyle === 'ENT_QUOTES') {
        entities['39'] = '&#39;';
    }
    entities['60'] = '&lt;';
    entities['62'] = '&gt;';

    // ascii decimals to real symbols
    for (decimal in entities) {
        symbol = String.fromCharCode(decimal);
        hash_map[symbol] = entities[decimal];
    }

    return hash_map;
}
function html_entity_decode (string, quote_style) {
    // Convert all HTML entities to their applicable characters
    //
    // version: 1107.2516
    // discuss at: http://phpjs.org/functions/html_entity_decode
    // +   original by: john (http://www.jd-tech.net)
    // +      input by: ger
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Onno Marsman
    // +   improved by: marc andreu
    // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Ratheous
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Nick Kolosov (http://sammy.ru)
    // +   bugfixed by: Fox
    // -    depends on: get_html_translation_table
    // *     example 1: html_entity_decode('Kevin &amp; van Zonneveld');
    // *     returns 1: 'Kevin & van Zonneveld'
    // *     example 2: html_entity_decode('&amp;lt;');
    // *     returns 2: '&lt;'
    var hash_map = {},
        symbol = '',
        tmp_str = '',
        entity = '';    tmp_str = string.toString();

    if (false === (hash_map = this.get_html_translation_table('HTML_ENTITIES', quote_style))) {
        return false;
    }
    // fix &amp; problem
    // http://phpjs.org/functions/get_html_translation_table:416#comment_97660
    delete(hash_map['&']);
    hash_map['&'] = '&amp;';
    for (symbol in hash_map) {
        entity = hash_map[symbol];
        tmp_str = tmp_str.split(entity).join(symbol);
    }
    tmp_str = tmp_str.split('&#039;').join("'");

    return tmp_str;
}
Array.prototype.add=function(s){found=false;for(var i=0;i<this.length&&!found;i++){if(s==this[i])found=true;}if(!found)this.push(s);};
Array.prototype.remove=function(s){for(var i=0;i<this.length;i++){if(s==this[i])this.splice(i,1);}};
Array.prototype.find=function(s){found=false;for(var i=0;i<this.length&&found===false;i++){if(s==this[i])found=i;}return found;};
Array.prototype.inArray=function(s){return this.find(s)!==false;};
function imposeMaxLength(Event,Object,MaxLen){return (Object.value.length<=MaxLen)||(Event.keyCode==8||Event.keyCode==46||(Event.keyCode>=35&&Event.keyCode<=40))}
function resizeBBCodeImages(){
        $('.bbcode-img img').each(function(i){
            $(this).bind('load',function(){
                var maxwidth=480;
                $(this).removeAttr('width');
                if (this.width>maxwidth){
                    this.height*=(maxwidth/this.width);
                    this.width=maxwidth;
                    $(this.parentNode).append($('<a href="'+this.src+'" target="_blank" />').prepend($(this))).css('width',this.width).css('height',this.height);
                }else{$(this.parentNode).css('width',this.width).css('height',this.height);}
            });
        });
}
function addText(elname, strFore, strAft, formname) {
   formname= $('#'+elname+'').parents('form'); 
   if (elname == undefined) elname = 'message';
   element = document.forms[formname.attr('name')].elements[elname];
   element.focus();
   // for IE 
   if (document.selection) {
	   var oRange = document.selection.createRange();
	   var numLen = oRange.text.length;
	   oRange.text = strFore + oRange.text + strAft;
	   return false;
   // for FF and Opera
   } else if (element.setSelectionRange) {
      var selStart = element.selectionStart, selEnd = element.selectionEnd;
			var oldScrollTop = element.scrollTop;
      element.value = element.value.substring(0, selStart) + strFore + element.value.substring(selStart, selEnd) + strAft + element.value.substring(selEnd);
      element.setSelectionRange(selStart + strFore.length, selEnd + strFore.length);
			element.scrollTop = oldScrollTop;      
      element.focus();
   } else {
			var oldScrollTop = element.scrollTop;
      element.value += strFore + strAft;
			element.scrollTop = oldScrollTop;      
      element.focus();
	}
}
$().ready(function(){resizeBBCodeImages();});
