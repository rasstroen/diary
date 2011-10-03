<xsl:template match="reviews_module[@action='list']">
  <xsl:apply-templates select="reviews" mode="reviews-list">
    <xsl:with-param name="users" select="users"/>
  </xsl:apply-templates>
</xsl:template>

<xsl:template match="reviews_module[@action='list' and @mode='user']">
  <xsl:apply-templates select="reviews" mode="reviews-list">
    <xsl:with-param name="mode" select="'user'"/>
    <xsl:with-param name="users" select="users"/>
    <xsl:with-param name="books" select="books"/>
  </xsl:apply-templates>
</xsl:template>

<xsl:template match="*" mode="reviews-list">
  <xsl:param name="mode"/>
  <xsl:param name="users"/>
  <xsl:param name="books"/>
  <script src="{&prefix;}static/default/js/jquery.timeago.js"></script>
  <div class="reviews-list module">
    <xsl:if test="count(item)!=0">
      <h2>Отзывы пользователей</h2>
      <xsl:choose>
        <xsl:when test="$mode='user'">
          <xsl:apply-templates select="item" mode="reviews-list-item-user">
            <xsl:with-param name="users" select="$users"/>
            <xsl:with-param name="books" select="$books"/>
          </xsl:apply-templates>
        </xsl:when>
        <xsl:otherwise>
          <xsl:apply-templates select="item" mode="reviews-list-item">
            <xsl:with-param name="users" select="$users"/>
          </xsl:apply-templates>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:if>
  </div>
  <script type="text/javascript">
    $('abbr.timeago').timeago();
  </script>
</xsl:template>

<xsl:template match="*" mode="reviews-list-item">
  <xsl:param name="review" select="."/>
  <xsl:param name="users" select="users"/>
  <xsl:param name="user" select="$users/item[@id=$review/@id_user]"/>
  <xsl:param name="mode"/>
  <li class="reviews-list-item">
    <div class="reviews-list-item-image">
      <img src="{$user/@picture}" alt="[Image]"/>
    </div>
    <div class="reviews-list-item-text">
      <div class="reviews-list-item-text-time">
        <xsl:call-template name="helpers-abbr-time">
          <xsl:with-param select="@time" name="time"/>
        </xsl:call-template>
      </div>
      <div class="reviews-list-item-text-nickname">
        <a href="{&prefix;}user/{$user/@id}">
          <xsl:value-of select="$user/@nickname" />
        </a>
      </div>
      <xsl:if test="@rate > 0">
        <div class="reviews-list-item-text-rate">Оценка: <xsl:value-of select="@rate" /></div>
      </xsl:if>
      <div class="reviews-list-item-text-html">
        <xsl:value-of select="@html" disable-output-escaping="yes"/>
      </div>
    </div>
  </li>
</xsl:template>

<xsl:template match="*" mode="reviews-list-item-user">
  <xsl:param name="review" select="."/>
  <xsl:param name="users" select="users"/>
  <xsl:param name="user" select="$users/item[@id=$review/@id_user]"/>
  <xsl:param name="books" select="books"/>
  <xsl:param name="book" select="$books/item[@id=$review/@book_id]"/>
  <li class="reviews-list-item-user">
    <div class="reviews-list-item-user-book">
      <div class="reviews-list-item-user-book-image">
        <a href="{&prefix;}b/{$book/@id}"><img src="{$book/@cover}"/></a>
      </div>
      <p class="reviews-list-item-user-book-title">
        <a href="{&prefix;}b/{$book/@id}"><xsl:value-of select="$book/@title" /></a>
      </p>
      <p class="reviews-list-item-user-book-author">
        <a href="{&prefix;}a/{$book/@author_id}"><xsl:value-of select="$book/@author" /></a>
      </p>
    </div>
    <div class="reviews-list-item-user-text">
      <xsl:if test="@rate > 0">
        <div class="reviews-list-item-user-text-rate">Оценка: <xsl:value-of select="@rate" /></div>
      </xsl:if>
      <div class="reviews-list-item-user-text-html">
        <xsl:value-of select="@html" disable-output-escaping="yes"/>
      </div>
    </div>
  </li>
</xsl:template>
