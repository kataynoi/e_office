$(document).ready(function(){
    $("#btn_login").removeAttr("disabled");
    //User namespace
    var sign = {};
    sign.ajax = {
        get_sign: function (items, cb) {
            var url = '/signin/get_sign',
                params = {
                    items: items,
                }
            app.ajax(url, params, function (err,data) {
                err ? cb(err) : cb(null, data);
            });
        }

    };

    sign.get_sign = function(items){
        sign.ajax.get_sign(items, function (err, data) {

            if (err) {
                swal(err)
            }
            else {
                //data = JSON.parse(data);
                console.log(data.success);
                if(data.success){
                    swal('Get Success');
                    var no=1;
                    $('#tbl_list > tbody').empty();
                    if (_.size(data.rows) > 0) {
                        _.each(data.rows, function (v) {
                            //v.sign_in = v.sign_in.replace('00:00:00','-');
                            var signin = v.sign_in.split(",");
                            var signout = v.sign_out.split(",");
                            var signtype = v.sign_type.split(",");
                            var signin_txt='',signout_txt='',signtype_txt='';
                            for(i=0;i<signin.length;i++){
                                signin_txt +='<td style="font-size:10px;padding: 1px;margin: 2px">'+signin[i].substr(0,5)+'</td>';
                            }
                            signin_txt ='<td style="font-size:10px;padding: 1px;margin: 2px">เวลามา</td>'+signin_txt+'</tr>';
                            signin_txt = signin_txt.replace(/00:00/g,'');

                            for(i=0;i<signout.length;i++){
                                signout_txt +='<td style="font-size:10px;padding: 1px;margin: 2px">'+signout[i].substr(0,5)+'</td>';
                            }
                            signout_txt ='<td style="font-size:10px;padding: 1px;margin: 2px">เวลากลับ</td>'+signout_txt+'</tr>';
                            signout_txt = signout_txt.replace(/00:00/g,'');

                            for(i=0;i<signtype.length;i++){
                                signtype_txt +='<td style="font-size:10px;padding: 1px;margin: 2px;text-align: center;color: #003399">'+signtype[i]+'</td>';
                            }
                            signtype_txt ='<td style="font-size:10px;padding: 1px;margin: 2px">หมายเหตุ</td>'+signtype_txt+'</tr>';



                            $('#tbl_list > tbody').append(
                                '<tr>' +
                                '<td class="row" rowspan="3">'+no+'<span style="display: none" ><i class="fa fa-check text-success"></i></span></td>' +
                                '<td rowspan="3" >' + v.name + '</td>' +
                                ''+signin_txt+signout_txt+signtype_txt+
                                '</tr>'
                            );
                            no++;
                        });
                    }
                    else {
                        $('#tbl_list > tbody').append('<tr><td colspan="32">ไม่พบรายการ</td></tr>');
                    }
                }else{
                   swal('ไม่พบข้อมูล');
                }
            }
        });
    }

    $('#get_sign').on('click',function(e){
        e.preventDefault();
        var items={};
        var day_of_month=0;
        items.year=$('#sl_year').val();
        items.month = $('#sl_month').val();
        items.workgroup=$('#sl_workgroup').val();
        $('#tbl_list > thead').empty();

        day_of_month = app.daysInMonth(items.year+'-'+items.month);
        console.log(day_of_month);
        var txt_day ='';
        for(i=1;i<=day_of_month;i++){
            txt_day +='<th>'+i+'</th>';
        }
        $('#tbl_list > thead').append('' +
            '<tr>' +
            '<th>#</th>' +
            '<th>ชื่อสกุล</th><th>การจัดการ</th>' +txt_day+
            '</tr>');
        if (!items.year) {
            swal('กรุณาระบุ ปี');
            $('#sl_year').focus();
        } else if (!items.month) {
            swal('กรุณาระบุเดือน');
            $('#sl_month').focus();
        } else if (!items.workgroup) {
            swal('กรุณาระบุกลุ่มงาน');
            $('#sl_workgroup').focus();
        } else{
            sign.get_sign(items);
        }
    });


});