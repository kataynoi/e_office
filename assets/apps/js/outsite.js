$(document).ready(function () {
    var arr = arr_member;
    var cars=[];
    console.log(arr);
    set_arr_user();
    //set_cars();
    function set_arr_user() {
        $('#tbl_list > tbody').empty();
        for (var i = 0; i < arr.length; i++) {
            var member = arr[i];
            $('#tbl_list > tbody').append(
                '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + member["name"] + '</td>' +
                '<td>' + member["position"] + '</td>' +
                '<td><div class="btn-group" role="group" aria-label="Basic example">' +
                '<button type="button" class="btn btn-success" data-btn="btn_up" data-id="' + i + '"><i class="fa fa-arrow-up"></i></button>' +
                '<button type="button" class="btn btn-success" data-btn="btn_down" data-id="' + i + '"><i class="fa fa-arrow-down"></i></button>' +
                '<button type="button" class="btn btn-danger" data-btn="btn_del_permit_user" data-id="' + i + '"><i class="fa fa-minus-square"></i></button>' +
                '</div></td></td>' +
                '</tr>'
            );
        }
    }

    function set_cars() {
        $('#tbl_car_list > tbody').empty();
        for (var i = 0; i < cars.length; i++) {
            var car = cars[i];
            $('#tbl_car_list > tbody').append(
                '<tr>' +
                '<td>' + (i + 1) + '</td>' +
                '<td>' + car["licente_plate"] + '</td>' +
                '<td>' + car["driver"] + '</td>' +
                '<td>' + car["user_mobile"] + '</td>' +
                '<td>' + car["control_car"] + '</td>' +
                '<td><div class="btn-group" role="group" aria-label="Basic example">' +
                '<button type="button" class="btn btn-danger" data-btn="btn_del_permit_user" data-id="' + i + '"><i class="fa fa-minus-square"></i></button>' +
                '</div></td></td>' +
                '</tr>'
            );
        }
    }
    if(invite==1){
        $('#frm_invit1').fadeIn();
        $('#frm_invit2').hide();
    }else if(invite==2){
        $('#frm_invit2').fadeIn();
        $('#frm_invit1').hide();
    }else if(invite==0){
        $('#frm_invit1').hide();
        $('#frm_invit2').hide();
    }
    hide_frm_used_car();
    //disable_print();
    //User namespace
    var outsite = {};
    outsite.ajax = {
        save_outsite: function (items, cb) {
            var url = '/outsite/save_outsite',
                params = {
                    items: items
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        },
        search_user: function (txt_search, cb) {
            var url = '/user/search_user',
                params = {
                    txt_search: txt_search
                }

            app.ajax(url, params, function (err, data) {
                err ? cb(err) : cb(null, data);
            });
        }
    };

    outsite.save_outsite = function (items) {
        outsite.ajax.save_outsite(items, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                if(items.action == 'insert'){
                    swal('บันทึกข้อมูลเรียบร้อยแล้ว ');
                    window.location = base_url+"outsite";
                }else if(items.action == 'update'){
                    swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
                    enable_print();
                    //location.reload();
                }

            }
        });

    }

    outsite.search_user = function (txt_search) {

        outsite.ajax.search_user(txt_search, function (err, data) {
            if (err) {
                app.alert(err);
            }
            else {
                outsite.set_search_user(data);
            }
        });
    }

    outsite.set_search_user = function (data) {

        $('#tbl_search_result > tbody').empty();
        if (_.size(data.rows) > 0) {
            var i = 1;
            _.each(data.rows, function (v) {
                $('#tbl_search_result > tbody').append(
                    '<tr>' +
                    '<td>' + i + '</td>' +
                    '<td >' + v.name + '</td>' +
                    '<td>' + v.position + '</td>' +
                    '<td><button class="btn btn-success " data-btn="btn_add_permit_user" data-id="' + v.id + '"' +
                    'data-name="' + v.name + '"' +
                    'data-position="' + v.position + '">' +
                    '<i class="fa fa-plus-circle"></i> เพิ่ม</button></td>' +
                    '</tr>'
                );
                i++;
            });
        }
        else {
            $('#tbl_search_result > tbody').append('<tr><td colspan="4">ไม่พบรายการ</td></tr>');
        }
    }

    outsite.set_permit_user = function (id, name, position) {
        arr.push({"user_id": id, "name": name, "position": position, driver: ""});
        set_arr_user();
        console.log(arr);

    }

    $('#txt_search').bind('keypress', function (e) {
        if (e.keyCode == 13) {
            var txt_search = $('#txt_search').val();
            if (!txt_search) {
                swal('กรุณาระบุชื่อผู้ต้องการค้นหา');
                return false;
            } else {
                console.log(txt_search);
                outsite.search_user(txt_search);
            }
        }
    });
    $('#btn_search').on('click', function (e) {

        var txt_search = $('#txt_search').val();
        if (!txt_search) {
            swal('กรุณาระบุชื่อผู้ต้องการค้นหา');
            return false;
        } else {
            console.log(txt_search);
            outsite.search_user(txt_search);
        }

    });

    $(document).on('click', 'button[data-btn="btn_add_permit_user"]', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var name = $(this).data('name');
        var position = $(this).data('position');
        console.log(id + name + position);
        outsite.set_permit_user(id, name, position);
        $(this).parent().parent().hide();
        disable_print();
    });

    $(document).on('click', 'button[data-btn="btn_del_permit_user"]', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        console.log(id)
        arr.splice(id, 1);
        set_arr_user();
        disable_print();
    });
    $(document).on('click', 'button[data-btn="btn_down"]', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        console.log(id)
        // arr.splice(id, 1);
        //set_arr_user();

        var id_original = id + 1;
        var ori = arr[id_original];
        var _new = arr[id];
        var id_down = arr[id_original][0];
        var name_down = arr[id_original][1];
        var position_down = arr[id_original][2];
        arr.splice(id, 1, ori);
        arr.splice(id_original, 1, _new);
        set_arr_user();
        disable_print();

    });
    $(document).on('click', 'button[data-btn="btn_up"]', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        console.log(id)
        // arr.splice(id, 1);
        //set_arr_user();

        var id_original = id - 1;
        var ori = arr[id_original];
        var _new = arr[id];
        var id_down = arr[id_original][0];
        var name_down = arr[id_original][1];
        var position_down = arr[id_original][2];
        arr.splice(id, 1, ori);
        arr.splice(id_original, 1, _new);
        set_arr_user();
        disable_print();

    });


    $('#btn_add_car').on('click', function (e) {
        console.log('car');
        e.preventDefault();
        cars.push({"car_id": '', "driver": '', "control_car": ''});
        console.log(cars);
        var no = cars.length;
        var option;
        for (i = 0; i < arr.length; i++) {
            if(i==0){option+='<option> ---  ระบุผู้ควบคุมรถ --- </option>'}
            option+='<option value="'+arr[i]["user_id"]+'">'+arr[i]["name"]+'</option>';
        }
      $('#tbl_car_list').append(
          '<tr>' +
          '<td>'+no+'</td>' +
          '<td></td>' +
          '<td></td>' +
          '<td></td>' +
          '<td>' +
          '<select class="form-control">' +
          option+
          '</select>' +
          '</td>' +
          '<td></td>' +
          '</tr>'
      )

    });

    $(document).on('click', 'button[data-btn="btn_del_car"]', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        console.log(id)
        arr.splice(id, 1);
        set_arr_user();
        disable_print();
    });

    $('#btn_save_outsite').on('click', function (e) {
        e.preventDefault();
        var action;
        var items = {};
        items.id = $('#id').val();
        //items.outsite_type = $('#outsite_type').val();
        items.permit_user = $('#permit_user').val();
        items.date_permit = $('#date_permit').val();
        items.invit_number = $('#invit_number').val();
        items.invite = $('#invite').val();
        items.detail_no_invit = $('#detail_no_invit').val();
        items.invit_type = $('#invit_type').val();
        items.invit_name = $('#invit_name').val();
        if(items.invite==1){
            items.invit_subject = $('#invit_subject').val();
            items.invit_place = $('#invit_place').val();
        }else if(items.invite==2){
            items.invit_subject = $('#invit_subject2').val();
            items.invit_place = $('#invit_place2').val();
        }
        items.invit_date = $('#invit_date').val();
        items.date_permit = $('#date_permit').val();
        items.invit_start_date = $('#invit_start_date').val();
        items.invit_end_date = $('#invit_end_date').val();
        items.permit_start_date = $('#permit_start_date').val();
        items.permit_end_date = $('#permit_end_date').val();
        items.objective = $('#objective').val();
        items.claim_type = $('#claim_type').val();
        items.permit_group = $('#permit_group').val();
        items.travel_type = $('#travel_type').val();
        items.license_plate = $('#license_plate').val();
        console.log(items);
        if(!items.id){items.action='insert'}else{items.action='update'}
        var user_id = [];
        for (i = 0; i < arr.length; i++) {
            user_id.push(parseInt(arr[i]["user_id"]));
        }
        console.log(user_id);
        items.users = user_id;
        if (!items.date_permit) {
            swal('กรุณาระบุวันที่ขออนุญาติไปราชการ');
            $('#date_permit').focus();
        }
        else if(items.invite==0){
            swal('มีหนังสือเชิญประชุมหรือไม่');
            $('#invite').focus();
        }else if(items.invite==1 && (!items.invit_type || !items.invit_name || !items.invit_subject || !items.invit_place )){
            swal('กรุณาระบุรายละเอียดการเชิญประชุมให้ครบถ้วน');
        }else if(items.invite==2 && (!items.invit_subject || !items.invit_place )){
            swal('กรุณาระบุเรื่องและสถานที่ไปราชการให้ครบถ้วน');
        }else if(!items.objective){
            swal('กรุณาระบุวัตถุประสงค์การไปราชการ');
            $('#objective').focus();
        }else if(!items.claim_type){
            swal('กรุณาระบุประเภทการเบิกจ่ายค่าเดินทางไปราชการ');
            $('#claim_type').focus();
        }else if(!items.travel_type){
            swal('กรุณาระบุประเภทการเดินทางไปราชการ');
            $('#travel_type').focus();
        }else if(items.travel_type==3 && !items.license_plate){
            swal('กรุณาระบุหมายเลขทะเบียนรถยนต์ส่วนตัว');
        }else if(user_id.length==0){
            swal('กรุณาระบุรายชื่อผู้ขอไปราชการ');

        }
        else {
            outsite.save_outsite(items,action);
        }
        //console.log(items);
    });

    $('#btn_print_pdf').on('click', function () {
        // alert('test');
        var pdf_template = '';
        var day = '';
        var id = $('#id').val();
        var invite = $('#invite').val();
        var person = arr.length;;
        if($('#petmit_start_date') == $('#petmit_end_date')){
            day =1;
        }else{
            day = 2;
        }
        if( invite==1 && person==1){
            pdf_template = 'outsite1_pdf'
        }else if(invite==1 && person >1 && person <=5){
            pdf_template = 'outsite2_pdf'
        }else if(invite==1 && person >5 ){
            pdf_template = 'outsite3_pdf'
        }else if(invite==2 && person ==1){
            pdf_template = 'outsite4_pdf'
        }else if(invite==2 && person >1 && person <=5){
            pdf_template = 'outsite5_pdf'
        }else if(invite==2 && person >5){
            pdf_template = 'outsite6_pdf'
        }
        console.log(pdf_template);
        window.open(base_url + 'index.php/outsitepdf/outsite/' + pdf_template + '/' + id, "_blank");

    });
