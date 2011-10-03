<xsl:template match="books_module[@action='list']">
  <xsl:call-template name="books-list"/>
</xsl:template>

<xsl:template match="books_module[@action='list' and @mode='new']">
  <xsl:call-template name="books-list">
    <xsl:with-param name="amount" select="20"/>
  </xsl:call-template>
</xsl:template>

<xsl:template match="books_module[@action='list' and @mode='popular']">
  <xsl:call-template name="books-list">
    <xsl:with-param name="amount" select="20"/>
  </xsl:call-template>
</xsl:template>

<xsl:template match="books_module[@action='list' and @mode='shelves']">
	<xsl:for-each select="shelves/item">
    <xsl:call-template name="books-list">
      <xsl:with-param name="mode" select="'shelves'"/>
    </xsl:call-template>
	</xsl:for-each>
</xsl:template>

<xsl:template match="books_module[@action='list' and @mode='author_books']">
  <xsl:call-template name="books-list">
    <xsl:with-param name="mode" select="'author_books'"/>
  </xsl:call-template>
</xsl:template>

<xsl:template name="books-list" match="*">
	<xsl:param name="books" select="books"/>
	<xsl:param name="amount" select="5"/>
	<xsl:param name="mode"/>
	<ul class="books-list module">
		<h2 class="books-list-title">
      <xsl:value-of select="$books/@title" />
      <xsl:if test="$books/@count"> (<xsl:value-of select="$books/@count"/>)</xsl:if>
		</h2>
    <xsl:choose>
      <xsl:when test="$mode='shelves'">
        <xsl:apply-templates select="books/item[not (position()>$amount)]" mode="books-list-shelves-item"/>
      </xsl:when>
      <xsl:when test="$mode='author_books'">
        <xsl:apply-templates select="books/item[not (position()>$amount)]" mode="books-list-author-books-item"/>
      </xsl:when>
      <xsl:otherwise>
        <xsl:apply-templates select="books/item[not (position()>$amount)]" mode="books-list-item"/>
      </xsl:otherwise>
    </xsl:choose>
    <xsl:if test="$books/@link_title and $books/@link_url">
      <div class="books-list-link">
        <a href="{&prefix;}{$books/@link_url}">
          <xsl:value-of select="$books/@link_title"></xsl:value-of>
        </a>
      </div>
    </xsl:if>
	</ul>
</xsl:template>

<xsl:template match="*" mode="books-list-item">
	<li class="books-list-item">
		<a href="{&prefix;}b/{@id}"><img src="{@cover}"/></a>
		<p class="books-list-item-title">
			<a href="{&prefix;}b/{@id}"><xsl:value-of select="@title" /></a>
		</p>
		<p class="books-list-item-author">
			<a href="{&prefix;}a/{@author_id}"><xsl:value-of select="@author" /></a>
		</p>
	</li>
</xsl:template>

<xsl:template match="*" mode="books-list-author-books-item">
	<li class="books-list-item">
		<a href="{&prefix;}b/{@id}"><img src="{@cover}"/></a>
		<p class="books-list-item-title">
			<a href="{&prefix;}b/{@id}"><xsl:value-of select="@title" /></a>
		</p>
	</li>
</xsl:template>

<xsl:template match="*" mode="books-list-shelves-item">
  <li class="books-list-shelves-item">
    <div class="books-list-shelves-item-image">
      <a href="{&prefix;}book/{@id}"><img src="{@cover}" alt="[Image]"/></a>
    </div>
    <div class="books-list-shelves-item-info">
      <h2><a href="{&prefix;}book/{@id}"><xsl:value-of select="@title" /></a></h2>
      <div class="books-list-shelves-item-info-author">
        <a href="{&prefix;}a/{@author_id}"><xsl:value-of select="@author" /></a>
      </div>
    </div>
  </li>
</xsl:template>
