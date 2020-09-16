$(document).ready(function() {
    var dataTable = $('#table_data').DataTable({
        'createdRow': function (row, data, dataIndex) {
                    $(row).attr('name', 'row'+dataIndex);
                },
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 50,
        "ajax": {
            url: site_url + '/admin_employee/fetch_admin_employee',
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

var crud = {};

crud .ajax = {
    del_data:function (id,cb){
        var url = '/admin_employee/del_admin_employee',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },save:function (items,cb){
             var url = '/admin_employee/save_admin_employee',
                 params = {
                     items: items
                 }

             app.ajax(url, params, function (err, data) {
                 err ? cb(err) : cb(null, data);
             });
    },get_update:function (id,cb){
                   var url = '/admin_employee/get_admin_employee',
                       params = {
                           id: id
                       }

                   app.ajax(url, params, function (err, data) {
                       err ? cb(err) : cb(null, data);
                   });
    }

};
crud.del_data = function(id){

    crud.ajax.del_data(id, function (err, data) {
        if (err) {
            swal(err)
        }
        else {
            //swal('ลบข้อมูลเรียบร้อย')
            app.alert('ลบข้อมูลเรียบร้อย');

        }
    });
}

crud.save = function (items,row_id) {
    crud.ajax.save(items, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
            if(items.action == 'insert'){
                crud.set_after_insert(items,data.id);
            }else if(items.action == 'update'){
                crud.set_after_update(items,row_id);
            }
            $('#frmModal').modal('toggle');
            swal('บันทึกข้อมูลเรียบร้อยแล้ว ');
        }
    });

}


crud.get_update = function (id,row_id) {
    crud.ajax.get_update(id, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
                //swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
                //location.reload();
                crud.set_update(data,row_id);
        }
    });

}


crud.set_after_update = function (items,row_id) {

    var row_id = $('tr[name="' + row_id + '"]');
    row_id.find("td:eq(0)").html(items.id);row_id.find("td:eq(1)").html(items.prename);row_id.find("td:eq(2)").html(items.name);row_id.find("td:eq(3)").html(items.cid);row_id.find("td:eq(4)").html(items.sex);row_id.find("td:eq(5)").html(items.position);row_id.find("td:eq(6)").html(items.hospcode);row_id.find("td:eq(7)").html(items.employee_type);row_id.find("td:eq(8)").html(items.group);row_id.find("td:eq(9)").html(items.email);row_id.find("td:eq(10)").html(items.user_mobile);row_id.find("td:eq(11)").html(items.date_in);row_id.find("td:eq(12)").html(items.date_out);row_id.find("td:eq(13)").html(items.address);row_id.find("td:eq(14)").html(items.active);row_id.find("td:eq(15)").html(items.driver);row_id.find("td:eq(16)").html(items.order);

}
crud.set_after_insert = function (items,id) {

            $('<tr name="row'+(id+1)+'"><td>'+id+'</td>' +
                '<td>' +items.id+'</td>' +'<td>' +items.prename+'</td>' +'<td>' +items.name+'</td>' +'<td>' +items.cid+'</td>' +'<td>' +items.sex+'</td>' +'<td>' +items.position+'</td>' +'<td>' +items.hospcode+'</td>' +'<td>' +items.employee_type+'</td>' +'<td>' +items.group+'</td>' +'<td>' +items.email+'</td>' +'<td>' +items.user_mobile+'</td>' +'<td>' +items.date_in+'</td>' +'<td>' +items.date_out+'</td>' +'<td>' +items.address+'</td>' +'<td>' +items.active+'</td>' +'<td>' +items.driver+'</td>' +'<td>' +items.order+'</td>' +
                '<td><div class="btn-group pull-right" role="group">' +
                '<button class="btn btn-outline btn-success" data-btn="btn_view" data-id="' + id + '"><i class="fa fa-eye"></i></button>' +
                '<button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' + id + '"><i class="fa fa-edit"></i></button>' +
                '<button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' + id + '"><i class="fa fa-trash"></i></button>' +
                '</td></div>' +
                '</tr>').insertBefore('table > tbody > tr:first');
}

crud.set_update = function (data,row_id) {
    $("#row_id").val(row_id);
    $("#id").val(data.rows["id"]);$("#prename").val(data.rows["prename"]);$("#name").val(data.rows["name"]);$("#cid").val(data.rows["cid"]);$("#sex").val(data.rows["sex"]);$("#position").val(data.rows["position"]);$("#hospcode").val(data.rows["hospcode"]);$("#employee_type").val(data.rows["employee_type"]);$("#group").val(data.rows["group"]);$("#email").val(data.rows["email"]);$("#user_mobile").val(data.rows["user_mobile"]);$("#date_in").val(data.rows["date_in"]);$("#date_out").val(data.rows["date_out"]);$("#address").val(data.rows["address"]);$("#active").val(data.rows["active"]);$("#driver").val(data.rows["driver"]);$("#order").val(data.rows["order"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    var row_id = $("#row_id").val();
    items.action = $('#action').val();
    // items.brand_name = $("#brand option:selected").text();
    items.id=$("#id").val();items.prename=$("#prename").val();items.name=$("#name").val();items.cid=$("#cid").val();items.sex=$("#sex").val();items.position=$("#position").val();items.hospcode=$("#hospcode").val();items.employee_type=$("#employee_type").val();items.group=$("#group").val();items.email=$("#email").val();items.user_mobile=$("#user_mobile").val();items.date_in=$("#date_in").val();items.date_out=$("#date_out").val();items.address=$("#address").val();items.active=$("#active").val();items.driver=$("#driver").val();items.order=$("#order").val();

          if(validate(items)){
                crud.save(items,row_id);
            }

});

$('#add_data').on('click', function (e) {
    e.preventDefault();
        $("#frmModal input").prop('disabled', false);
        $("#frmModal select").prop('disabled', false);
        $("#frmModal textarea").prop('disabled', false);
        $("#frmModal .btn").prop('disabled', false);
    app.clear_form();
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
            crud.del_data(id);
            td.hide();
        }
    });
});

