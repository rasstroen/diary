<xsl:template match="magazines_module[@action='edit']">
	<script language="javascript" type="text/javascript" src="{&prefix;}static/default/js/tiny_mce/tiny_mce.js"></script>
	<script src="{&prefix;}static/default/js/magazines_module.js"></script>
	<div class="magazines-edit module">
		<form method="post" enctype="multipart/form-data" action="{&prefix;}magazine/{magazine/@id}/edit">
			<input type="hidden" name="writemodule" value="MagazineWriteModule" />
			<input type="hidden" name="id" value="{magazine/@id}" />
			<input type="hidden" name="n" value="{write/@n}" />
			<input type="hidden" name="m" value="{write/@m}" />
			<div class="form-group">
				<h2>Редактирование журнала «<xsl:value-of select="magazine/@title"></xsl:value-of>»
				</h2>
				<div class="form-field">
					<label>Название</label>
					<input name="title" value="{magazine/@title}" />
				</div>
				<div class="form-field">
					<label>ISSN</label>
					<input name="isbn" value="{magazine/@isbn}" />
				</div>
				<div class="form-field">
					<label>Язык журнала</label>
					<xsl:call-template name="helpers-lang-code-select">
						<xsl:with-param name="object" select="magazine"/>
					</xsl:call-template>
				</div>
				<div class="form-field">
					<label>Правообладатель</label>
					<input name="rightholder" value="{magazine/@rightholder}" />
				</div>
				<div class="form-field">
					<label>Анотация</label>
					<textarea name="annotation">
						<xsl:value-of select="magazine/@annotation" />	
					</textarea>
				</div>
			</div>
			<div class="form-group">
				<h2>Обложка</h2>
				<img src="{magazine/@cover}?{magazine/@lastSave}" alt="[Обложка]" />
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
