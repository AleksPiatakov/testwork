$(document).ready(function() {

      // загрузка картинок для атрибутов    
		if($('#uploadButton3').is('*')) { 
			var button3 = $('#uploadButton3'), interval;
    	$.ajax_upload(button3, {
						action : 'upload.php?method=attribs',
						name : 'myfile3',
						onSubmit : function(file, ext) {
							// показываем картинку загрузки файла
							$("img#load3").attr("src", "load.gif");
							$("#uploadButton3 font").text('upload');
							/*Выключаем кнопку на время загрузки файла*/
							this.disable();
						},
						onComplete : function(file, response) {
							// убираем картинку загрузки файла
							$("img#load3").attr("src", "images/butt_ld.png");
							$("#uploadButton3 font").text('upload');
							// снова включаем кнопку
							this.enable();
             	// показываем что файл загружен
              if (response!='') file = response;  
              $("#filenames3").val(file);
              $("#files3").html($("<div class=attr_img><img name="+file+" id="+file+"self src='../images/thumb"+ file +"'/ /><img class=attr_del alt=del name="+file+" src=attributeManager/images/icon_delete.png onclick=jsondel3(this,this.name,document.getElementById('attr_id').value); /></div>"));
              $.get('towork_attrib_colors.php', {attr: $("#attr_id").val(),act:'write',img:$("#filenames3").val()}, function(obj){
               // alert(obj);
              });

						}
					});
		}

	              
		});       

  function jsondel3(o,k,at) {
    $.get('towork_attrib_colors.php', {fn:o.name,act:'del',attr:at,img:document.getElementById('filenames3').value}, function(obj){
      $('.attr_img').remove();
    });  
  }

  
  