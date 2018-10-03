var userid = 0;
var userlogdata = '';
$(document).ready(function() {
    $('.filename').bind('change', function() {
        var fileSize = this.files[0].size / 1024 / 1024;
        if (fileSize > 20) { // 20мб
            noty({
                text: 'Выбранный вами файл превышает максимально допустимые размеры!!!'
            });
            $('.filename').val('');
        }
    });
    $('#downbtn').bind('click', function() {
        noty({
            text: 'Подождите полной загрузки всех данных, не закрывайте страницу.'
        });
    });
    $('#regbtn').bind('click', function() {
        $.post('/core/controllers/AuthController.php', {
                'reg_login': $('#login').val(),
                'reg_password': $('#reg_password').val(),
                'role': $('#role').val(),
                'password2': $('#password2').val()
            },
            function(data) {
                regus = JSON.parse(data);
                if (regus.cant == "absolutlyNO") {
                    noty({
                        text: 'Регистрация невозможна, проверьте данные, и повторите попытку!!!'
                    });
                    $("#regbtn").attr('disabled', true);
                } else {
                    noty({
                        text: 'Успешная регистрация!!!'
                    });
                    setTimeout(function() {
                        document.location.reload(true);
                    }, 1500);
                }
            });

    });


    $('#authbtn').bind('click', function() {
        $.post('/core/controllers/AuthController.php', {
                'authlogin': $('#authlogin').val(),
                'pass': $('#pass').val()
            },
            function(data) {
                result = JSON.parse(data);
                if (result.name == "true") {
                    document.location.reload(true);
                } else if (result.name == "false") {
                    noty({
                        text: 'Вы ввели неверный логин или пароль. Вход невозможен!!!'
                    });
                }
            });
    });

    $('#load-data').bind('click', function() {
        if ($('#userload').val() == '') {
            $('.userloaderror').text('Поле не может быть пустым!!!').css('color', 'red');
            $('#edit-data').attr('disabled', true);
            $('#delete-data').attr('disabled', true);
        } else {
            $.post('/core/controllers/AJAXController.php', {
                    'userdata': $('#userload').val()
                },
                function(data) {
                    dataparse = JSON.parse(data);
                    if (dataparse.id == 'no') {
                        $('.userloaderror').text('Такой пользователь не найден в Базе данных').css('color', 'red');
                        $('#edit-data').attr('disabled', true);
                        $('#delete-data').attr('disabled', true);
                    } else {
                        $('.userloaderror').text('');
                        $('#edit-data').attr('disabled', false);
                        $('#delete-data').attr('disabled', false);
                        $('#username').attr('disabled', false);
                        $('#userole').attr('disabled', false);
                        $('#userid').val(dataparse.id);
                        userid = dataparse.id;
                        userlogdata = dataparse.username;
                        $('#username').val(dataparse.username);
                        if (dataparse.rank == 1) {
                            rank = 'Студент'
                        } else if (dataparse.rank == 2) {
                            rank = 'Учитель'
                        } else {
                            rank = 'Администратор'
                        }
                        $('#userole').val(rank);
                    }
                });

        }
    });

    $('#edit-data').bind('click', function() {
        var userrole = 0;
        if ($('#userole').val().toLowerCase() == 'студент') {
            userrole = 1
        } else if ($('#userole').val().toLowerCase() == 'учитель') {
            userrole = 2
        } else {
            userrole = 3
        };
        if (($('#userole').val().toLowerCase() !== 'студент') && ($('#userole').val().toLowerCase() !== 'учитель') && ($('#userole').val().toLowerCase() !== 'администратор')) {
            $('.userolerror').text('Такой роли не существует').css('color', 'red')
        };
        if ($('.userloaderror').val() == '') {
            if ($('.userolerror').val() == '') {
                noty({
                    text: 'Вы уверенны что хотите продолжить редактирование?',
                    buttons: [{
                            addClass: 'btn btn-primary',
                            text: 'Да',
                            onClick: function($noty) {
                                console.log($noty.$bar.find('input#example').val());
                                $noty.close();
                                $.post('/core/controllers/AuthController.php', {
                                        'login': $('#username').val(),
                                        'rolework': userlogdata,
                                    },
                                    function(data) {
                                        haveuser = JSON.parse(data);
                                        if (haveuser.haveinDB == "no") {
                                            $('.userloaderror').text("Изменемый вами логин занят,измените на другой!!!").css("color", "red").fadeIn(400);
                                        } else {
                                            $('.userloaderror').text('');
                                            $.post('/core/controllers/AJAXController.php', {
                                                    'edituserid': userid,
                                                    'editusername': $('#username').val(),
                                                    'edituserrole': userrole
                                                },
                                                function(data) {
                                                    dataparse = JSON.parse(data);
                                                    if (dataparse.ok == 'AllOk') {
                                                        noty({
                                                            text: 'Данные успешно отредактированы'
                                                        });
                                                        $('#userid').val('');
                                                        $('#username').val('');
                                                        $('#userole').val('');
                                                        $('#edit-data').attr('disabled', true);
                                                        $('#delete-data').attr('disabled', true);
                                                    } else {
                                                        noty({
                                                            text: 'Неудача, обратитесь к системному администратору.'
                                                        });
                                                    }
                                                });
                                        }
                                    });

                            }
                        },
                        {
                            addClass: 'btn btn-danger',
                            text: 'Отмена',
                            onClick: function($noty) {
                                noty({
                                    text: 'Вы отменили редактирование'
                                });
                                $noty.close();
                            }
                        }
                    ]
                });
            }
        }
    });
    $('#delete-data').bind('click', function() {
        if (($('#userid').vall == '') || ($('#username').val() == '') || ($('#userole').val() == '')) {
            noty({
                text: "Нечего удалять("
            })
        } else {
            noty({
                text: 'Вы уверенны что хотите удалить данного пользователя?',
                buttons: [{
                        addClass: 'btn btn-primary',
                        text: 'Да',
                        onClick: function($noty) {
                            console.log($noty.$bar.find('input#example').val());
                            $noty.close();
                            $.post('/core/controllers/AJAXController.php', {
                                    'deleteuserid': userid
                                },
                                function(data) {
                                    dataparse = JSON.parse(data);
                                    if (dataparse.deleted == 'UserDeleted') {
                                        noty({
                                            text: 'Данные успешно удалены!'
                                        });
                                        $('#userid').val('');
                                        $('#username').val('');
                                        $('#userole').val('');
                                        $('#edit-data').attr('disabled', true);
                                        $('#delete-data').attr('disabled', true);
                                    } else {
                                        noty({
                                            text: 'Неудача, обратитесь к системному администратору.'
                                        });
                                    }
                                });
                        }
                    },
                    {
                        addClass: 'btn btn-danger',
                        text: 'Отмена',
                        onClick: function($noty) {
                            noty({
                                text: 'Удаление отменено'
                            });
                            $noty.close();
                        }
                    }
                ]
            });
        }

    });

    $('#userload').keydown(function() {
        $('.userloaderror').text('');
    });

    $('#userole').keydown(function() {
        $('.userolerror').text('');
    });
});

