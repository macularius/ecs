// AJAX
    //Авторизация
    function auth() {
        $email = document.getElementById('inputEmail1').value;
        $password = document.getElementById('inputPassword1').value;

        authorisation($email, $password);
    }

    function authorisation($email, $password) {
        $.ajax ({
            url: "index.php",
            type: "POST",
            data: ({action: "authorisation", email: $email, password: $password}),
            dataType: "html",
            success: function(data){
                        alert(data);
                        //alert(data =='is login - true');
                        if (data =='is login - true') location.reload();
                        else document.getElementById('warning1').classList.toggle('d-none', false);
                    }
        });
    }

    //Регистрация
    function registration() {
        $email = document.getElementById('inputEmail2').value;
        $password = document.getElementById('inputPassword2').value;

        $.ajax ({
            url: "index.php",
            type: "POST",
            data: ({action: "registration", email: $email, password: $password}),
            dataType: "html",
            success: function(data){
                alert(data);
                // alert(data =='is login - true');
                if (data =='login is empty') authorisation($email, $password);
                else document.getElementById('warning2').classList.toggle('d-none', false);
            }
        });
    }
        function identicalPasswords() {
            $password1 = document.getElementById('inputPassword2').value;
            $password2 = document.getElementById('inputRepeatPassword2').value;

            if ($password1 == $password2 && $password1 != '') {
                document.getElementById('registration_submit').disabled = false;
                document.getElementById("warning on inputRepeatPassword2").classList.toggle('d-none', true);
            }
            else {
                document.getElementById('registration_submit').disabled = true;
                document.getElementById("warning on inputRepeatPassword2").classList.toggle('d-none', false);
            }
        }

// End AJAX


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
    deleteCookie('isLogin');
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

function addToCart(element) {
    document.getElementById("cart_button").classList.toggle("notification-anim", true);
    setTimeout(addToCartTemp, 500);

    var cartQuantity = getCookie('cart_quantity');
    // alert(cartQuantity);
    setCookie('cart_quantity',  Number(cartQuantity)+1, '/');

    var cartSum = getCookie('cart_sum');
    setCookie('cart_sum', Number(cartSum)+Number(element.dataset.cost));

    var cartGoods = getCookie('cart_goods');
    setCookie('cart_goods', cartGoods+','+element.dataset.id);
}
    function addToCartTemp() {
        document.getElementById("cart_button").classList.toggle("notification-anim", false);
    }

