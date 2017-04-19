jQuery(document).ready(function(){

	function getData(){

		jQuery.ajax({
			type: 'post',
            url: '/main/getjson',            
            dataType: 'json',
            success: function(data){ 
				
				// очистка предыдущих данных
				jQuery('#table_parse #new').text('');
				jQuery('#table_parse #conversation').text('');
				jQuery('#table_parse #work').text('');
				
				// получение новых данных
				getItems( data.items.new , 'new');				
				getItems( data.items.conversation, 'conversation' );				
				getItems( data.items.work ,'work');				
				
			},
            error: function(data){
                alert(  'error');
            }
        });
		
	}

	function getItems(obj, stage){
		var html = '';
		//var stage = '';
		jQuery.each(obj, function(key, val){			
			jQuery.each(val, function(key, item){
				if(key=='date') {					
					jQuery('#parse_template #parse_'+key).text( getDateFromUnix(item) );					
				}else{	
					jQuery('#parse_template #parse_'+key).text(item);
				}
				// if(key=='stage') stage=val;
			});			
			jQuery('#parse_template #parse_class').clone().addClass(stage).appendTo('#table_parse #' + stage);
			
		});
	}
	
	function getDateFromUnix(unixtimestamp){
		 var months_arr = ['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'];
		 var date = new Date(unixtimestamp*1000);
		 var year = date.getFullYear();
		 var month = months_arr[date.getMonth()];
		 //var month = date.getMonth();
		 var day = date.getDate();
		 var hours = date.getHours();
		 var minutes = "0" + date.getMinutes();
		 var seconds = "0" + date.getSeconds();
		 var convdataTime = day+' '+month+' '+year;
		 
		 return convdataTime;
	 
	}
	
	jQuery('#get_data').click(function(){
		getData();
	});
	
	getData();
	
});