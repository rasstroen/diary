
<xsl:template match="genres_module[@action='show']">
	<xsl:param name="amount" select="30"/>
	<div class="genres-show module">
		<h2 class="genres-show-title">
			<xsl:value-of select="genre/@title"/>
		</h2>
		<div class="genres-show-count">
      Книг: 
			<xsl:value-of select="genres/item/@books_count"/>
		</div>
		<ul class="genres-show-books">
			<xsl:apply-templates select="genres/item/books/item[not (position()>$amount)]" mode="genres-show-books-item"/>
		</ul>
		<ul class="genres-list-item-subgenres">
			<xsl:apply-templates select="genres/item/subgenres/item" mode="genres-list-item-subgenres-item"/>
		</ul>
	</div>
</xsl:template>

<xsl:template match="*" mode="genres-show-books-item">
	<li class="genres-show-books-item">
		<div class="genres-show-books-item-image">
			<a href="{&prefix;}book/{@id}">
				<img src="{@cover}" alt="[Image]"/>
			</a>
		</div>
		<div class="genres-show-books-item-info">
			<div class="genres-show-books-item-info-title">
				<a href="{&prefix;}book/{@id}">
					<xsl:value-of select="@title" />
				</a>
			</div>
			<div class="genres-show-books-item-info-author">
				<a href="{&prefix;}a/{@author_id}">
					<xsl:value-of select="@author" />
				</a>
			</div>
		</div>
	</li>
</xsl:template>


<xsl:template match="*" mode="genres-list-item-subgenres-item">
  <li class="genres-list-item-subgenres-item">
    <a href="{&prefix;}genres/{@name}"><xsl:value-of select="@title"/></a>
    <xsl:variable name="subgenre-books-amount">
      <xsl:call-template name="helpers-this-amount">
      	<xsl:with-param select="@books_count" name="amount"></xsl:with-param>
      	<xsl:with-param select="'книга книги книг'" name="words"></xsl:with-param>
      </xsl:call-template>
    </xsl:variable>
    <em title="{$subgenre-books-amount}"><xsl:value-of select="@books_count"/></em>
  </li>
</xsl:template>