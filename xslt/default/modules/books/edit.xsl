
<xsl:template match="books_module[@action='edit']">
	<script language="javascript" type="text/javascript" src="{&prefix;}static/default/js/tiny_mce/tiny_mce.js"></script>
	<script src="{&prefix;}static/default/js/books_module.js"></script>
	<script>
		<xsl:text>var exec_url ='</xsl:text>
		<xsl:value-of select="&prefix;" />
		<xsl:text>'</xsl:text>
	</script>
	<div class="books-edit module">
		<form method="post" enctype="multipart/form-data" action="{&prefix;}book/{book/@id}/edit">
			<input type="hidden" name="writemodule" value="BookWriteModule" />
			<input type="hidden" name="id" value="{book/@id}" />
			<input type="hidden" name="n" value="{write/@n}" />
			<input type="hidden" name="m" value="{write/@m}" />
			<div class="form-group">
				<h2>Редактирование книги «
					<xsl:value-of select="book/@title"></xsl:value-of>»
				</h2>
				<div class="form-field">
					<label>Название</label>
					<input name="title" value="{book/@title}" />
				</div>
				<div class="form-field">
					<label>Доп. инфо</label>
					<input name="subtitle" value="{book/@subtitle}" />
				</div>
				<div class="form-field">
					<label>ISBN</label>
					<input name="isbn" value="{book/@isbn}" />
				</div>
				<div class="form-field">
					<label>Год издания</label>
					<input name="year" value="{book/@year}" />
				</div>
				<div class="form-field">
					<label>Язык книги</label>
					<xsl:call-template name="helpers-lang-code-select">
						<xsl:with-param name="object" select="book"/>
					</xsl:call-template>
				</div>
				<div class="form-field">
					<label>Правообладатель</label>
					<input name="rightholder" value="{book/@rightholder}" />
				</div>
				<div class="form-field">
					<label>Анотация</label>
					<textarea name="annotation">
						<xsl:value-of select="book/@annotation" />	
					</textarea>
				</div>
			</div>
			<div class="form-group">
				<xsl:for-each select="book/files/item">
					<div>Залитый файл 
						<xsl:value-of select="@filetypedesc"/>
						(<xsl:value-of select="@size"/> байт)
					</div>
				
				</xsl:for-each>
				<h2>Добавить файл</h2>
				<div class="form-field">
					<input type="file" name="file"></input>
				</div>
			</div>
			<div class="form-group">
				<h2>Обложка</h2>
				<img src="{book/@cover}?{book/@lastSave}" alt="[Обложка]" />
				<div class="form-field">
					<input type="file" name="cover"></input>
				</div>
			</div>
			<div class="form-control">
				<input type="submit" value="Сохранить информацию"/>
			</div>
		</form>
		<form>
			<div class="form-group">
				<h2>Авторы</h2>
				<div class="books-edit-authors">
					<xsl:for-each select="book/authors/item">
						<xsl:call-template name="books-edit-author"/>
					</xsl:for-each>
					<xsl:call-template name="books-edit-author-new"></xsl:call-template>
				</div>
			</div>
		</form>
		<script type="text/javascript">
      tinyMCE.init({mode:"textareas"});
		</script>
	</div>
</xsl:template>

<xsl:template name="books-edit-author">
	<div class="books-edit-author" id="books-edit-author-{@id}">
		<a href="#" class="books-edit-author-delete">Удалить</a>
		<input type="hidden" name="id_author" value="{@id}"/>    
		<xsl:value-of select="@roleName"/>:
		<xsl:call-template name="helpers-author-name">
			<xsl:with-param name="author" select="."/>
		</xsl:call-template>
	</div>
</xsl:template>

<xsl:template name="books-edit-author-new">
	<div class="books-edit-author-new">
		<xsl:call-template name="helpers-role-select">
			<xsl:with-param name="object" select="book"/>
		</xsl:call-template>
		<input name="id_author" type="text" class="books-edit-author-new-id" />
		<a href="#" class="books-edit-author-new-submit">Добавить</a>
	</div>
</xsl:template>