var showingTooltip;
document.onmouseover = function(e) {
    var target = e.target;

    var tooltip = target.getAttribute('data-tooltip');
    if (!tooltip) return;


    var tooltipElem = document.createElement('div');
    tooltipElem.className = 'notification';
    tooltipElem.innerHTML = 'в корзине '+getCookie('cart_quantity')+' ед. товара на сумму '+getCookie('cart_sum')+' ₽';
    document.body.appendChild(tooltipElem);

    var coords = target.getBoundingClientRect();

    var left = coords.left + (target.offsetWidth - tooltipElem.offsetWidth) / 2;
    if (left < 0) left = 0; // не вылезать за левую границу окна

    var top = coords.top - tooltipElem.offsetHeight - 5;
    if (top < 0) { // не вылезать за верхнюю границу окна
        top = coords.top + target.offsetHeight + 5;
    }

    tooltipElem.style.left = left + 'px';
    tooltipElem.style.top = top + 'px';

    showingTooltip = tooltipElem;
};
document.onmouseout = function(e) {
    if (showingTooltip) {

        document.body.removeChild(showingTooltip);
        showingTooltip = null;
    }
};

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
    function btnManagementOrders(showingElement) {
        document.getElementById('orders1').classList.toggle('active', false);
        document.getElementById('orders2').classList.toggle('active', false);
        document.getElementById('orders3').classList.toggle('active', false);

        document.getElementById('orders_orders1').classList.toggle('d-none', true);
        document.getElementById('orders_orders2').classList.toggle('d-none', true);
        document.getElementById('orders_orders3').classList.toggle('d-none', true);

        document.getElementById('orders_orders1').classList.toggle('d-block', false);
        document.getElementById('orders_orders2').classList.toggle('d-block', false);
        document.getElementById('orders_orders3').classList.toggle('d-block', false);

        showingElement.classList.toggle('active', true);
        document.getElementById('orders_'+showingElement.id).classList.toggle('d-none', false);
    }
    function btnManagementGoods(showingElement) {
        document.getElementById('goods1').classList.toggle('active', false);
        document.getElementById('goods2').classList.toggle('active', false);
        document.getElementById('goods3').classList.toggle('active', false);

        document.getElementById('goods_goods1').classList.toggle('d-none', true);
        document.getElementById('goods_goods2').classList.toggle('d-none', true);
        document.getElementById('goods_goods3').classList.toggle('d-none', true);

        document.getElementById('goods_goods1').classList.toggle('d-block', false);
        document.getElementById('goods_goods2').classList.toggle('d-block', false);
        document.getElementById('goods_goods3').classList.toggle('d-block', false);

        showingElement.classList.toggle('active', true);
        document.getElementById('goods_'+showingElement.id).classList.toggle('d-none', false);
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

// Cart
    document.onclick = function(e) {
        //alert('onclick');
        if (e.target.getAttribute('data-cart')=='clear') {
            clearCart();
        }

        if(!e.target.getAttribute('data-sign')) return;

        changeQuantity(e.target);
    }

    function clearCart(){
        if (document.getElementById('goods container') != null) {
            setCookie('cart_quantity', '0');
            setCookie('cart_sum', '0');
            setCookie('cart_goods', '-1');

            // Изменение итогового количества товаров
            document.getElementById('total quantity').innerHTML = '<b>'+0+' ед. товара</b>';

            // Изменение итоговой стоимости
            document.getElementById('total cost').innerHTML = '<b>Итого: '+0+' ₽</b>';

            document.getElementById('goods container').remove();
        }
    }

    function changeQuantity(element) {
        //alert(element.getAttribute('data-goods')+' '+element.getAttribute('data-sign'));

        switch(element.getAttribute('data-sign')){
            case '+':
                if (document.getElementById(element.getAttribute('data-goods')).value == 99) return;
                // Изменение количества в строке товара
                document.getElementById(element.getAttribute('data-goods')).value = Number(document.getElementById(element.getAttribute('data-goods')).value) + 1;

                // Изменение суммарной стоимости в строке товара
                document.getElementById('cost '+element.getAttribute('data-goods')).textContent = document.getElementById('cost '+element.getAttribute('data-goods')).textContent.replace(' ₽', '');
                sum = Number(document.getElementById('cost '+element.getAttribute('data-goods')).textContent) + Number(element.getAttribute('data-cost'));
                document.getElementById('cost '+element.getAttribute('data-goods')).textContent = sum+' ₽';

                // Изменение итогового количества товаров
                document.getElementById('total quantity').textContent = document.getElementById('total quantity').textContent.replace(' ед. товара', ''); // получаем число из итогового количества
                var sum = Number(document.getElementById('total quantity').textContent) + 1;
                document.getElementById('total quantity').innerHTML = '<b>'+sum+' ед. товара</b>';
                setCookie('cart_quantity', sum);

                // Изменение итоговой стоимости
                document.getElementById('total cost').textContent = document.getElementById('total cost').textContent.replace('Итого: ', '');  // получаем число из итоговой стоимости
                document.getElementById('total cost').textContent = document.getElementById('total cost').textContent.replace(' ₽', '');
                sum = Number(document.getElementById('total cost').textContent) + Number(element.getAttribute('data-cost'));
                document.getElementById('total cost').innerHTML = '<b>Итого: '+sum+' ₽</b>';
                setCookie('cart_sum', sum);

                // Добавление товара в массив товаров
                var goods = getCookie('cart_goods');
                var newGoods = goods+','+element.getAttribute('data-goods');
                setCookie('cart_goods', newGoods);
                break;
            case '-':
                if (document.getElementById(element.getAttribute('data-goods')).value == 1) return;
                // Изменение количества в строке товара
                document.getElementById(element.getAttribute('data-goods')).value = Number(document.getElementById(element.getAttribute('data-goods')).value) - 1;

                // Изменение суммарной стоимости в строке товара
                document.getElementById('cost '+element.getAttribute('data-goods')).textContent = document.getElementById('cost '+element.getAttribute('data-goods')).textContent.replace(' ₽', '');
                sum = Number(document.getElementById('cost '+element.getAttribute('data-goods')).textContent) - Number(element.getAttribute('data-cost'));
                document.getElementById('cost '+element.getAttribute('data-goods')).textContent = sum+' ₽';

                // Изменение итогового количества товаров
                document.getElementById('total quantity').textContent = document.getElementById('total quantity').textContent.replace(' ед. товара', ''); // получаем число из итогового количества
                var sum = Number(document.getElementById('total quantity').textContent) - 1;
                document.getElementById('total quantity').innerHTML = '<b>'+sum+' ед. товара</b>';
                setCookie('cart_sum', sum);

                // Изменение итоговой стоимости
                document.getElementById('total cost').textContent = document.getElementById('total cost').textContent.replace('Итого: ', '');
                document.getElementById('total cost').textContent = document.getElementById('total cost').textContent.replace(' ₽', '');
                var sum = Number(document.getElementById('total cost').textContent) - Number(element.getAttribute('data-cost'));
                document.getElementById('total cost').innerHTML = '<b>Итого: '+sum+' ₽</b>';
                setCookie('cart_sum', sum);

                // Удаление товара из массива товаров
                var goods = getCookie('cart_goods');
                var newGoods = goods.replace(','+element.getAttribute('data-goods'), '');
                setCookie('cart_goods', newGoods);
                break;
        }
    }
// End cart


// Cookie
    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function deleteCookie(name) {
        document.cookie = name+"=; path=/; expires=-1";
        // alert(document.cookie);
    }

    function setCookie(name, value) {

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        document.cookie = updatedCookie + "; path=/; expire=0;";
    }
// End cookie