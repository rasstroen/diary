<xsl:template match="authors_module[@action='edit']">
	<script language="javascript" type="text/javascript" src="{&prefix;}static/default/js/tiny_mce/tiny_mce.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
	<script src="{&prefix;}static/default/js/jquery-ui-datepicker-ru.js"></script>
	<link href="{&prefix;}static/default/css/jquery-ui-1.8.16.custom.css" media="screen" rel="stylesheet" type="text/css" />
	<script>
      $(function() {
        $.datepicker.setDefaults({
          dateFormat: 'yyyy-mm-dd',
          changeMonth: true,
          changeYear: true,
          yearRange: '1900:1990'
        });
      });
	</script>
	<div class="authors-edit module">
		<form method="post" enctype="multipart/form-data" action="{&prefix;}author/{author/@id}/edit">
			<input type="hidden" name="writemodule" value="AuthorWriteModule" />
			<input type="hidden" name="id" value="{author/@id}" />
			<div class="form-group">
				<h2>Редактирование автора <xsl:value-of select="author/@name"></xsl:value-of>
				</h2>
				<div class="form-field">
					<label>Имя</label>
					<input name="first_name" value="{author/@first_name}" />
				</div>
				<div class="form-field">
					<label>Отчество</label>
					<input name="middle_name" value="{author/@middle_name}" />
				</div>
				<div class="form-field">
					<label>Фамилия</label>
					<input name="last_name" value="{author/@last_name}" />
				</div>
				<div class="form-field">
					<label>Годы жизни</label>
					<input name="date_birth" value="{author/@date_birth}" /> &mdash; 
					<input name="date_death" value="{author/@date_death}" />
				</div>
				<div class="form-field">
					<label>Официальный сайт</label>
					<input name="homepage" value="{author/@homepage}" />
				</div>
				<div class="form-field">
					<label>Страница в Википедии</label>
					<input name="wiki_url" value="{author/@wiki_url}" />
				</div>
				<div class="form-field">
					<label>Основной язык</label>
					<xsl:call-template name="helpers-lang-code-select">
						<xsl:with-param name="object" select="author"/>
					</xsl:call-template>
				</div>
				<div class="form-field">
					<label>Биография</label>
					<textarea name="bio">
						<xsl:value-of select="author/bio/@html" />	
					</textarea>
				</div>
			</div>
			<div class="form-group">
				<h2>Фотография</h2>
				<img src="{author/@picture}?{author/@lastSave}" alt="[Фото]" />
				<div class="form-field">
					<input type="file" name="picture"></input>
				</div>
			</div>
			<div class="form-control">
				<input type="submit" value="Сохранить информацию"/>
			</div>
		</form>
		<script type="text/javascript">
      tinyMCE.init({mode:"textareas"});
      $(function() {
        $("input[name='date_birth']").datepicker($.datepicker.regional["ru"]);
        $("input[name='date_death']").datepicker($.datepicker.regional["ru"]);
      });
		</script>
	</div>
</xsl:template>
