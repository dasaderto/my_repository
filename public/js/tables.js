$(document).ready(function() {
$('#myTable').DataTable( {
	dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'pdfHtml5',
            'print'
        ]
    });
	$(".expand-users").bind('click',function(){
		$('.user-tbl-data').slideToggle('slow');
		if ($(".expand-users").text()=='Развернуть') { 
			$(".expand-users").text('Свернуть');
			$(".expander i").remove();
			$(".expander").append('<i class="fa fa-angle-up"></i>');
		}else{
		 $(".expand-users").text('Развернуть');
		 $(".expander i").remove();
		 $(".expander").append('<i class="fa fa-angle-down"></i>');
		}
		

	});
});	