//$("#frm_invit").hide();

    $('#btn_print_claim').on('click', function () {
        // alert('test');
        var pdf_template = '';
        var day = '';
        var id = $('#id').val();
        var invite = $('#invite').val();
        var person = arr.length;;
        if($('#petmit_start_date') == $('#petmit_end_date')){
            day =1;
        }else{
            day = 2;
        }
        pdf_template = 'outsite1_claim_pdf'

        console.log(pdf_template);
        window.open(base_url + 'index.php//outsite_claim_pdf/outsite_claim/' + pdf_template + '/' + id, "_blank");

    });

});

$( "#invite" ).change(function() {
    var val = $(this).val();
    console.log(val);
    if(val==1){
        $('#frm_invit1').fadeIn();
        $('#frm_invit2').hide();
    }else{
        $('#frm_invit2').fadeIn();
        $('#frm_invit1').hide();
    }
});

$( "#travel_type" ).change(function() {
    var val = $(this).val();
    console.log(val);
    if(val==3){
        $('#txt_license_plate').fadeIn();
        hide_frm_used_car();
    }else if(val == 4 ) {
        show_frm_used_car();
        $('#txt_license_plate').fadeOut();
    } else{
        $('#txt_license_plate').fadeOut();
        hide_frm_used_car();
    }
});

if($('#travel_type').val() == 4 ) {
    show_frm_used_car();
}

$(':input').change(function(){
    disable_print();
});
$('select').change(function(){
    disable_print();
});
$("#textarea").keypress(function(){
    disable_print();
})
function disable_print(){
    $('#btn_print_pdf').attr("disabled", "disabled");
}
function enable_print(){
    $('#btn_print_pdf').removeAttr("disabled");
}
function show_frm_used_car(){
    $('#frm_used_car').fadeIn();
}
function hide_frm_used_car(){
    $('#frm_used_car').fadeOut();
}
