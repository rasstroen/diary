<xsl:template match="series_module[@action='list']">
  <xsl:param name="amount" select="5"/>
  <ul class="series-list module">
    <xsl:apply-templates select="series/item[not (position()>$amount)]" mode="series-list-item"/>
  </ul>
</xsl:template>

<xsl:template mode="series-list-item" match="*">
  <xsl:param name="books" select="books"/>
  <xsl:param name="amount" select="4"/>
  <li class="series-list-item">
    <h2 class="series-list-item-title">
      <xsl:value-of select="$books/@title" />
      <xsl:if test="$books/@count">
        <em class="series-list-item-book-count">
          <xsl:variable name="books_count">
            <xsl:call-template name="helpers-this-amount">
              <xsl:with-param select="$books/@count" name="amount"/>
              <xsl:with-param select="'книга книги книг'" name="words"/>
            </xsl:call-template>
          </xsl:variable>
          (<xsl:value-of select="$books_count"/>)
        </em>
      </xsl:if>
    </h2>
    <ul class="series-list-item-books">
      <xsl:apply-templates select="books/item[not (position()>$amount)]" mode="series-list-item-books-item"/>
    </ul>
    <xsl:if test="$books/@link_title and $books/@link_url">
      <div class="series-list-item-books-item-link">
        <a href="{&prefix;}{$books/@link_url}">
          <xsl:value-of select="$books/@link_title"/>
        </a>
      </div>
    </xsl:if>
  </li>
</xsl:template>

<xsl:template match="*" mode="series-list-item-books-item">
  <li class="series-list-item-books-item">
    <div class="series-list-item-books-item-image">
      <a href="{&prefix;}book/{@id}"><img src="{@cover}" alt="[Image]"/></a>
    </div>
    <div class="series-list-item-books-item-info">
      <div class="series-list-item-books-item-info-title">
        <a href="{&prefix;}book/{@id}"><xsl:value-of select="@title" /></a>
      </div>
      <div class="series-list-item-books-item-info-author">
        <a href="{&prefix;}a/{@author_id}"><xsl:value-of select="@author" /></a>
      </div>
    </div>
  </li>
</xsl:template>
