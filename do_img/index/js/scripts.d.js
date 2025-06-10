$(window).on('DOMContentLoaded', function() {
  "use strict";
  $('.preloader-anim').addClass('start');
  setTimeout(function(){  
  $('.scryde-big').removeClass('preload-logo');  
   },200);
     $('.preloader').delay(200).fadeOut('slow');
  setTimeout(function(){
    animateElements();
   },200);
  setTimeout(function(){
  $('.preloader-anim').fadeOut();
  }, 360);
});

function animateElements() {
    $('.scryde-big').removeClass('away');
    setTimeout(function(){  
        $('.scryde-girl').removeClass('away');
    }, 200);
    setTimeout(function(){    
        $('nav').removeClass('away');
        $('.slogan').removeClass('away');
    }, 600);
}

$(document).ready(function () {
var deviceWidth = $(window).width();
var maxWidth = 640;
    if (deviceWidth < maxWidth) { initscale(); }

Rotator();
OnlineTimer();
setInterval(OnlineTimer, 60000);
setInterval(OnlineUpdater, 6000);

$(window).scroll(function() 
{
     var thirdWindow = $('.first-window').height() + $('.second-window').height() - 20;
      if ($(window).scrollTop() >= thirdWindow )
        { $('header').stop().addClass('fdown');         
        $('header .logo').stop().addClass('ffull'); 
        }   
     else { $('header').stop().removeClass('fdown');  
      $('header .logo').stop().removeClass('ffull'); 
     }   

if($(window).height() <= 900)
    {      
     if ($(window).scrollTop() >= 150 )
        { $('.scryde-big').stop().addClass('away'); 
        }   
     else { $('.scryde-big').stop().removeClass('away'); 
     }   

     if ($(window).scrollTop() >= 250 ) {
        $('.scryde-girl').stop().addClass('away'); 
        }   
     else { 
     $('.scryde-girl').stop().removeClass('away'); 
     }   
     
     if ($(window).scrollTop() >= 630 )
        { $('header').stop().addClass('down'); 
        $('header .logo').stop().addClass('full'); 
        $('.second-window').stop().addClass('down'); 
        }   
     else { $('header').stop().removeClass('down');  
            $('header .logo').stop().removeClass('full'); 
            $('.second-window').stop().removeClass('down');
            }   
}  

var ThirdWindowTop = $('.first-window').height();
if ($(window).scrollTop() >= ThirdWindowTop )
{ 
$('.statinfo.onl').removeClass('anim'); 
setTimeout(function(){ 
$('.statinfo.new').removeClass('anim'); 
}, 200);
setTimeout(function(){ 
$('.statinfo.all').removeClass('anim'); 
}, 400);

}

if($(window).height() >= 901)
    {      
     if ($(window).scrollTop() >= 200 )
        { $('.scryde-big').stop().addClass('away'); 
        }   
     else { $('.scryde-big').stop().removeClass('away'); 
     }   

     if ($(window).scrollTop() >= 300 ) {
        $('.scryde-girl').stop().addClass('away'); 
        }   
     else { 
     $('.scryde-girl').stop().removeClass('away'); 
     }   
     
     if ($(window).scrollTop() >= 830 )
        { $('header').stop().addClass('down'); 
        $('header .logo').stop().addClass('full');
        $('.second-window').stop().addClass('down'); 
        }   
     else { $('header').stop().removeClass('down');  
            $('header .logo').stop().removeClass('full'); 
            $('.second-window').stop().removeClass('down'); 
            }   
    }  
    
if($(window).width() <= 1279)
    {           
     if ($(window).scrollTop() >= 680 )
        { $('header').stop().addClass('down'); 
        $('header .logo').stop().addClass('full');
        $('.second-window').stop().addClass('down'); 
        }   
     else { $('header').stop().removeClass('down');  
            $('header .logo').stop().removeClass('full'); 
            $('.second-window').stop().removeClass('down'); 
            }   
    }  
});

    $(document).on('click', '.buttons a, a.donate, a.files, a.register', function(){
        var thisForm = $(this).attr('class');
        showForms(thisForm);
    });
    $(document).on('click', '.forms-close', function(){
        closeForms();
        $('nav a').removeClass('active');
        $('nav a.current').addClass('active');    
    });
    $(document).on('click', '.menu-mobile.open-menu a', function(){
        $('.nav-mobile').addClass('show');
        $('.menu-mobile.open-menu').removeClass('open-menu').addClass('close-menu');        
    });
    $(document).on('click', '.menu-mobile.close-menu a', function(){
        $('.nav-mobile').removeClass('show');
        $('.menu-mobile.close-menu').removeClass('close-menu').addClass('open-menu');        
    }); 
    $(document).on('click', 'a.servers-link', function(){
        serversLink();
    });
    $(document).on('mouseenter', '.server, .current-server, .online-servers ul li', function(){
        var thisServId = $(this).attr('data-target');
        chartSelectOne(thisServId);
    }); 
    $(document).on('mouseleave', '.server, .online-servers ul li', function(){
        chartSelectOneClose();
    }); 
    $(document).on('click', 'a.serv-see-more', function(){
        var thisServThis = $(this); 
        ServSeeMore(thisServThis);
    }); 
    $(document).on('click', 'a.close-current-server', function(e){
        e.preventDefault();
        $('.close-current-server').hide(); 
        $('a.serv-see-more').show(); 
        $('.all-servers .server').removeClass('not-active').removeClass('active');
        $('.server-info .current-server').slideUp();
        chartSelectOneClose();
    }); 
    $(document).on('click', ".carousel-button-right",function(){ 
	    var carusel = $(this).parents('.carousel');
	    right_carusel(carusel);
	    return false;
    });
    $(document).on('click',".carousel-button-left",function(){ 
	    var carusel = $(this).parents('.carousel');
	    left_carusel(carusel);
	    return false;
    });
        
    var urlString =location.toString();
    var urlthisForm = urlString.split('#')[1];
    if (urlthisForm == "files" || urlthisForm == "register" || urlthisForm == "donate") {
        var thisForm = urlthisForm;
        showForms(thisForm);
    }
    if (urlthisForm == "about") {
        serversLink();
    }    

$(document).on('keypress keyup', '.reg-form input[name="l2account"]', function(){
    if ($(this).val().length > 3) {
        if (/^[0-9a-zA-Z]+$/i.test($(this).val())) {
            $('.form-item-login .error').slideUp(); 
            $('.step-login').removeClass('err');
        } else {
            $('.form-item-login .error').slideDown();
            $('.step-login').addClass('err');
        }
    }
    else {
            $('.form-item-login .error').slideDown();
            $('.step-login').addClass('err');
    }
});
$(document).on('keypress keyup', '.reg-form input[name="l2password1"]', function(){
    if ($(this).val().length > 3) {
        if (/^[0-9a-zA-Z]+$/i.test($(this).val())) {
            $('.form-item-password .error').slideUp(); 
            $('.step-password').removeClass('err');
        } else {
            $('.form-item-password .error').slideDown();
            $('.step-password').addClass('err');
        }
    }
    else {
            $('.form-item-password .error').slideDown();
            $('.step-password').addClass('err');
    }
});
$(document).on('keypress keyup', '.reg-form input[name="l2email"]', function(){
    if ($(this).val().length > 0) {
       if (/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})$/i.test($(this).val())) {
            $('.form-item-mail .error').slideUp(); 
            $('.step-mail').removeClass('err');
        } else {
            $('.form-item-mail .error').slideDown(); 
            $('.step-mail').addClass('err');
        }
    }
    else {
            $('.form-item-mail .error').slideDown(); 
            $('.step-mail').addClass('err');
    }
});
$(document).on('click', '.step-prefix, .form-item-prefix', function(){
    if( $('.form-item-prefix .prefx').css('display') == "none" ) {
            $('.form-item-prefix .prefx').slideDown(); 
            $('.form-item-prefix').addClass('vis');
    }
    else { $('.form-item-prefix .prefx').slideUp(); 
        $('.form-item-prefix').removeClass('vis');
     }
});
$(document).on('click', '.showhide', function(){
    if ($('.step-password').attr('type') == "password") {
        $('.step-password').removeAttr('type').attr('type','text');
        $('.showhide').addClass('hide');
    }
    else { $('.step-password').removeAttr('type').attr('type','password'); 
            $('.showhide').removeClass('hide');
    }
});

