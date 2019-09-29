$(function() {
	// renders the datatables (datatables.net)
	var oTable = $('#datatables').dataTable({
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "reportings/datatables",
		"lengthMenu": [[10, 20, 50, 100, 300, -1], [10, 20, 50, 100, 300, "All"]],
		"pagingType": "full_numbers",
		"language": {
			"paginate": {
				"previous": 'Prev',
				"next": 'Next', 
			}
		},
		"bAutoWidth": false,
		"aaSorting": [[ 0, "asc" ]],
		"aoColumnDefs": [
			
			{
				"aTargets": [0],
				"sClass": "text-center",
			},
			{
				"aTargets": [1],
				"mRender": function (data, type, full) {
					return '<a href="reportings/form/edit/'+full[0]+'" data-toggle="modal" data-target="#modal" tooltip-toggle="tooltip" data-placement="top" title="Edit">' + data + '</a>';
				},
			},
			{
				"aTargets": [3],
				"mRender": function (data, type, full) {
					switch (full[3]) {
						case '1NFHSMqJtJAMznui2G88uCo4Ak25smCCiZCVNm' :
							return 'Densetsu Ghem';
						break;
						case '14YzXsRpFFzbqDbiyMNnHpZVhUszVdc3YhD5Pr' :
							return "Gaile Sarmiento";
						break;
					} //<span class="badge badge-success">Dashboard.php </span>
					
				},
			},
			{
				"aTargets": [5],
				"mRender": function (data, type, full) {
					switch (full[5]) {
						case 'Busted Lightings in the hallway' :
							return full[5] + ' <span style="color:red">Urgent</span>';
						break;
						default:
							return full[5] + ' <';
						break;
					}
					
					
				},
			},
			{
				"aTargets": [8],
				"mRender": function (data, type, full) {
					switch (full[4].toLowerCase()) {
						case 'common' :
							return '<span class="badge badge-success">' + full[8] +  ' </span>';
						break;
						case 'personal' :
						return '<span class="badge badge-info">' + full[8] +  ' </span>';
						break;
					} 
					
					
				},
			},
			{
				"aTargets": [16],
				"bSortable": false,
				"mRender": function (data, type, full) {
					html = '<a href="reportings/form/view/'+full[0]+'" data-toggle="modal" data-target="#modal" tooltip-toggle="tooltip" data-placement="top" title="View" class="btn btn-sm btn-success"><span class="fa fa-eye"></span></a> ';
					html += '<a href="reportings/form/edit/'+full[0]+'" data-toggle="modal" data-target="#modal" tooltip-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-sm btn-warning"><span class="fa fa-pencil"></span></a> ';
					html += '<a href="reportings/delete/'+full[0]+'" data-toggle="modal" data-target="#modal" tooltip-toggle="tooltip" data-placement="top" title="Delete" class="btn btn-sm btn-danger"><span class="fa fa-trash-o"></span></a>';

					return html;
				},
				"sClass": " text-center",
			},
			
		]
	});

	$('.btn-actions').prependTo('div.dataTables_filter');

	// executes functions when the modal closes
	$('body').on('hidden.bs.modal', '.modal', function () {        
		// eg. destroys the wysiwyg editor
	});

});