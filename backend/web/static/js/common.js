
$(function(){
	if($('.js_menu').length > 0){
		$('.js_'+$('.js_menu').val()).parent('li').addClass('active').parent('ul').css('display','block');
	}
});

function alertMsg(msg){
	art.dialog({title:'提示',content:msg,ok:true});
}
