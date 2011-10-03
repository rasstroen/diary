<xsl:template match="magazines_module[@action='show']">
  <div class="magazines-show module">
    <h1><xsl:value-of select="magazine/@title"/></h1>
    <div class="magazine-show-edit">
      <a href="{&prefix;}magazine/{magazine/@id}/edit">Редактировать журнал</a>
    </div>
    <div class="magazines-show-info">
      <p><xsl:value-of select="magazine/@issn"/></p>
      <p><xsl:value-of select="magazine/@rightholder"/></p>
    </div>
    <div class="annotation">
      <xsl:value-of select="magazine/@annotation"/>
    </div>
    <ul class="magazines-show-years">
      <h2>Выпуски журнал</h2>
      <xsl:apply-templates select="magazine/years/item" mode="magazines-show-years-item"/>
    </ul>
  </div>
</xsl:template>

<xsl:template match="*" mode="magazines-show-years-item">
  <li class="magazines-show-years-item">
    <h3><xsl:value-of select="@year"/></h3>
    <ul class="magazines-show-years-item-books-item">
      <xsl:apply-templates select="books/item" mode="magazines-show-years-item-books-item"/>
    </ul>
  </li>
</xsl:template>

<xsl:template match="*" mode="magazines-show-years-item-books-item">
  <xsl:choose>
    <xsl:when test="@bid">
      <a href="{&prefix;}b/{@bid}"><xsl:value-of select="@n"></xsl:value-of></a>
    </xsl:when>
    <xsl:otherwise>
      <a class="magazines-show-years-item-books-item-empty" href="{&prefix;}book/new?n={@n}&amp;m={../../../../@id}&amp;title={../../../../@title}&amp;subtitle=№ {@n} за {../../@year} год&amp;year={../../@year}"><xsl:value-of select="@n"></xsl:value-of></a>
    </xsl:otherwise>
  </xsl:choose>
</xsl:template>
