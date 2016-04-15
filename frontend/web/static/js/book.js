/**
 * 
 */
$(function(){
	$('body').on('click','.getArticle',function(){
		var u = $(this).data('url');
		if(u == ''){
			alertMsg('没有了');
			return false;
		}
		loadBox();
		getArticle(u);
	});
	if($('#u').length > 0){
		loadBox();
		getArticle($('#u').val());
	}
	if($('#c').length > 0){
		loadBox();
		getChapter();
	}
	$('.auhe').height($(window).height()*0.34);
	
	$(document).keyup(function(a){
		if(a.keyCode == 37){
			$('#prev').click();
		}else if(a.keyCode == 39){
			$('#next').click();
		}
	});
});

function getArticle(u){
	$.ajax({
		url:__getArticle,
		//data:{u:u,_csrf:$('#_csrf').val()},
		data:{'u':u},
		dataType:'json',
		timeout:10000,
		type:'GET',
		error:function(XMLHttpRequest, textStatus, errorThrown){
			loadBox();
			if(textStatus == 'timeout'){
				alertMsg('网络繁忙，请稍后再试');
				return false;
			}else{
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
			$('#title').text(result.title);
			$('.content').html(result.content);
			$('.nextchapter').html(result.paging);
			amendUrl(_getArticle+'&u='+u);
			$(window).scrollTop(0);
		}
	});
}

function getChapter(){
	$.ajax({
		url:__getChapter,
		dataType:'json',
		timeout:30000,
		type:'GET',
		error:function(XMLHttpRequest, textStatus, errorThrown){
			loadBox();
			if(textStatus == 'timeout'){
				alertMsg('网络繁忙，请稍后再试');
				return false;
			}else{
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

function loadBox(){
	if($('.spinner').length > 0){
		$('.bg').remove();
		$('.spinner').remove();
	}else{
		var html = '<div class="bg"></div><div class="spinner"><p>转码中</p><div class="rect1">&nbsp;</div><div class="rect2">&nbsp;</div><div class="rect3">&nbsp;</div><div class="rect4">&nbsp;</div><div class="rect5">&nbsp;</div></div>';
		$('body').append(html);
	}
}

function alertMsg(msg){
	alert(msg);
}

function amendUrl(url){
	history.pushState('','',url);
}