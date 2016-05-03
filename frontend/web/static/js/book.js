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
	
	read_bjys = getcookie('read_bjys');
	read_ztys = getcookie('read_ztys');
	read_ztdx = getcookie('read_ztdx');
	$('body').css('background', read_bjys);
	$('.content').css('color', read_ztys);
	$('.content').css('font-size', read_ztdx);
	$('.content p').css('font-size', read_ztdx);
	if(read_bjys)$('#bjys').val(read_bjys);
	if(read_ztys)$('#ztys').val(read_ztys);
	if(read_ztdx)$('#ztdx').val(read_ztdx);
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
		async:false,
		data:{'u':u},
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
			$('#title').text(result.title);
			$('title').text(result.title+'_竹刻书小说搜索');
			$('.content').html(result.content);
			$('.nextchapter').html(result.paging);
			amendUrl(_getArticle+'&u='+u);
			$(window).scrollTop(0);
		}
	});
}

function amendUrl(url){
	history.pushState('','',url);
}

function selectbj(obj){
	$('body').css('background', $(obj).val());
	setcookie('read_bjys', $(obj).val(), 3600*24*1000*365);
}
function selectzy(obj){
	$('.content').css('color', $(obj).val());
	setcookie('read_ztys', $(obj).val(), 3600*24*1000*365);
}
function selectzd(obj){
	$('.content').css('font-size', $(obj).val());
	$('.content p').css('font-size', $(obj).val());
	setcookie('read_ztdx', $(obj).val(), 3600*24*1000*365);
}

var speed = 5;
var timer;
function selectgd(obj){
	if($(obj).val() > 0 || $(obj).val() < 11){
		speed = $(obj).val();
	}
}
function stopScroll()
{
    clearInterval(timer);
}

function beginScroll()
{
	timer=setInterval("scrolling()",300/speed);
}

function scrolling()
{
	var currentpos = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    window.scroll(0, ++currentpos);
	var nowpos = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
    if(currentpos != nowpos) clearInterval(timer);
}
document.onmousedown=stopScroll;
document.ondblclick=beginScroll;