$(document).on('mouseenter', '.statinfo', function(){
$('.news').removeClass('onl').removeClass('new').removeClass('all'); 
var thisBg = $(this).attr('class').substr(-3); 
$('.news').addClass(thisBg); 
});
$(document).on('mouseleave', '.statinfo', function(){
$('.news').removeClass('onl').removeClass('new').removeClass('all'); 
});

});

function showForms(thisForm){
        $('.files-form').addClass('away');  
        $('.register-form').addClass('away'); 
        $('.donate-form').addClass('away');   
        $('.scryde-girl').addClass('forms');
        $('.slogan').addClass('forms');
        $('.scryde-big').addClass('forms');       
        $('.forms').removeClass('away');  
        $('.'+thisForm+'-form').removeClass('away');  
        $("html,body").animate({scrollTop:0 });
        setTimeout(function(){        
            $('nav.right').addClass('forms');
        }, 300);
if (thisForm == "donate") {
            $('nav a').removeClass('active');
            $('nav a.donate').addClass('active');
            $('.nav-mobile').removeClass('show');
            $('.menu-mobile.close-menu').removeClass('close-menu').addClass('open-menu');   
        }
}
function closeForms(){
        $('.reg-form').trigger( 'reset' );
        $('.donates-form').trigger( 'reset' );
        $('nav.right').removeClass('forms').removeClass('away');
        $('.scryde-girl').removeClass('forms');
        $('.slogan').removeClass('forms');
        $('.scryde-big').removeClass('forms');       
        $('.forms').addClass('away');  
    setTimeout(function(){   
        $('.files-form').addClass('away');  
        $('.register-form').addClass('away'); 
        $('.donate-form').addClass('away');   
    }, 300);      
        $("html,body").animate({scrollTop:0 });    
}
function serversLink() {
         var secondWindowPosDet = $('.second-window').css('top');
        var secondWindowPosF = parseInt(secondWindowPosDet.replace(/\D+/g,""));
        if ($(window).width() <= 959 ) {
            var secondWindowPos = secondWindowPosF + 50;
        }
        else {
            var secondWindowPos = secondWindowPosF-50;
        }
        $('html, body').stop().animate({scrollTop : secondWindowPos }, 1000); 
        $('.nav-mobile').removeClass('show');
        $('.menu-mobile.close-menu').removeClass('close-menu').addClass('open-menu');  
}
function ServSeeMore(thisServThis) {
        $('.server-info .current-server').hide(); 
        $('.close-current-server').hide(); 
        $('a.serv-see-more').show(); 
        $(thisServThis).hide();
        $(thisServThis).next().show();
        $('.all-servers .server').addClass('not-active').removeClass('active');
        $(thisServThis).parent('.server').removeClass('not-active').addClass('active');
        var whatServHref = $(thisServThis).attr('href');
        var whatServ = whatServHref.slice(1);
        $('.server-info .open-'+whatServ).slideDown();      
}
function Rotator(start_from){
    var phrases = h1slogan;
    var total = phrases.length;
    var interval = 3000;
    var fontSizeX = $('.slogan h1').css('line-height');
    if(void 0 === start_from){
        start_from = 0;
    }
    $(".slogan h1").text(phrases[start_from]).animate({"font-size" : fontSizeX}, 500, function(){
                if(start_from >= (total-1)){
                    setTimeout(function(){
                        $(".slogan h1").animate({"font-size":"0px"}, 500, function(){
                            Rotator();
                        });
                    }, interval);
                }else{
                    start_from++;
                    setTimeout(function(){
                        $(".slogan h1").animate({"font-size":"0px"}, 500,function(){
                            Rotator(start_from);
                        });
                    }, interval);         
                }               
    })
}
function left_carusel(carusel){
   var block_width = $(carusel).find('.carousel-block').outerWidth();
   $(carusel).find(".carousel-items .carousel-block").eq(-1).clone().prependTo($(carusel).find(".carousel-items")); 
   $(carusel).find(".carousel-items").css({"left":"-"+block_width+"px"});
   $(carusel).find(".carousel-items .carousel-block").eq(-1).remove();    
   $(carusel).find(".carousel-items").animate({left: "0px"}, 500); 
   
}
function right_carusel(carusel){
   var block_width = $(carusel).find('.carousel-block').outerWidth();
   $(carusel).find(".carousel-items").animate({left: "-"+ block_width +"px"}, 500, function(){
	  $(carusel).find(".carousel-items .carousel-block").eq(0).clone().appendTo($(carusel).find(".carousel-items")); 
      $(carusel).find(".carousel-items .carousel-block").eq(0).remove(); 
      $(carusel).find(".carousel-items").css({"left":"0px"}); 
   }); 
}