$(function() {
    $('#userload').keyup(function() {
        $('#edit-data').attr('disabled', true);
        $('#delete-data').attr('disabled', true);
        $('#username').attr('disabled', true);
        $('#userole').attr('disabled', true);
    });
});
$(function() {
    $("#login").keyup(function() {
        login = $("#login").val();
        testLogin(login);
        ButtonOnOff();
    });
    $("#reg_password").keyup(function() {
        checkPassword();
        ButtonOnOff();
        if ($('#reg_password').val() !== $('#password2').val()) {
            $('.condoerror').text('Пароли не совпадают').css('color', 'red');
            $("#regbtn").attr('disabled', true);
        } else {
            $('.condoerror').text('');
            ButtonOnOff();
        }
    });
    $("#password2").keyup(function() {
        if ($('#reg_password').val() !== $('#password2').val()) {
            $('.condoerror').text('Пароли не совпадают').css('color', 'red');
            $("#regbtn").attr('disabled', true);
        } else {
            $('.condoerror').text('');
            ButtonOnOff();
        }
    });
});

function ButtonOnOff() {
    if (($('.condoerror').text() == '') && ($('.passerror').text() == '') && ($('.loginerror').text() == '')) {
        if (($('#login').val() !== '') && ($('#reg_password').val() !== '') && ($('#password2').val() !== '')) {
            $("#regbtn").attr('disabled', false);
        }
    }
}

function testLogin(login) {
    if (/^[a-zA-Z0-9]+$/.test(login) === false) {
        $('.loginerror').text('В логине должны быть только латинские буквы');
        $("#regbtn").attr('disabled', true);
        return false;
    } else if (login.length < 4 || login.length > 20) {
        $('.loginerror').text('В логине должно быть от 4 до 20 символов');
        $("#regbtn").attr('disabled', true);
        return false;
    } else if (parseInt(login.substr(0, 1))) {
        $('.loginerror').text('Логин должен начинаться с буквы');
        $("#regbtn").attr('disabled', true);
        return false;
    } else {
        $.post('/core/controllers/AuthController.php', {
                'login': $('#login').val()
            },
            function(data) {
                haveuser = JSON.parse(data);
                if (haveuser.haveinDB == "no") {
                    $('.loginerror').text("Логин занят").css("color", "red").fadeIn(400);
                    $("#regbtn").attr('disabled', true);
                } else {
                    $('.loginerror').text('');
                    return true;
                }
            });
    }
}

