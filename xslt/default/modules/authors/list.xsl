<xsl:template match="authors_module[@action='list']">
  <xsl:call-template name="authors-list"/>
</xsl:template>

<xsl:template match="authors_module[@action='list' and @mode='loved']">
  <xsl:call-template name="authors-list">
    <xsl:with-param name="title">Мои любимые авторы</xsl:with-param>
  </xsl:call-template>
</xsl:template>

<xsl:template name="authors-list" match="*">
  <xsl:param name="title">Авторы</xsl:param>
  <xsl:param name="amount" select="5"/>
  <ul class="authors-list module">
    <h2><xsl:value-of select="$title" /> (<xsl:value-of select="count(authors/item)"/>)</h2>
    <xsl:apply-templates select="authors/item[not (position()>$amount)]" mode="authors-author" />
  </ul>
</xsl:template>

<xsl:template match="*" mode="authors-author">
  <li class="authors-list-item">
		<a href="{&prefix;}a/{@id}"><img src="{@picture}" alt="[Image]"/></a>
    <p class="authors-list-item-name">
      <a href="{&prefix;}a/{@id}">
        <xsl:value-of select="@name" />
      </a>
    </p>
  </li>
</xsl:template>
