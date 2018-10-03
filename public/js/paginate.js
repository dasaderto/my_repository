var lmt=3;
callJSON();
var thispage=1;
//returndata();
function returndata(sortauthor){
    var cat=decodeURIComponent(getUrlVars()["cat"]).replace(/\+/g,' ').replace(/\./g,'.');
    var authors=decodeURIComponent(getUrlVars()["authors"]).replace(/\+/g,' ').replace(/\./g,'.');
    var classes=decodeURIComponent(getUrlVars()["class"]).replace(/\+/g,' ').replace(/\./g,'.');
    var ask=decodeURIComponent(getUrlVars()["search_list"]).replace(/\+/g,' ').replace(/\./g,'.');
    var getpages=sortauthor;
        if (ask==='undefined'){ask='';}
        if (cat==='undefined'){cat='';}
        if (classes==='undefined'){classes='';}
        if (authors==='undefined'){authors='';}
        $.get('/core/controllers/PaginateController.php', 
            {'getpages': getpages,'class':classes,'cat':cat,'search_list':ask,'authors':authors,},
            function(data) {

                callJSON();}
        );
}

function getData(dataparse){
    var details='/details/';
    var category='/category/';
    for (var key in data) {
        if(key==lmt-1) break;
        var uniqkey=Math.floor(Math.random()*100);
        var item = data[key];
        $( ".somebook" ).append( "<div class='newbook newbook"+item.id+uniqkey+"'></div>" );
        if((item.img==null)||(item.img=="NULL")) item.img='DefaultBook.jpg';
        $( ".newbook"+item.id+uniqkey ).append("<img alt='"+item.img+"' height='104' src='/public/img/Books/"+item.img+"' width='65'>");
        $( ".newbook"+item.id+uniqkey ).append("<h3 class='"+item.id+uniqkey+"'></h3>");
        $( "h3."+item.id+uniqkey).append("<i class='fa fa-book'></i>");
        $( "h3."+item.id+uniqkey).append("<a href="+details+"?book="+encoded(item.name)+"&bookauthor="+encoded(item.author)+">"+item.name+"</a>");
        $( ".newbook"+item.id+uniqkey ).append("<span class='author-title author"+item.id+uniqkey+"'>");
        $( "span.author"+item.id+uniqkey).append("<i class='fa fa-user'></i><b>Автор:</b>");
        $( "span.author"+item.id+uniqkey).append("<a href='"+category+"author-"+encoded(item.author)+"'> "+item.author+"</a>");
        $( ".newbook"+item.id+uniqkey ).append("<span class='author-title add"+item.id+uniqkey+"'>");
        $( "span.add"+item.id+uniqkey).append("<i class='fa fa-calendar'></i><b>Добавлено:</b> "+item.date);
        $( ".newbook"+item.id+uniqkey ).append("<span class='about"+item.id+uniqkey+"'>");
        $( "span.about"+item.id+uniqkey).append(item.about);
    }
}
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

function encoded(value){
    return encodeURIComponent(value).replace(/%20/g,'+').replace(/\./g,'.');
}

function paggination(){
    returndata(thispage);
}

function changeHash(page) {
var address=window.location.href.substr(0,window.location.href.indexOf('page=')-1)
    try 
    {
       history.replaceState(null,null,address+'&page='+ page);
    }
    catch(e) 
    {
       location.hash = '#page-'+page;
    }

}

