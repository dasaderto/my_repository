jQuery(function() {
    $('.alphabet_val').bind('click',function(){
       var author_sort=$(this).attr('value');
       $('.alphabet_val').removeAttr( 'style' );
       $(this).css('font-weight','bold');
       $(this).css('color','#337ab7');
       returndata(author_sort);
    });
});
jQuery(function() {
   $('title').text($('.categoryttl').text());
   if ($('.categoryttl').text().substr(0,9)=='Последние') $('title').text('СПК | Библиотечная система');
});