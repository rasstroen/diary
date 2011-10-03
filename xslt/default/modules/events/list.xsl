
<xsl:template match="events_module[@action='list']">
	<xsl:call-template name="events-list"/>
</xsl:template>

<xsl:template name="events-list" match="*">
	<xsl:param name="events" select="events"/>
	<xsl:param name="amount" select="10"/>
	<script src="{&prefix;}static/default/js/events_module.js"></script>
	<script src="{&prefix;}static/default/js/jquery.timeago.js"></script>
	<xsl:call-template name="events-list-header" />
	<ul class="events-list module">
		<h2>
			<xsl:value-of select="$events/@title"/>
		</h2>
		<xsl:apply-templates select="events/item[not (position()>$amount)]" mode="events-list-item">
			<xsl:with-param name="users" select="users"/>
			<xsl:with-param name="authors" select="authors"/>
			<xsl:with-param name="books" select="books"/>
		</xsl:apply-templates>
	</ul>
	<script type="text/javascript">
    events_module_getLikes('&prefix;');
    $('abbr.timeago').timeago();
	</script>
</xsl:template>

<xsl:template name="events-list-header">
	<xsl:if test="events/@self">
		<div>
			<a href="{&prefix;}me/wall/self">Только мои записи</a>
			<a href="{&prefix;}me/wall">Записи моих друзей</a>
		</div>
	</xsl:if>	
</xsl:template>

<xsl:template match="*" mode="events-list-item">
	<xsl:param name="users" select="users"/>
	<xsl:param name="user_id" select="@user_id"/>
	<xsl:param name="owner_id" select="@owner_id"/>
	<xsl:param name="user" select="$users/item[@id=$user_id]"/>
	<xsl:param name="owner" select="$users/item[@id=$owner_id]"/>
	<xsl:param name="books" select="books"/>
	<xsl:param name="book_id" select="@book_id"/>
	<xsl:param name="book" select="$books/item[@id=$book_id]"/>
	<xsl:param name="authors" select="authors"/>
	<li class="events-list-item">
		<div class="events-list-item-image">
			<xsl:choose>
				<xsl:when test="$owner_id != 0">
					<img src="{$owner/@picture}" alt="[{$user/@nickname}]" />
				</xsl:when>
				<xsl:otherwise>
					<img src="{$user/@picture}" alt="[{$user/@nickname}]" />
				</xsl:otherwise>
			</xsl:choose>
			
		</div>
		<div class="events-list-item-text">
			<p class="events-list-item-text-date">
				<a href="{&prefix;}user/{$user/@id}/wall/{@id}">
					<xsl:call-template name="helpers-abbr-time">
						<xsl:with-param select="@time" name="time"/>
					</xsl:call-template>
				</a>
			</p>
			<xsl:if test="@retweet_from != 0">
				<a href="{&prefix;}user/{$owner/@id}">
					<xsl:value-of select="$owner/@nickname"></xsl:value-of>
				</a>
				<xsl:text>: мне понравилась запись:</xsl:text>
			</xsl:if>
			<p class="events-list-item-text-title">
				<a href="{&prefix;}user/{$user/@id}">
					<xsl:value-of select="$user/@nickname"></xsl:value-of>
				</a>
				<xsl:choose>
					<xsl:when test="@type='books-add'">&#160;добавил новую книгу</xsl:when>
					<xsl:when test="@type='books-edit'">&#160;изменил книгу</xsl:when>
					<xsl:when test="@type='books-review-new'">&#160;написал рецензию на книгу</xsl:when>
					<xsl:otherwise></xsl:otherwise>
				</xsl:choose>
			</p>
			<xsl:call-template name="events-list-item-book">
				<xsl:with-param name="book" select="$book"/>
			</xsl:call-template>
			<div class="events-list-item-likes" name="likes" id="{@id}"/>
			<xsl:if test="@review">
				<div class="events-list-item-text-review">
					<xsl:value-of select="@review" disable-output-escaping="yes"/>
				</div>
			</xsl:if>
			<xsl:if test="@commentsCount">
				<ul class="events-list-item-comments">
					<h3>Последние комментарии</h3>
					<xsl:apply-templates select="comments/item" mode="events-list-item-comments-item">
						<xsl:with-param select="$users" name="users"></xsl:with-param>
					</xsl:apply-templates>
				</ul>
			</xsl:if>
			<xsl:call-template name="events-list-item-comments-new"/>
		</div>
	</li>
</xsl:template>

<xsl:template name="events-list-item-book">
	<xsl:param name="book" select="book"/>
	<div class="events-list-item-book">
		<div class="events-list-item-book-image">
			<a href="{&prefix;}b/{$book/@id}">
				<img src="{$book/@cover}"/>
			</a>
		</div>
		<div class="events-list-item-book-name">
			<a href="{&prefix;}book/{$book/@id}">
				<xsl:value-of select="$book/@title"/>
			</a>
		</div>
		<div class="events-list-item-book-author">
			<a href="{&prefix;}author/{$book/@author_id}">
				<xsl:value-of select="$book/@author"/>
			</a>
		</div>
	</div>
</xsl:template>

<xsl:template mode="events-list-item-comments-item" match="*">
	<xsl:param name="comment" select="."/>
	<xsl:param name="users" select="users"/>
	<xsl:variable select="$users/item[@id = $comment/@commenter_id]" name="user"></xsl:variable>
	<li class="events-list-item-comments-item">
		<div class="events-list-item-comments-item-image">
			<img src="{$user/@picture}" alt="[{$user/@nickname}]"/>
		</div>
		<div class="events-list-item-comments-item-text">
			<div class="events-list-item-comments-item-text-time">
				<xsl:call-template name="helpers-abbr-time">
					<xsl:with-param select="@time" name="time"/>
				</xsl:call-template>
			</div>
			<xsl:value-of select="$user/@nickname" />:
			<xsl:value-of select="@comment" />
		</div>
	</li>
</xsl:template>

<xsl:template name="events-list-item-comments-new">
	<div class="events-list-item-comments-new">
		<h3>Оставить комментарий</h3>
		<form method="post">
			<input type="hidden" name="id" value="{@id}" />
			<input type="hidden" name="action" value="comment_new" />
			<input type="hidden" value="EventsWriteModule" name="writemodule" />
			<div class="form-group">
				<div class="form-field">
					<textarea name="comment"/>
				</div>
			</div>
			<div class="form-control">
				<input type="submit" value="Оставить комментарий"/>
			</div>
		</form>
	</div>
</xsl:template>
