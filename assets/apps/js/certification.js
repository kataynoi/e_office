$(document).ready(function() {
    var dataTable = $('#certification_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 50,
        "ajax": {
            url: site_url + '/certification/fetch_certification',
            data: {
                'csrf_token': csrf_token
            },
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [1, 2],
                "orderable": false,
            },
        ],
    });

});