jQuery(function() {
    $('.bootpag li').bind('click',function(){
        thispage=$('.activepage').text();
    });
});
function callJSON(){
    $.getJSON( "/public/libs/content.json", function( data ) {
        $('.newbook').remove();
         $('.pagination').css('display','block');
        if((data=='') && (location.toString().indexOf('/search/')<0)){ 
             $('.categoryttl').html('Таких данных не существует, либо у вас нет доступа!');
             //$('.author_sort').css('display','none');
             $('.pagination').css('display','none');
             $( ".somebook" ).append( "<div class='newbook'>Ничего нет...</div>" );
        }else if((data=='') && (location.toString().indexOf('/search/')>=0)){
            $( ".somebook" ).append( "<div class='newbook'>По вашему запросу ничего не найдено!!!</div>" );
            //$('.author_sort').css('display','none');
            $('.pagination').css('display','none');
        }else{
            if (data==null){
                $( ".somebook" ).append( "<div class='newbook'>Поступили некорректные данные...</div>" );
                $('.categoryttl').html('Ошибка! Данные отсутствуют');
                $('.author_sort').css('display','none');
            }else if(location.toString().indexOf('category/?author')>0){
                $('.categoryttl').html('Книги автора: '+data[0].author);
                $('.author_sort').css('display','none');
            }else if(location.toString().indexOf('/search/')>0){
                $('.categoryttl').html('Результаты поиска');
            }else{$('.categoryttl').html(data[0].category);}
        }
     thispage=$('.activepage').text();
     if ((thispage<=0)||(thispage=='undefined')) {activepage=1;}else{activepage=thispage;}
     var start = activepage * lmt - lmt;
     var details='/details/';
     var category='/category/';
     for (var key in data) {
        if (key>=start){
            if(key==start+lmt) break;
            var uniqkey=Math.floor(Math.random()*100);
            var item = data[key];
            $( ".somebook" ).append( "<div class='newbook newbook"+key+uniqkey+"'></div>" );
            if((item.img==null)||(item.img=="NULL")) item.img='DefaultBook.jpg';
            $( ".newbook"+key+uniqkey ).append("<img alt='"+item.img+"' height='104' src='/public/img/Books/"+item.img+"' width='65'>");
            $( ".newbook"+key+uniqkey ).append("<h3 class='"+key+uniqkey+"'></h3>");
            $( "h3."+key+uniqkey).append("<i class='fa fa-book'></i>");
            $( "h3."+key+uniqkey).append("<a href="+details+"?book="+encoded(item.name)+"&bookauthor="+encoded(item.author)+">"+item.name+"</a>");
            $( ".newbook"+key+uniqkey).append("<span class='author-title author"+key+uniqkey+"'>");
            $( "span.author"+key+uniqkey).append("<i class='fa fa-user'></i><b>Автор:</b>");
            $( "span.author"+key+uniqkey).append("<a href='"+category+"author-"+encoded(item.author)+"'> "+item.author+"</a>");
            $( ".newbook"+key+uniqkey ).append("<span class='author-title add"+key+uniqkey+"'>");
            $( "span.add"+key+uniqkey).append("<i class='fa fa-calendar'></i><b>Добавлено:</b> "+item.date);
            $( ".newbook"+key+uniqkey ).append("<span class='about"+key+uniqkey+"'>");
            $( "span.about"+key+uniqkey).append(item.about);
            $( ".newbook"+key+uniqkey ).append("<span class='views"+key+uniqkey+"'><br>");
            $( "span.views"+key+uniqkey).append("<span><font color='#6f6f6f'><i class='fa fa-eye'></i>Просмотрено "+item.viewed+" раз</font></span>");
        }
    }
    countpages=Math.ceil((Object.keys(data).length)/lmt);
    $('.pagination').bootpag({
        total: countpages,
        page: 1,
        maxVisible: 3,
        leaps: true,
        firstLastUse: true,
        first: 'Первая',
        last: 'Последняя',
        wrapClass: 'pagination',
        activeClass: 'active activepage',
        disabledClass: 'disabled',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first'
    }).on("page", function(event){
        $('.newbook').remove();
        thispage=$('.activepage').text();
        if ((thispage<=0)||(thispage=='undefined')) {activepage=1;}else{activepage=thispage;}
        var start = activepage * lmt - lmt;
        changeHash(activepage);
        var details='/details/';
        var category='/category/';
        for (var key in data) {
            if (key>=start){
                if(key==start+lmt) break;
                var uniqkey=Math.floor(Math.random()*100);
                var item = data[key];
                $( ".somebook" ).append( "<div class='newbook newbook"+key+uniqkey+"'></div>" );
                if((item.img==null)||(item.img=="NULL")) item.img='DefaultBook.jpg';
                $( ".newbook"+key+uniqkey ).append("<img alt='"+item.img+"' height='104' src='/public/img/Books/"+item.img+"' width='65'>");
                $( ".newbook"+key+uniqkey ).append("<h3 class='"+key+uniqkey+"'></h3>");
                $( "h3."+key+uniqkey).append("<i class='fa fa-book'></i>");
                $( "h3."+key+uniqkey).append("<a href="+details+"?book="+encoded(item.name)+"&bookauthor="+encoded(item.author)+">"+item.name+"</a>");
                $( ".newbook"+key+uniqkey).append("<span class='author-title author"+key+uniqkey+"'>");
                $( "span.author"+key+uniqkey).append("<i class='fa fa-user'></i><b>Автор:</b>");
                $( "span.author"+key+uniqkey).append("<a href='"+category+"author-"+encoded(item.author)+"'> "+item.author+"</a>");
                $( ".newbook"+key+uniqkey ).append("<span class='author-title add"+key+uniqkey+"'>");
                $( "span.add"+key+uniqkey).append("<i class='fa fa-calendar'></i><b>Добавлено:</b> "+item.date);
                $( ".newbook"+key+uniqkey ).append("<span class='about"+key+uniqkey+"'>");
                $( "span.about"+key+uniqkey).append(item.about);
                $( ".newbook"+key+uniqkey ).append("<span class='views"+key+uniqkey+"'><br>");
            $( "span.views"+key+uniqkey).append("<span><font color='#6f6f6f'><i class='fa fa-eye'></i>Просмотрено "+item.viewed+" раз</font></span>");
            }
        }
    }); 

});
}