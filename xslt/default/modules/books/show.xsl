<xsl:template match="books_module[@action ='show' and not(@mode)]">
	<xsl:for-each select="book">
		<script src="{&prefix;}static/default/js/books_module.js"></script>
		<xsl:if test="@cover!=''">
			<img style="float:left;margin:10px;" src="{@cover}"/>	
		</xsl:if>
    <h2><xsl:value-of select="@title"/></h2>
    <xsl:if test="@subtitle != ''">
      <h3><xsl:value-of select="@subtitle"/></h3>
    </xsl:if>
    <a href="{&page;/@current_url}edit">редактировать книгу</a>
		<xsl:for-each select="authors/item">
			<div>
				<i><xsl:value-of select="@roleName" />: </i>
        <a href="/a/{@id}">
          <xsl:call-template name="helpers-author-name">
            <xsl:with-param name="author" select="."/>
          </xsl:call-template>
        </a>
			</div>
		</xsl:for-each>
		<xsl:for-each select="genres/item">
			<div>
				<a href="{&prefix;}g/{@name}">
					<xsl:value-of select="@title" />
				</a>
			</div>
		</xsl:for-each>
		<xsl:if test="rightsholder/@title != ''">Издатель:
			<a href="{&prefix;}rightsholder/{rightsholder/@id}">
				<xsl:value-of select="rightsholder/@title"></xsl:value-of>
			</a>
		</xsl:if>
		<xsl:if test="@isbn != ''">
			<div>
				ISBN:
				<xsl:value-of select="@isbn"></xsl:value-of>
			</div>			
		</xsl:if>
		<xsl:if test="@annotation != ''">
			<xsl:value-of select="@annotation" disable-output-escaping="yes" />	
		</xsl:if>
		<xsl:if test="&current_profile;/@id">
			<div id="book_bookshelflnkContainer" style="display:none">
				<script>
          bookModule_checkIfInBookshelf(<xsl:value-of select="@id"/>);
				</script>
				<a href="#" onclick="javascript:bookModule_drawAddBookShelfItem({@id},'{&prefix;}')">Забрать к себе</a>
				<div id="book_bookshelflnk"></div>
			</div>
		</xsl:if>
	</xsl:for-each>
</xsl:template>
