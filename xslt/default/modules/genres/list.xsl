<xsl:template match="genres_module[@action='list']">
  <xsl:param name="amount" select="5"/>
  <ul class="genres-list module">
    <xsl:apply-templates select="genres/item" mode="genres-list-item"/>
  </ul>
</xsl:template>

<xsl:template mode="genres-list-item" match="*">
  <li class="genres-list-item">
    <h2 class="genres-list-item-title">
      <a href="{&prefix;}genres/{@name}"><xsl:value-of select="@title"/></a>
    </h2>
    <div class="genres-list-item-count">
      <xsl:call-template name="helpers-this-amount">
      	<xsl:with-param select="@books_count" name="amount"></xsl:with-param>
      	<xsl:with-param select="'книга книги книг'" name="words"></xsl:with-param>
      </xsl:call-template>
    </div>
    <ul class="genres-list-item-subgenres">
      <xsl:apply-templates select="subgenres/item" mode="genres-list-item-subgenres-item"/>
    </ul>
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
