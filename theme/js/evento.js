(function($) {
		
		$('#myTabs a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		})
		
		$('#enlace-evento').on("click",function(e){
			e.preventDefault();
			e.stopPropagation();
						
			var url=$(this).attr("href");
			
			ifrm = $(document.createElement("iframe"))
			.attr({
				width:       "100%",
				frameborder: "0"
			});
			
			ifrm.attr('src', url);
			$('#events-modal-load .modal-body').html(ifrm);
			
		
			
			$('#events-modal-load').on('shown.bs.modal', function (e) {
				var modal_body = $(this).find('.modal-body');
				//var height = modal_body.height() - parseInt(modal_body.css('padding-top'), 10) - parseInt(modal_body.css('padding-bottom'), 10);
				var height=modal_body.height()-5;
				$(this).find('iframe').height(Math.max(height, 50));
				
				/*$.ajax({url: url, dataType: "html", async: false, success: function(data) {
					modal_body.html(data);
				}});*/	
			})
			
			
	
												
			$('#events-modal-load').modal({
				show:true,
				backdrop: 'static', 
				keyboard: false
			});
		});		
		
}(jQuery));