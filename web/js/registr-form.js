$(function(){
	// элементы с ошибками ..ы
	var errs=[];
	// после валидации каждого атрибута 
	$('#register-form').on('afterValidateAttribute',function(e,a,mess){
		if (errs.indexOf(a.id)!=-1)
			errs.splice(errs.indexOf(a.id),1);
		var el=$(this).find(a.container+' .ico');
		el.removeClass('glyphicon-remove glyphicon-ok')
		if (mess.length){
			el.addClass('glyphicon-remove');
			errs.push(a.id);
		}
		else
			el.addClass('glyphicon-ok');
			
		

		var data=$(this).yiiActiveForm('data');
		var vlidall=true;
		for(var i=0;i<data.attributes.length;i++)
			vlidall=vlidall && data.attributes[i].status==1;
		if (!vlidall || errs.length)
			$(this).find('.submitbutt').attr('disabled','disabled');
		else
			$(this).find('.submitbutt').removeAttr('disabled');	

	});

});