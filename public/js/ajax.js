jQuery(function($){

	$.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

	$("#logoSearch").keyup(function(){
		var tekst = $(this).val();
		searchLogos(tekst);
	});

	function searchLogos(tekst){
		$.ajax({
			url: BASE_URL+'/photos/search/'+tekst,
			success: function(podaci){
				getLogos(podaci);
			},
			error: function(xhr, status, error){
	    		alert('Error! '+error);
	    	}
	    });
	}

	function getLogos(podaci){
		var card = '';
		$.each(podaci, function(i, item){
			card  +=   `<div class="col-md-2">
							<div class="card">
								<div class="card-body">
									<div class="mx-auto d-block">
										<img class="mx-auto d-block" style="width: 100px; height: 100px;" src="`+PUBLIC_URL+item.path+`" alt="`+item.name+`">
										<h5 class="text-sm-center mt-2 mb-1">`+item.name+`</h5>
										<div class="location text-sm-center"></div>
									</div><hr>
									<div class="card-text text-sm-center" style="font-size: 12px;">Putanja fajla: `+item.path+`</div>
								</div>
								<div class="card-footer" style="height: 50px;"><p style="font-size: 12px;">Last update: `+item.updated_at+`</p></div>
								<a href="photos/`+item.id+`/edit" class="btn btn-primary btn btn-block">PROMENI</a>
								<a href="photos/`+item.id+`/destroy" class="btn btn-warning btn btn-block" data-toggle="modal" data-target="#modalLogo-`+item.id+`">OBRIŠI</a>
							</div>
						</div>`;
	    	$("#card").html(card);
		});
	}

});