function initscale() {
        var all_meta = document.getElementsByTagName("meta")
        for (var i=0; i<all_meta.length; i++) {
            if (all_meta[i].name.toLowerCase() != "viewport") continue;
            all_meta[i].content = "width=device-width, initial-scale=0.5, maximum-scale=0.5";
        }
    }

function chartSelectOne(thisServId) {
myChart.data.datasets[0].backgroundColor = "rgba(34,165,207,0.1)";
myChart.data.datasets[1].backgroundColor = "rgba(34,165,207,0.1)";
myChart.data.datasets[2].backgroundColor = "rgba(34,165,207,0.1)";
myChart.data.datasets[3].backgroundColor = "rgba(34,165,207,0.1)";
myChart.data.datasets[4].backgroundColor = "rgba(34,165,207,0.1)";
myChart.data.datasets[5].backgroundColor = "rgba(34,165,207,0.1)";
myChart.data.datasets[thisServId].backgroundColor = "rgba(34,165,207,0.7)";
myChart.update();
}
function chartSelectOneClose() {
myChart.data.datasets[0].backgroundColor = "rgba(34,165,207,0.3)";
myChart.data.datasets[1].backgroundColor = "rgba(34,165,207,0.3)";
myChart.data.datasets[2].backgroundColor = "rgba(34,165,207,0.3)";
myChart.data.datasets[3].backgroundColor = "rgba(34,165,207,0.3)";
myChart.data.datasets[4].backgroundColor = "rgba(34,165,207,0.3)";
myChart.data.datasets[5].backgroundColor = "rgba(34,165,207,0.3)";
myChart.update();
}