$(document).on('click', 'button[data-btn="btn_edit"]', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#action').val('update');
    $('#id').val(id);
    var row_id = $(this).parent().parent().parent().attr('name');
        $("#frmModal input").prop('disabled', false);
        $("#frmModal select").prop('disabled', false);
        $("#frmModal textarea").prop('disabled', false);
        $("#frmModal .btn").prop('disabled', false);

    crud.get_update(id,row_id);
    $('#frmModal').modal('show');

});

$(document).on('click', 'button[data-btn="btn_view"]', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#action').val('update');
    $('#id').val(id);
    var row_id = $(this).parent().parent().parent().attr('name');
    crud.get_update(id, row_id);
    $("#frmModal input").prop('disabled', true);
    $("#frmModalselect").prop('disabled', true);
    $("#frmModaltextarea").prop('disabled', true);
    $("#frmModal .btn").prop('disabled', true);
    $("#btn_close").prop('disabled', false);
    $('#frmModal').modal('show');

});

function validate(items){

    if (!items.id) { swal("กรุณาระบุID");$("#id").focus();}else if (!items.prename) { swal("กรุณาระบุคำนำหน้า");$("#prename").focus();}else if (!items.name) { swal("กรุณาระบุชื่อ สกุล");$("#name").focus();}else if (!items.cid) { swal("กรุณาระบุเลขบัตรประชาชน");$("#cid").focus();}else if (!items.sex) { swal("กรุณาระบุเพศ");$("#sex").focus();}else if (!items.position) { swal("กรุณาระบุตำแหน่ง");$("#position").focus();}else if (!items.hospcode) { swal("กรุณาระบุรหัสหน่วยบริการ");$("#hospcode").focus();}else if (!items.employee_type) { swal("กรุณาระบุประเภทพนักงาน");$("#employee_type").focus();}else if (!items.group) { swal("กรุณาระบุกลุ่่มงาน");$("#group").focus();}else if (!items.email) { swal("กรุณาระบุE-Mail");$("#email").focus();}else if (!items.user_mobile) { swal("กรุณาระบุโทรศัพย์");$("#user_mobile").focus();}else if (!items.date_in) { swal("กรุณาระบุวันเริ่มทำงาน");$("#date_in").focus();}else if (!items.date_out) { swal("กรุณาระบุวันสิ้นสุดการทำงาน");$("#date_out").focus();}else if (!items.address) { swal("กรุณาระบุที่อยู่");$("#address").focus();}else if (!items.active) { swal("กรุณาระบุสถานะการใช้งาน");$("#active").focus();}else if (!items.driver) { swal("กรุณาระบุพนักงานขับรถ");$("#driver").focus();}else if (!items.order) { swal("กรุณาระบุลำดับในกลุ่มงาน");$("#order").focus();}
    else{
        return true;
    }

}