$(document).ready(function() {
    var dataTable = $('#outsite_data').DataTable({
        "processing": true,
        "serverSide": true,
        "order": [],
        "paging": true,
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
                "targets": [3, 4],
                "orderable": false,
            },
        ],
    });

    var approve = $('#approve').val();
    if(approve == 0){
        $('#frm_approve').hide();
        $('#frm_not_approve').hide();
    }else if(approve == 1){
        show_frm_approve();
    }else if(approve == 2){
        hide_frm_approve();
    }

});

var approve_index = {};

approve_index.ajax = {
    del_outsite:function (id,cb){
        var url = '/outsite/del_outsite',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },
    save_used_car:function (items,cb){
        var url = '/car/save_used_car',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }

};


approve_index.del_outsite = function(id){

    approve_index.ajax.del_outsite(id, function (err, data) {
        if (err) {
            swal(err)
        }
        else {
            //swal('ลบข้อมูลเรียบร้อย')
            app.alert('ลบข้อมูลเรียบร้อย');

        }
    });
}
approve_index.save_used_car = function(items){

    approve_index.ajax.save_used_car(items, function (err, data) {
        if (err) {
            swal(err)
        }
        else {
            //swal('ลบข้อมูลเรียบร้อย')
            app.alert('บันทึกข้อมูลเรียบร้อย');
            location.reload();

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
            approve_index.del_used_car(id);
            td.hide();
        }
    });
});

$('#btn_save_approve').click(function(){
    var items = {};
    items.id = $('#id').val();
    items.approve = $('#approve').val();
    items.car_id = $('#car_id').val();
    items.driver = $('#driver').val();
    items.cause = $('#cause').val();
    console.log(items);
    approve_index.save_used_car(items);


});

$('#approve').change(function(){
    var approve = $(this).val()
    console.log(approve);
    if(approve == 0){
        $('#frm_approve').hide();
        $('#frm_not_approve').hide();
        $('#car_id option').prop("selected", false);
        $('#driver option').prop("selected", false);

    }else if(approve == 1){
        show_frm_approve();
        $('#cause').val('');
    }else if(approve == 2){
        hide_frm_approve();
        $('#car_id option').prop("selected", false);
        $('#driver option').prop("selected", false);
    }
});
$(document).on('click', 'button[data-btn="btn_approve"]', function(e) {
    e.preventDefault();
    clear_select();
    var id = $(this).data('id');
    var approve = $(this).data('approve');
    var car_id = $(this).data('car');
    var driver_id = $(this).data('driver');
    var cause = $(this).data('cause');
    if(approve == 0){
        $('#frm_approve').hide();
        $('#frm_not_approve').hide();
    }else if(approve == 1){
        show_frm_approve();
    }else if(approve == 2){
        hide_frm_approve();
    }
    console.log(approve+"-"+driver_id);
    $("#approve option[value="+approve+"]").attr('selected', 'selected');
    $("#car_id option[value="+car_id+"]").attr('selected', 'selected');
    $("#driver option[value="+driver_id+"]").attr('selected', 'selected');
    $('#cause').val(cause);
    $('#id').val(id);



});



function clear_select(){
    $('#approve option').prop("selected", false);
    $('#car_id option').prop("selected", false);
    $('#driver option').prop("selected", false);
    $('#cause').val('');
    $('#id').val('');
}

function hide_frm_approve(){
    $('#frm_approve').hide();
    $('#frm_not_approve').fadeIn();
}

function show_frm_approve(){
    $('#frm_approve').fadeIn();
    $('#frm_not_approve').hide();
}


// btn_Demographic