function chartRefreshData () {

if (serv1Data[10] == 0) { myChart.data.datasets[0].data[0] = 0 }
else { myChart.data.datasets[0].data[10] = serv1Data[10]+ri(0, 500); 
myChart.data.datasets[0].data[9] = serv1Data[9]+ri(0, 400);
myChart.data.datasets[0].data[8] = serv1Data[8]+ri(0, 300);
myChart.data.datasets[0].data[7] = serv1Data[7]+ri(0, 200);
myChart.data.datasets[0].data[6] = serv1Data[6]+ri(0, 100);
myChart.data.datasets[0].data[5] = serv1Data[5]+ri(0, 50);
}
if (serv2Data[10] == 0) { myChart.data.datasets[1].data[0] = 0 }
else { myChart.data.datasets[1].data[10] = serv2Data[10]+ri(0, 500); 
myChart.data.datasets[1].data[9] = serv2Data[9]+ri(0, 400);
myChart.data.datasets[1].data[8] = serv2Data[8]+ri(0, 300);
myChart.data.datasets[1].data[7] = serv2Data[7]+ri(0, 200);
myChart.data.datasets[1].data[6] = serv2Data[6]+ri(0, 100);
myChart.data.datasets[1].data[5] = serv2Data[5]+ri(0, 50);
}
if (serv3Data[10] == 0) { myChart.data.datasets[2].data[0] = 0 }
else { myChart.data.datasets[2].data[10] = serv3Data[10]+ri(0, 500); 
myChart.data.datasets[2].data[9] = serv3Data[9]+ri(0, 400);
myChart.data.datasets[2].data[8] = serv3Data[8]+ri(0, 300);
myChart.data.datasets[2].data[7] = serv3Data[7]+ri(0, 200);
myChart.data.datasets[2].data[6] = serv3Data[6]+ri(0, 100);
myChart.data.datasets[2].data[5] = serv3Data[5]+ri(0, 50);
}
if (serv4Data[10] == 0) { myChart.data.datasets[3].data[0] = 0 }
else { myChart.data.datasets[3].data[10] = serv4Data[10]+ri(0, 500); 
myChart.data.datasets[3].data[9] = serv4Data[9]+ri(0, 400);
myChart.data.datasets[3].data[8] = serv4Data[8]+ri(0, 300);
myChart.data.datasets[3].data[7] = serv4Data[7]+ri(0, 200);
myChart.data.datasets[3].data[6] = serv4Data[6]+ri(0, 100);
myChart.data.datasets[3].data[5] = serv4Data[5]+ri(0, 50);
}
if (serv5Data[10] == 0) { myChart.data.datasets[4].data[0] = 0 }
else { myChart.data.datasets[4].data[10] = serv5Data[10]+ri(0, 500); 
myChart.data.datasets[4].data[9] = serv5Data[9]+ri(0, 400);
myChart.data.datasets[4].data[8] = serv5Data[8]+ri(0, 300);
myChart.data.datasets[4].data[7] = serv5Data[7]+ri(0, 200);
myChart.data.datasets[4].data[6] = serv5Data[6]+ri(0, 100);
myChart.data.datasets[4].data[5] = serv5Data[5]+ri(0, 50);
}
if (serv6Data[10] == 0) { myChart.data.datasets[5].data[0] = 0 }
else { myChart.data.datasets[5].data[10] = serv6Data[10]+ri(0, 500); 
myChart.data.datasets[5].data[9] = serv6Data[9]+ri(0, 400);
myChart.data.datasets[5].data[8] = serv6Data[8]+ri(0, 300);
myChart.data.datasets[5].data[7] = serv6Data[7]+ri(0, 200);
myChart.data.datasets[5].data[6] = serv6Data[6]+ri(0, 100);
myChart.data.datasets[5].data[5] = serv6Data[5]+ri(0, 50);
}

myChart.update();
}

