function getDate(id) {
    var date = new Date;
    var annee = date.getFullYear();
    var moi = date.getMonth();
    var mois = Array('Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Spetembre', 'Octobre', 'Novembre', 'Décembre');
    var j = date.getDate();
    var jour = date.getDay();
    var jours = Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
    var h = date.getHours();
    if (h < 10) {
        h = "0" + h;
    }
    var m = date.getMinutes();
    if (m < 10) {
        m = '0' + m;
    }
    var s = date.getSeconds();
    var resultat = jours[jour] + ' ' + j + ' ' + mois[moi] + ' ' + annee + " " + h + ':' + m;
    document.getElementById(id).innerHTML = resultat;
    setTimeout('getDate("' + id + '")', 1000);
    return true;
}


$(document).ready(function () {


    $.ajax({
        url: 'graph_barre.php', // La ressource ciblée
        type: 'GET', // Le type de la requête HTTP.
        dataType: 'json',
        success: function (data) {
            if (data[0] > 0) {
                $('.content_graph_barre .free_barre').css('flex', data[0]);
            }
            if (data[1] > 0) {
                $('.content_graph_barre .occuped_barre').css('flex', data[1]);
            }
            if (data[2] > 0) {
                $('.content_graph_barre .clear_barre').css('flex', data[2]);
            }
            if (data[3] > 0) {
                $('.content_graph_barre .disable_barre').css('flex', data[3]);
            }
        },
        error: function () {

        }
    });

    $('.drop_item').click(function(){
        var btn = $('.dropbtn');
        btn.text($(this).text());
        btn.removeClass('arrow');

        $.ajax({
            url: 'stockdash.php', // La ressource ciblée
            type: 'GET', // Le type de la requête HTTP.
            data: 'stock='+ this.dataset.value,
            dataType: 'json',

            success: function(data){
                var stock = '';

                for(var cmp=0;cmp<data.length;cmp++){

                     stock += '<div><span>'+data[cmp]["nom"]+'</span><span>'+data[cmp]["stock"]+'</span></div>';
                }

                $('#stock_content').html(stock);
            },
            error: function(){
            }
        });
    });


    if ($('.error').length > 0) {
        var inter = setInterval(function () {
            $('.error').hide('fast');
            clearInterval(inter);
        }, 10000);
        $('.error').click(function(){
            $('.error').hide('fast');
        });
    }

    $('#burger').click(function () {
        var elem = $('.aside nav ul');

        if(elem.css('display') == 'none') {
           elem.css('display','flex');
           elem.css('height','100%');
        }else{
           elem.hide();
        }
    });



});
/*DASHBOARD */
function dropdown() {
    document.getElementById("myDropdownn").classList.toggle("show");
    document.getElementById("dropbtn").classList.toggle("arrow");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {

        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
};


