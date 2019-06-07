$(document).ready(function(){
    $("#btn_login").removeAttr("disabled");
    //User namespace
    var sign = {};
    var day_of_month=0;
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
                sign.set_sign(data);
            }
        });


    }
    sign.set_sign = function(data){
        //data = JSON.parse(data);
        console.log(data.success);
        if(data.success){
            //swal('Get Success');
            var no=1;
            $('#tbl_list > tbody').empty();
            if (_.size(data.rows) > 0) {
                _.each(data.rows, function (v) {
                    //v.sign_in = v.sign_in.replace('00:00:00','-');

                    var sign_work = v.date_work1.split(",");

                    var signin_txt='';

                    var txt_day='';
                    for(i=1;i<=day_of_month;i++){
                        txt_day +='<td style="font-size:10px;padding: 1px;margin: 2px;text-align:center;" data-day=U'+v.user_id+'D'+i+'>'+'x'+'</td>';
                        //console.log(txt_day);
                    }

                    $('#tbl_list > tbody').append(
                        '<tr data-id='+v.user_id+'>' +
                        '<td class="row">'+no+'</td>' +
                        '<td >' + v.name + '</td>' +
                        '<td style="font-size:10px;padding: 1px;margin: 2px">เวลามา<br>เวลากลับ<br>หมายเหตุ</td>' +
                        txt_day+
                        '</tr>'
                    );
                    for(i=0;i<sign_work.length;i++){
                        sign_work[i] = sign_work[i].replace(/00:00:00/g,'');
                        sign_work[i] = sign_work[i].replace(/:00/g,'');
                        sign_work[i]= sign_work[i].split("|");
                        signin_txt +='<div>'+sign_work[i][0]+'</div>';
                        //var td_target=$("tr").data("id")== ;
                        var id='U'+v.user_id+'D'+parseInt(sign_work[i][0]);
                        var target_td = $('td[data-day="'+id+'"]');
                        target_td.html(sign_work[i][1]+'<br>'+sign_work[i][2]+'<br>'+sign_work[i][3]);
                        //$('#tbl_list > tbody').append();
                    }


                    /*for(i=0;i<signin.length;i++){
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
*/

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

    $('#get_sign').on('click',function(e){
        e.preventDefault();
        var items={};

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