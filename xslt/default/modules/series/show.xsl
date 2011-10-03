<xsl:template match="series_module[@action='show']">
  <xsl:param name="amount" select="30"/>
  <div class="series-show module">
    <h2 class="series-show-title"><xsl:value-of select="serie/@title"/></h2>
    <div class="series-show-description">
      <xsl:value-of select="serie/@description" disable-output-escaping="yes"/>
    </div>
    <div class="series-show-count">
      <xsl:call-template name="helpers-this-amount">
        <xsl:with-param select="serie/books/@count" name="amount"></xsl:with-param>
        <xsl:with-param select="'книга книги книг'" name="words"></xsl:with-param>
      </xsl:call-template>
    </div>
    <xsl:if test="serie/parent/item/@title">
      <xsl:call-template name="series-show-parent">
        <xsl:with-param select="serie/parent/item" name="serie"/>
      </xsl:call-template>
    </xsl:if>
    <xsl:if test="serie/series">
      <ul class="series-show-children">
        <h3>Подсерии:</h3>
        <xsl:apply-templates select="serie/series/item" mode="series-show-children-item"/>
      </ul>
    </xsl:if>
    <ul class="series-show-books">
      <xsl:apply-templates select="serie/books/item[not (position()>$amount)]" mode="series-show-books-item"/>
    </ul>
  </div>
</xsl:template>

<xsl:template match="*" mode="series-show-books-item">
  <li class="series-show-books-item">
    <div class="series-show-books-item-image">
      <a href="{&prefix;}book/{@id}"><img src="{@cover}" alt="[Image]"/></a>
    </div>
    <div class="series-show-books-item-info">
      <div class="series-show-books-item-info-title">
        <a href="{&prefix;}book/{@id}"><xsl:value-of select="@title" /></a>
      </div>
      <div class="series-show-books-item-info-author">
        <a href="{&prefix;}a/{@author_id}"><xsl:value-of select="@author" /></a>
      </div>
    </div>
  </li>
</xsl:template>

<xsl:template match="*" mode="series-show-children-item">
  <li class="series-show-children-item">
    <a href="{&prefix;}s/{@id}"><xsl:value-of select="@title"/></a>
  </li>
</xsl:template>

<xsl:template name="series-show-parent">
  <xsl:param select="serie" name="serie"/>
  <div class="series-show-parrent">
    Подсерия серии «<a href="{&prefix;}s/{$serie/@id}"><xsl:value-of select="$serie/@title"/></a>»
  </div>
</xsl:template>