function OnlineUpdater() {  
        var serv1Q = serv1Data[10]+ri(0, 10);
        var serv2Q = serv2Data[10]+ri(0, 10);
	if(serv3Data[10] > 20)
	{
        var serv3Q = serv3Data[10]+ri(0, 10);
	}
	else
	{
        var serv3Q = serv3Data[10];
	}

        var serv4Q = serv4Data[10]+ri(0, 10);
        var serv5Q = serv5Data[10]+ri(0, 10);
        var serv6Q = serv6Data[10]+ri(0, 10);
       
        $('.online-server-1 i').remove();
        $('<i>'+serv1Q+'</i>').appendTo('.online-server-1');   
        $('.online-server-2 i').remove();
        $('<i>'+serv2Q+'</i>').appendTo('.online-server-2');  
        $('.online-server-3 i').remove();
        $('<i>'+serv3Q+'</i>').appendTo('.online-server-3');     
        $('.online-server-4 i').remove();
        $('<i>'+serv4Q+'</i>').appendTo('.online-server-4');  
        $('.online-server-5 i').remove();
        $('<i>'+serv5Q+'</i>').appendTo('.online-server-5'); 
        $('.online-server-6 i').remove();
        $('<i>'+serv6Q+'</i>').appendTo('.online-server-6'); 
        $('.statinfo.onl h2').html(serv1Q+serv2Q+serv5Q+serv3Q); 
}


function OnlineTimer() {
    $(".time-before").remove();
    $(".time-now i").remove();
    
    var date = new Date();
    if (date.getMinutes() < 10) { var TimeNow = date.getHours()+':0'+date.getMinutes(); }
    else { var TimeNow = date.getHours()+':'+date.getMinutes(); }
    $('<i>'+TimeNow+'</i>').prependTo('.time-now');
    
    var tb;
    for (tb = 0; tb < 9; tb++) {
        var TimeBefore = date.getHours()-tb;
        if(TimeBefore < 0) { var TimeBefore = TimeBefore+24;}
    $('<li class="time-before">'+TimeBefore+':00</li>').prependTo('.chart-time ul');
    }
}

function ri(min, max) {
    var rand = min - 0.5 + Math.random() * (max - min + 1)
    rand = Math.round(rand);
    return rand;
  }

function downloadWindow() {
    $('.download-overlay').fadeIn(200);
}
function downloadClose() {
    $('.download-overlay').fadeOut(200);
}