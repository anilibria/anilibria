var needUpdate = 0;

function xPagination(a){
	$("#xpagination").pagination({
		items: a,
		itemsOnPage: 12,
		cssStyle: 'light-theme',
		onPageClick: function(page){
			getCatalog(page, false);
			$('html, body').animate({scrollTop: $(".contentmenu").offset().top }, 0);
		}
	});
}

$("#switcher").change(function(){
    getCatalog(1, true);
});
  
function getCatalog(page, update){
	if($("#switcher").prop("checked")){
		var sort = 1;
	}else{
		var sort = 2;
	}
	if($('#catalogFinish').data('state') == 'on'){
		var finish = 2;
	}else{
		var finish = 1;
	}
	localStorage.setItem('catalogSort', sort);
	year = '';
	genre = '';
	xpage = 'favorites';
	if(location.pathname.substring(1) != 'pages/favorites.php' && location.pathname.substring(1) != 'pages/new.php'){
		year = $.trim($('#catalogYear').val().toString().replace(/,/g, ","));
		genre = $.trim($('#catalogGenre').val().toString().replace(/,/g, ","));
		xpage = 'catalog';
	}
	search = {"year":year, "genre":genre};
	$.post("//"+document.domain+"/public/catalog.php", { 'page': page, 'search': JSON.stringify(search), 'xpage': xpage, 'sort': sort, 'finish': finish }, function(json){
		data = JSON.parse(json);
		if(data.err == 'ok'){
			$('.simpleCatalog tbody').html(data.table);
			if(needUpdate != data.update || update){
				xPagination(data.total);
				needUpdate = data.update;
			}
		}
	});
}

$(document).ready(function() {
	if(localStorage.getItem('catalogSort') == '1'){
		$('#switcher').bootstrapToggle('on');
	}else{
		$('#switcher').bootstrapToggle('off');
	}
	getCatalog(1, false);
	
	// https://bootsnipp.com/snippets/VgkV
	// $(e.target).removeClass("active");
	$(function(){
		$('.button-checkbox').each(function () {
			// Settings
			//e.preventDefault();
			var $widget = $(this),
				$button = $widget.find('button'),
				$checkbox = $widget.find('input:checkbox'),
				color = $button.data('color'),
				settings = {
					on: {
						icon: 'glyphicon glyphicon-check'
					},
					off: {
						icon: 'glyphicon glyphicon-unchecked'
					}
				};
			
			// Event Handlers
			$button.on('click', function () {
				$checkbox.prop('checked', !$checkbox.is(':checked'));
				$checkbox.triggerHandler('change');
				updateDisplay();
				
			});
			$checkbox.on('change', function () {
				updateDisplay();
				getCatalog(1, true);
			});

			// Actions
			function updateDisplay() {
				var isChecked = $checkbox.is(':checked');

				// Set the button's state
				$button.data('state', (isChecked) ? "on" : "off");

				// Set the button's icon
				$button.find('.state-icon')
					.removeClass()
					.addClass('state-icon ' + settings[$button.data('state')].icon);

				// Update the button's color
				if (isChecked) {
					$button
						.removeClass('btn-default')
						.addClass('btn-' + color + ' active');
				}
				else {
					$button
						.removeClass('btn-' + color + ' active')
						.addClass('btn-default');
				}
			}
			// Initialization
			function init() {

				updateDisplay();

				// Inject the icon if applicable
				if ($button.find('.state-icon').length === 0) {
					$button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
				}
			}
			init();
		});
	});	
});

$(document).on('click', '[data-catalog-update]', function(e){
	$(this).blur();
	e.preventDefault();	
	getCatalog(1, true);
});
