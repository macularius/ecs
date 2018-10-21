


function sselect(element) {
    if(element.className.indexOf(" selected") == -1) {

        // window.location.replace("http://ecs/catalog/"+element.id.replace('sidebar_btn_', ''));


        //  AJAX запрос на обновление тега 'content'

        var request = new XMLHttpRequest();
        // вызов методов контроллера, возвращающих только контент, вида [controller]/actionContent

        // alert(window.location.href);


        request.open('GET','http://ecs/catalog/'+element.id.replace('sidebar_btn_', ''),true);
        request.addEventListener('readystatechange', function() {
            // если состояния запроса 4 и статус запроса 200 (OK)
            if ((request.readyState==4) && (request.status==200)) {
                alert(request.responseText);

                var content = document.getElementById('content');

                document.body.innerHTML = request.responseText;
            }
        });
        request.send()

    }
}

function showMore(element) {
    // alert(element.id);
    document.getElementById(+element.id.replace(" more_btn", '')+15).style.display = '';
    element.parentNode.removeChild(element);
}


function point(element) {
    if(element.className.indexOf(" pointed") == -1) element.className += " pointed";
}

function unpoint(element) {
    if(element.className.indexOf(" pointed") != -1) element.className = element.className.replace(" pointed", "");
}