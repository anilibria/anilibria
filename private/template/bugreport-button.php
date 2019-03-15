<p><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#report-send">Сообщить об ошибке</button></p>

<div class="modal fade" id="report-send" tabindex="-1" role="dialog" data-rid="<?=$arrData['rid']?>" aria-hidden="true" >
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Сообщить об ошибке:</b> <span><?=$arrData['name']?></span></h4>
			</div>
			<div class="modal-body">
				<p class="text-muted">
				Нашли ошибку в описании/оформлении/озвучке? Сообщите нам и мы рассмотрим ваше сообщение.
				Если проблема касается только конкретных серий - обязательно перечислите все эти серии.
				</p>

				<label class="form-control-label">Ваше сообщение:</label>
				<textarea class="form-control" id="report-msg" placeholder="Например: Отсутствует перевод в сериях 3-5, 7 и 12"></textarea>
			</div>
			<div class="modal-footer">
				<div id="report-info"></div>
				<div>
					<button type="button" data-dismiss="modal" class="btn">Закрыть</button>
					<button type="button" data-report-send class="btn btn-primary" disabled>Отправить</button>
				</div>
			</div>
		</div>
	</div>
</div>
