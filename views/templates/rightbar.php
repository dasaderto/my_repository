<div class="share-panel">
	<div class="title">Поделиться</div>
	<div class="share-buttons" style='padding: 1.5rem;'>
		<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus,twitter,telegram"></div>
	</div>
</div>

<div class="share-panel">
	<div class="title">Авторы</div>
	<div class="alphabet" style='padding: 1.5rem;'>
		<?$alphabet=array("А","Б","В","Г","Д","Е","Ж","З","И","К","Л","М","Н","О","П","Р","С","Т","У","Ф","Х","Ц","Ч","Ш","Щ","Э","Ю","Я");?>
		<?for ($i=0; $i <count($alphabet) ; $i++) { ?>
			<a href="/avtor-na-bukvu-<?echo $alphabet[$i];?>"><?=$alphabet[$i]?></a>	
		<?}?>
	</div>
</div>