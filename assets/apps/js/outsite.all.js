$(document).ready(function() {
    var dataTable = $('#outsite_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 10,
        "ajax": {
            url: site_url + '/outsite/fetch_outsite_all',
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
    },
    set_lock:function (id,val,cb){
        var url = '/outsite/set_lock',
            params = {
                id: id,
                val:val
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

outsite_index.set_lock = function(id,val){

    outsite_index.ajax.set_lock(id,val, function (err, data) {
        if (err) {
            swal(err)
        }
        else {
            //swal('ลบข้อมูลเรียบร้อย')
            swal('แกไขเรียบร้อย');
            location.reload();
        }
    });
}


$(document).on('click', 'button[data-btn="lock"]', function(e) {
    e.preventDefault();
    console.log('Function Lock');
    var id = $(this).data('id');
    var lock = $(this).data('lock');
    var lock_text ='';
    if(lock==1){
        lock_text = 'สิปลดล๊อคแม่นบ่ กะกดติ๊ละ .....';
    }else{
        lock_text ='นั่น!!!  สิล๊อค ติบาดหนิ..... กดสะแม้';
    }
    swal({
        title: "คำเตือน?",
        text: lock_text,
        icon: "warning",
        buttons: [
            'cancel !',
            'Yes !'
        ],
        dangerMode: true,
    }).then(function(isConfirm){
        if(isConfirm){
            if(lock==1){
                outsite_index.set_lock(id,0);
                $(this).find("i").toggleClass("fa-unlock");
            }else{
                outsite_index.set_lock(id,1);
                $(this).find("i").toggleClass("fa-lock");
            }

        }
    });
});

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