function checkPassword() {
    var password = $('#reg_password').val(); // Получаем пароль из формы
    var s_letters = "qwertyuiopasdfghjklzxcvbnm"; // Буквы в нижнем регистре
    var b_letters = "QWERTYUIOPLKJHGFDSAZXCVBNM"; // Буквы в верхнем регистре
    var digits = "0123456789"; // Цифры
    var specials = "!@#$%^&*()_-+=\|/.,:;[]{}"; // Спецсимволы
    var is_s = false; // Есть ли в пароле буквы в нижнем регистре
    var is_b = false; // Есть ли в пароле буквы в верхнем регистре
    var is_d = false; // Есть ли в пароле цифры
    var is_sp = false; // Есть ли в пароле спецсимволы
    for (var i = 0; i < password.length; i++) {
        /* Проверяем каждый символ пароля на принадлежность к тому или иному типу */
        if (!is_s && s_letters.indexOf(password[i]) != -1) is_s = true;
        else if (!is_b && b_letters.indexOf(password[i]) != -1) is_b = true;
        else if (!is_d && digits.indexOf(password[i]) != -1) is_d = true;
        else if (!is_sp && specials.indexOf(password[i]) != -1) is_sp = true;
    }
    var rating = 0;
    var text = "";
    if (is_s) rating++; // Если в пароле есть символы в нижнем регистре, то увеличиваем рейтинг сложности
    if (is_b) rating++; // Если в пароле есть символы в верхнем регистре, то увеличиваем рейтинг сложности
    if (is_d) rating++; // Если в пароле есть цифры, то увеличиваем рейтинг сложности
    if (is_sp) rating++; // Если в пароле есть спецсимволы, то увеличиваем рейтинг сложности
    /* Далее идёт анализ длины пароля и полученного рейтинга, и на основании этого готовится текстовое описание сложности пароля */
    if (password.length < 6 && rating < 3) text = "Простой";
    else if (password.length < 6 && rating >= 3) text = "Средний";
    else if (password.length >= 8 && rating < 3) text = "Средний";
    else if (password.length >= 8 && rating >= 3) text = "Сложный";
    else if (password.length >= 6 && rating == 1) text = "Простой";
    else if (password.length >= 6 && rating > 1 && rating < 4) text = "Средний";
    else if (password.length >= 6 && rating == 4) text = "Сложный";
    if ((text == 'Сложный') || (text == 'Средний')) {
        $('.passerror').text('');
        return true;
    } else {
        $('.passerror').text('Слишком простой пароль').css('color', 'red');
        $("#regbtn").attr('disabled', true);
        return false; // Форму не отправляем
    }
}

