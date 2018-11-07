function select(element) {
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
    if (document.body.clientWidth > 768){
        if(element.className.indexOf(" pointed") == -1) element.className += " pointed";
    }
}

function unpoint(element) {
    if(element.className.indexOf(" pointed") != -1) element.className = element.className.replace(" pointed", "");
}

function dropdownBtn(element) {
    if(document.getElementById('dropdown content').style.display == 'none') document.getElementById('dropdown content').style.display = 'block';
    else document.getElementById('dropdown content').style.display = 'none';
}
function dropdownBtnCatigories(element) {
    if(document.getElementById('categories').style.display == 'none') document.getElementById('categories').style.display = 'block';
    else document.getElementById('categories').style.display = 'none';
}

function enterOrReg(element) {
    document.getElementById('authorisation').classList.toggle('d-none');
    document.getElementById('authorisation').classList.toggle('d-block');

    document.getElementById('registration').classList.toggle('d-none');
    document.getElementById('registration').classList.toggle('d-block');
}

function exit(element) {
    deleteCookie('login');
    deleteCookie('password');
    deleteCookie('role');
    location.reload();
}

function reload() {
    // alert('reload');
    location.reload();
}

function showOrHiddenAuth() {
    // alert(document.cookie);
    if (getCookie('login') != "" && getCookie('login') != undefined){
        // alert('if');
        document.getElementById('authorisation').classList.toggle('d-none');
        document.getElementById('authorisation').classList.toggle('d-block');

        document.getElementById('exit').classList.toggle('d-none');
        document.getElementById('exit').classList.toggle('d-block');

        document.getElementById('authorisation field').classList.toggle('d-none');
        document.getElementById('authorisation field').classList.toggle('d-block');
    }
    else {
        // alert('else');
        document.getElementById('authorisation field').classList.toggle('d-none');
        document.getElementById('authorisation field').classList.toggle('d-block');
    }
}

// Management
    function managementSwitcher(btn) {
        group = btn.id.replace('Btn', '');

        // alert(group);

        switch(group) {
            case 'goods':
                element = document.getElementById('goods1');
                // alert(element.id);
                break;
            case 'orders':
                element = document.getElementById('orders1');
                // alert(element.id);
                break;
            case 'members':
                element = document.getElementById('members1');
                // alert(element.id);
                break;
        };


        showManagementBtn(btn);
        btnManagement(element, group);
    }

    function btnManagement(element, group) {
        // alert(element.id);

        switch(group) {
            case 'orders':
                // alert(group);
                showEditedField('orders_'+element.id);
                document.getElementById('orders1').classList.toggle('active', false);
                document.getElementById('orders2').classList.toggle('active', false);
                document.getElementById('orders3').classList.toggle('active', false);
                break;
            case 'goods':
                // alert(group);
                showEditedField('goods_'+element.id);
                document.getElementById('goods1').classList.toggle('active', false);
                document.getElementById('goods2').classList.toggle('active', false);
                document.getElementById('goods3').classList.toggle('active', false);
                break;
            case 'members':
                // alert(group);
                showEditedField('members_'+element.id);
                document.getElementById('members1').classList.toggle('active', false);
                document.getElementById('members2').classList.toggle('active', false);
                document.getElementById('members3').classList.toggle('active', false);
                break;
        }


        element.classList.toggle('active', true);
    }

    function showEditedField(showingElement){
        // alert(showingElement);

        document.getElementById('goods_goods1').classList.toggle('d-block', false);
        document.getElementById('goods_goods2').classList.toggle('d-block', false);
        document.getElementById('goods_goods3').classList.toggle('d-block', false);
        document.getElementById('orders_orders1').classList.toggle('d-block', false);
        document.getElementById('orders_orders2').classList.toggle('d-block', false);
        document.getElementById('orders_orders3').classList.toggle('d-block', false);
        document.getElementById('members_members1').classList.toggle('d-block', false);
        document.getElementById('members_members2').classList.toggle('d-block', false);
        document.getElementById('members_members3').classList.toggle('d-block', false);

        document.getElementById('goods_goods1').classList.toggle('d-none', true);
        document.getElementById('goods_goods2').classList.toggle('d-none', true);
        document.getElementById('goods_goods3').classList.toggle('d-none', true);
        document.getElementById('orders_orders1').classList.toggle('d-none', true);
        document.getElementById('orders_orders2').classList.toggle('d-none', true);
        document.getElementById('orders_orders3').classList.toggle('d-none', true);
        document.getElementById('members_members1').classList.toggle('d-none', true);
        document.getElementById('members_members2').classList.toggle('d-none', true);
        document.getElementById('members_members3').classList.toggle('d-none', true);

        document.getElementById(showingElement).classList.toggle('d-block', true);
        document.getElementById(showingElement).classList.toggle('d-none', false);
    }

    function showManagementBtn(btn) {
        document.getElementById('goodsBtn').classList.toggle('active', false);
        document.getElementById('ordersBtn').classList.toggle('active', false);
        document.getElementById('membersBtn').classList.toggle('active', false);

        document.getElementById('goods').classList.toggle('d-block', false);
        document.getElementById('orders').classList.toggle('d-block', false);
        document.getElementById('members').classList.toggle('d-block', false);

        document.getElementById('goods').classList.toggle('d-none', true);
        document.getElementById('orders').classList.toggle('d-none', true);
        document.getElementById('members').classList.toggle('d-none', true);

        document.getElementById(btn.id.replace('Btn', '')).classList.toggle('d-block', true);
        btn.classList.toggle('active', true);
    }
// End Management



// Cookie
    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function deleteCookie(name) {
        document.cookie = name+"= ; expires=-1";
        // alert(document.cookie);
    }

    function setCookie(name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    }
// End cookie