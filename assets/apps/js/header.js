$(function () {

    var header = {};
    header.ajax = {

        save_n_year: function(n_year, cb){
            var url = '/welcome/save_n_year',
            params = {
                n_year: n_year
            };

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
        }
    }


    $('#btn_save_n_year').on('click', function (e) {
        e.preventDefault();
        var n_year = $('#n_year').val()
        //alert(n_year);
        header.ajax.save_n_year(n_year, function (err, data) {

            if (err) {
                app.alert(err);
            }
            else {
                app.alert('เปลี่ยนแปลงเรียบร้อย');
                location.reload(); 
            }
        });
    });
  

});



