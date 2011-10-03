
<xsl:template match="messages_module[@action='list' and not(@mode)]">
	<ul class="messages-list module">
		<xsl:apply-templates select="messages/item" mode="messages-list-item">
			<xsl:with-param select="users" name="users"/>
		</xsl:apply-templates>
	</ul>
</xsl:template>

<xsl:template match="*" mode="messages-list-item">
	<xsl:param select="users" name="users"/>
	<xsl:param name="uid" select="@id_author"/>
	<xsl:param name="user" select="$users/item[@id=$uid]"/>
	<li class="messages-list-item">
		<xsl:value-of select="@time" />
		<div class="messages-list-item-image">
			<a href="{&prefix;}user/{$user/@id}">
				<img src="{$user/@picture}" alt="[{$user/@nickname}]" />
			</a>
		</div>
		<div class="messages-list-item-text">
			<p class="messages-list-item-text-user">
				<a href="{&prefix;}user/{$user/@id}">
					<xsl:value-of select="$user/@nickname"></xsl:value-of>
				</a>
			</p>
			<p class="messages-list-item-text-subject">
				<xsl:value-of select="@subject"></xsl:value-of>
			</p>
			<div class="messages-list-item-text-doby">
				<a href="{&prefix;}me/messages/{@thread_id}">
					<xsl:value-of select="@html"></xsl:value-of>
				</a>
			</div>
		</div>
	</li>
	<br clear="all" />
</xsl:template>

<xsl:template match="*" mode="messages-thread-list-item">
	<xsl:param select="users" name="users"/>
	<xsl:param name="uid" select="@id_author"/>
	<xsl:param name="user" select="$users/item[@id=$uid]"/>
	<li class="messages-list-item">
		<xsl:value-of select="@time" />
		<div class="messages-list-item-image">
			<a href="{&prefix;}user/{$user/@id}">
				<img src="{$user/@picture}" alt="[{$user/@nickname}]" />
			</a>
		</div>
		<div class="messages-list-item-text">
			<p class="messages-list-item-text-user">
				<a href="{&prefix;}user/{$user/@id}">
					<xsl:value-of select="$user/@nickname"></xsl:value-of>
				</a>
			</p>
			<p class="messages-list-item-text-subject">
				<i><xsl:value-of select="@subject"></xsl:value-of></i>
			</p>
			<div class="messages-list-item-text-doby">
				<xsl:value-of select="@html"></xsl:value-of>
			</div>
		</div>
	</li>
	<br clear="all" />
</xsl:template>

<xsl:template match="messages_module[@action='list' and @mode='thread']">
	<ul class="messages-list module">
		<xsl:apply-templates select="messages/item" mode="messages-thread-list-item">
			<xsl:with-param select="users" name="users"/>
		</xsl:apply-templates>
	</ul>
</xsl:template>