jQuery(function() {
    $('#add_stud').bind('click', function() {
        if (($('#stud_class').val() <= 11) && ($('#stud_class').val() >= 1) && ($('#addDate').val() <= 2050) && ($('#addDate').val() >= 2018) && ($('#stud_numb').val() >= 1) && ($('#stud_numb').val() <= 100)) {
            $.post('/core/controllers/AJAXController.php', {
                    'addstudent': '',
                    'class': $('#stud_class').val(),
                    'date': $('#addDate').val(),
                    'amount': $('#stud_numb').val()
                },
                function(data) {
                    resultbyadd = JSON.parse(data);
                    if (resultbyadd.studadd == "success") {
                        noty({
                            text: 'Изменения произведены!'
                        });
                        $('#stud_class').val('');
                        $('#stud_numb').val('');
                    } else {
                        noty({
                            text: 'Произошла ошибка, обновите страницу, и повторите снова.'
                        });
                    }
                });
        } else {
            noty({
                text: 'Вы ввели некорректные данные!'
            });
        }
    });
});
jQuery(function() {
    $('#del_stud').bind('click', function() {
        if (($('#stud_class').val() <= 11) && ($('#stud_class').val() >= 1) && ($('#addDate').val() <= 2050) && ($('#addDate').val() >= 2018) && ($('#stud_numb').val() >= 1) && ($('#stud_numb').val() <= 100)) {
            $.post('/core/controllers/AJAXController.php', {
                    'addstudent': '',
                    'class': $('#stud_class').val(),
                    'date': $('#addDate').val(),
                    'amount': -$('#stud_numb').val()
                },
                function(data) {
                    resultbyadd = JSON.parse(data);
                    if (resultbyadd.studadd == "success") {
                        noty({
                            text: 'Изменения произведены!'
                        });
                        $('#stud_class').val('');
                        $('#stud_numb').val('');
                    } else {
                        noty({
                            text: 'Удаляемое вами количество учеников превышает общее количество учеников в данных классах.'
                        });
                    }
                });
        } else {
            noty({
                text: 'Вы ввели некорректные данные!'
            });
        }
    });
});
//watch
jQuery(function() {
    $('.watchhref').bind('click', function() {
        var book = decodeURIComponent(getUrlVars()["book"]).replace(/\+/g, ' ').replace(/\./g, '.');
        4
        var bookauthor = decodeURIComponent(getUrlVars()["bookauthor"]).replace(/\+/g, ' ').replace(/\./g, '.');
        $.post('/core/controllers/UserController.php', {
                'inc': 'inc',
                'book': book,
                'bookauthor': bookauthor,
            },
            function(data) {});
    });
});

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
    return vars;
}
//generate
jQuery(function() {
    $('#generate').bind('click', function() {
        $('#reg_password').attr('type', 'text');
        $('#password2').attr('type', 'text');
        $('#login').val(randomString(10));
        $('#reg_password').val(randomString(10));
        $('#password2').val($('#reg_password').val());
    });
});
jQuery(function() {
    $('#reg_password').on('keyup', function() {
        $('#reg_password').attr('type', 'password');
        $('#password2').attr('type', 'password');
    });
});
jQuery(function() {
    $('#password2').on('keyup', function() {
        $('#reg_password').attr('type', 'password');
        $('#password2').attr('type', 'password');
    });
});
//
jQuery(function() {
    $('#generate').bind('click', function() {
        $('#reg_password').attr('type', 'text');
        $('#password2').attr('type', 'text');
        $('#login').val(randomString(10));
        $('#reg_password').val(randomString(10));
        $('#password2').val($('#reg_password').val());
        $('.loginerror').text('');
        $('.passerror').text('');
        $('.condoerror').text('');
        testLogin($('#login').val());
        checkPassword();
        ButtonOnOff();
    });
});
jQuery(function() {
    $('#add_work').bind('click', function() {
        if (($('#work_class').val() <= 11) && ($('#work_class').val() >= 1) && ($('#subject').val() !== '') && ($('#year_add').val() <= 2050) && ($('#year_add').val() >= 2000) && ($('#shelf_life').val() <= 20) && ($('#shelf_life').val() >= 1)) {
            $.post('/core/controllers/AJAXController.php', {
                    'addworkbook': '',
                    'work_class': $('#work_class').val(),
                    'author': $('#author').val(),
                    'subject': $('#subject').val(),
                    'year_add': $('#year_add').val(),
                    'shelf_life': $('#shelf_life').val(),
                    'publishing': $('#publishing').val(),
                    'amount': $('#amount').val()
                },
                function(data) {
                    workbyadd = JSON.parse(data);
                    if (workbyadd.worked == "success") {
                        noty({
                            text: 'Успешное добавление!'
                        });
                        $('#work_class').val('');
                        $('#author').val('');
                        $('#subject').val('');
                        $('#year_add').val('');
                        $('#shelf_life').val('');
                        $('#publishing').val('');
                        $('#amount').val('');
                    } else {
                        noty({
                            text: 'Произошла ошибка при добавлении!'
                        });
                    }
                });
        } else {
            noty({
                text: 'Вы ввели некорректные данные!'
            });
        }
    });
});

function randomString(len, an) {
    an = an && an.toLowerCase();
    var str = "",
        i = 0,
        min = an == "a" ? 10 : 0,
        max = an == "n" ? 10 : 62;
    for (; i++ < len;) {
        var r = Math.random() * (max - min) + min << 0;
        str += String.fromCharCode(r += r > 9 ? r < 36 ? 55 : 61 : 48);
    }
    return str;
}
/*footer*/
function footerToBottom() {
    var browserHeight = $(window).height(),
        footerOuterHeight = $('footer').outerHeight(true),
        mainHeightMarginPaddingBorder = $('main').outerHeight(true) - $('main').height() + 72;
    $('main').css({
        'min-height': browserHeight - footerOuterHeight - mainHeightMarginPaddingBorder,
    });
};

footerToBottom();
$(window).resize(function() {
    footerToBottom();
});
/*var xhr = new XMLHttpRequest();
xhr.upload.onprogress = function(event) {
    alert('Загружено на сервер ' + event.loaded + ' байт из ' + event.total);
}
*/