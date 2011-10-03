
<xsl:template match="log_module[@action='list']">
	<xsl:call-template name="log-list"/>
</xsl:template>

<xsl:template name="log-list" match="*">
	<xsl:param name="logs" select="logs"/>
	<xsl:param name="amount" select="10"/>
	<script src="{&prefix;}static/default/js/jquery.timeago.js"></script>
	<ul class="log-list module">
		<h2>
			<xsl:choose>
				<xsl:when test="$logs/@title">
					<xsl:value-of select="$logs/@title"/>
				</xsl:when>
				<xsl:when test="@mode='user'">Действия пользователя 
					<xsl:apply-templates select="users/item[1]" mode="helpers-user-link"/>
				</xsl:when>
				<xsl:when test="@mode='book'">Изменения книги 
					<xsl:apply-templates select="books/item[1]" mode="helpers-book-link"/>
				</xsl:when>
				<xsl:when test="@mode='author'">Изменения автора 
					<xsl:apply-templates select="authors/item[1]" mode="helpers-author-link"/>
				</xsl:when>
				<xsl:otherwise></xsl:otherwise>
			</xsl:choose>
		</h2>
		<xsl:apply-templates select="logs/item[not (position()>$amount)]" mode="log-list-item">
			<xsl:with-param name="users" select="users"/>
			<xsl:with-param name="authors" select="authors"/>
			<xsl:with-param name="books" select="books"/>
			<xsl:with-param name="mode" select="@mode"/>
		</xsl:apply-templates>
	</ul>
	<script type="text/javascript">$('abbr.timeago').timeago();</script>
</xsl:template>

<xsl:template match="*" mode="log-list-item">
	<xsl:param name="users" select="users"/>
	<xsl:param name="user_id" select="@id_user"/>
	<xsl:param name="user" select="$users/item[@id=$user_id]"/>
	<xsl:param name="books" select="books"/>
	<xsl:param name="book_id" select="@book_id"/>
	<xsl:param name="book" select="$books/item[@id=$book_id]"/>
	<xsl:param name="authors" select="authors"/>
	<xsl:param name="author_id" select="@author_id"/>
	<xsl:param name="author" select="$authors/item[@id=$author_id]"/>
	<xsl:param name="mode"/>
	<li class="log-list-item">
		<xsl:if test="not($mode) or ($mode!='user')">
			<div class="log-list-item-image">
				<xsl:apply-templates select="$user" mode="helpers-user-image"/>
			</div>
		</xsl:if>
		<div class="log-list-item-text">
			<p class="log-list-item-text-date">
				<xsl:call-template name="helpers-abbr-time">
					<xsl:with-param select="@time" name="time"/>
				</xsl:call-template>
			</p>
			<p class="log-list-item-text-title">
				<xsl:if test="not($mode) or $mode!='user'">
					<xsl:apply-templates select="$user" mode="helpers-user-link"/>
					<xsl:text>&nbsp;</xsl:text>
				</xsl:if>
				<xsl:choose>
					<xsl:when test="@type='author_new'">добавил нового автора</xsl:when>
					<xsl:when test="@type='author_edit'">изменил автора</xsl:when>
					<xsl:when test="@type='book_new'">добавил новую книгу</xsl:when>
					<xsl:when test="@type='book_edit'">изменил книгу</xsl:when>
					<xsl:otherwise></xsl:otherwise>
				</xsl:choose>
				<xsl:text>&nbsp;</xsl:text>
				<xsl:if test="not($mode) or ($mode!='author' and $mode!='book')">
					<xsl:choose>
						<xsl:when test="@type='author_new' or @type='author_edit'">
							<xsl:apply-templates select="$author" mode="helpers-author-link"/>
						</xsl:when>
						<xsl:when test="@type='book_new' or @type='book_edit'">
							<xsl:apply-templates select="$book" mode="helpers-book-link"/>
						</xsl:when>
						<xsl:otherwise></xsl:otherwise>
					</xsl:choose>
				</xsl:if>
			</p>
		</div>
		<div class="log-list-item-values">
			<table>
				<thead>
					<th class="first"></th>
					<th>Было</th>
					<th>Стало</th>
				</thead>
				<xsl:apply-templates select="values/item" mode="log-list-item-values-item"></xsl:apply-templates>
			</table>
		</div>
	</li>
</xsl:template>

<xsl:template match="*" mode="log-list-item-values-item">
	<xsl:variable name="item" select="." />
	<tr class="log-list-item-values-item">
		<td class="log-list-item-values-item-name">
			<xsl:value-of select="@name"/>
		</td>
		<td>
			<xsl:choose>
				<xsl:when test="@name ='id_lang'">
					<xsl:value-of select="//lang_codes/item[@id = $item/@old]/@title" />
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="@old" disable-output-escaping="yes" />	
				</xsl:otherwise>
			</xsl:choose>
			
		</td>
		<td>
			<xsl:choose>
				<xsl:when test="@name ='id_lang'">
					<xsl:value-of select="//lang_codes/item[@id = $item/@new]/@title" />
				</xsl:when>
				<xsl:otherwise>
					<xsl:value-of select="@new" disable-output-escaping="yes" />	
				</xsl:otherwise>
			</xsl:choose>
		</td>
	</tr>
</xsl:template>
