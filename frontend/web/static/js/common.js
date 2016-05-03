$(function(){
	if($('#c').length > 0){
		loadBox();
		getChapter();
	}
	$('.auhe').height($(window).height()*0.34);
});

function getChapter(){
	$.ajax({
		url:__getChapter,
		async:false,
		dataType:'json',
		timeout:30000,
		type:'GET',
		error:function(XMLHttpRequest, textStatus, errorThrown){
			loadBox();
			if(textStatus == 'timeout'){
				if(errorThrown){
					console.log(errorThrown)
				}
				alertMsg('网络繁忙，请稍后再试');
				return false;
			}else{
				if(textStatus){
					console.log(textStatus)
				}else{
					console.log(errorThrown)
				}
				alertMsg('请稍后再试，若尝试多次后还不可以，请联系管理员');
				return false;
			}
		},
		success:function(result){
			loadBox();
			if(result.code < 0){
				alertMsg(result.msg);
				return false;
			}
			$('.chapter').html(result.chapter);
			$(window).scrollTop(0);
		}
	});
}

function getcookie(name) {
	var cookie_start = document.cookie.indexOf(name);
	var cookie_end = document.cookie.indexOf(";", cookie_start);
	return cookie_start == -1 ? '' : unescape(document.cookie.substring(cookie_start + name.length + 1, (cookie_end > cookie_start ? cookie_end : document.cookie.length)));
}
 
function setcookie(cookieName, cookieValue, seconds, path, domain, secure) {
	var expires = new Date();
	expires.setTime(expires.getTime() + seconds);
	document.cookie = escape(cookieName) + '=' + escape(cookieValue)
	+ (expires ? '; expires=' + expires.toGMTString() : '')
	+ (path ? '; path=' + path : '/')
	+ (domain ? '; domain=' + domain : '')
	+ (secure ? '; secure' : '');
}

function alertMsg(msg){
	art.dialog({title:'提示',content:msg,ok:true});
}

function loadBox(){
	if($('.spinner').length > 0){
		$('.bg').remove();
		$('.spinner').remove();
	}else{
		var html = '<div class="bg"></div><div class="spinner"><p>转码中</p><div class="rect1">&nbsp;</div><div class="rect2">&nbsp;</div><div class="rect3">&nbsp;</div><div class="rect4">&nbsp;</div><div class="rect5">&nbsp;</div></div>';
		$('body').append(html);
	}
}