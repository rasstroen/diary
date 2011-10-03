
<xsl:template match="books_module[@action='new']">
	<script language="javascript" type="text/javascript" src="{&prefix;}static/default/js/tiny_mce/tiny_mce.js"></script>
	<div class="books-new module">
		<form method="post" enctype="multipart/form-data" action="{&prefix;}book/new">
			<input type="hidden" name="writemodule" value="BookWriteModule" />
			<input type="hidden" name="n" value="{write/@n}" />
			<input type="hidden" name="m" value="{write/@m}" />
			<div class="form-group">
				<h2>Добавление книги</h2>
				<div class="form-field">
					<label>Название</label>
					<input name="title" value="{write/@title}"/>
				</div>
				<div class="form-field">
					<label>Доп. инфо</label>
					<input name="subtitle" value="{write/@subtitle}"/>
				</div>
				<div class="form-field">
					<label>ISBN</label>
					<input name="isbn"/>
				</div>
				<div class="form-field">
					<label>Год издания</label>
					<input name="year" value="{write/@year}" />
				</div>
				<div class="form-field">
					<label>Язык книги</label>
					<xsl:call-template name="helpers-lang-code-select">
						<xsl:with-param name="object" select="book"/>
					</xsl:call-template>
				</div>
				<div class="form-field">
					<label>Правообладатель</label>
					<input name="rightholder"/>
				</div>
				<div class="form-field">
					<label>Анотация</label>
					<textarea name="annotation">
						<xsl:value-of select="book/@annotation" />	
					</textarea>
				</div>
			</div>
			<div class="form-group">
				<h2>Обложка</h2>
				<div class="form-field">
					<input type="file" name="cover"></input>
				</div>
			</div>
			<div class="form-control">
				<input type="submit" value="Сохранить информацию"/>
			</div>
		</form>
		<script type="text/javascript">
      tinyMCE.init({mode:"textareas"});
		</script>
	</div>
</xsl:template>
