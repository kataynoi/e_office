$(document).ready(function() {
    var dataTable = $('#outsite_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "pageLength": 50,
        "ajax": {
            url: site_url + '/car/fetch_used_car',
            data: {
                'csrf_token': csrf_token
            },
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [2, 3],
                "orderable": false,
            },
        ],
    });

});

var outsite_index = {};

outsite_index.ajax = {
    del_outsite:function (id,cb){
        var url = '/outsite/del_outsite',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }

};


outsite_index.del_outsite = function(id){

    outsite_index.ajax.del_outsite(id, function (err, data) {
        if (err) {
            swal(err)
        }
        else {
            //swal('ลบข้อมูลเรียบร้อย')
            app.alert('ลบข้อมูลเรียบร้อย');

        }
    });
}



$(document).on('click', 'button[data-btn="btn_del"]', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    var td = $(this).parent().parent().parent();

    swal({
        title: "คำเตือน?",
        text: "คุณต้องการลบข้อมูล ",
        icon: "warning",
        buttons: [
            'cancel !',
            'Yes !'
        ],
        dangerMode: true,
    }).then(function(isConfirm){
        if(isConfirm){
            outsite_index.del_outsite(id);
            td.hide();
        }
    });
});

// btn_Demographic
